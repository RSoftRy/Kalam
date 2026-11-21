<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/layout.php';

$u = exige_login();
$erro = '';
$respostas = [];
$tid = filter_input(INPUT_GET, 't', FILTER_VALIDATE_INT);
$acao = $_SERVER['REQUEST_METHOD'] === 'POST' ? (string) ($_POST['acao'] ?? '') : '';

// 1) Iniciar uma nova tentativa: sorteia as questões no servidor.
if ($acao === 'iniciar') {
    if (!csrf_valido()) {
        $erro = 'A sessão expirou. Tente de novo.';
    } else {
        if (PROVA_EXIGE_TRILHA) {
            $st = $pdo->prepare('SELECT COUNT(*) FROM progresso WHERE usuario_id = ?');
            $st->execute([$u['id']]);
            $feitas = (int) $st->fetchColumn();
            $totalAulas = (int) $pdo->query('SELECT COUNT(*) FROM aulas')->fetchColumn();
            if ($feitas < $totalAulas) {
                $erro = 'Conclua todas as aulas da trilha antes de fazer a avaliação.';
            }
        }

        if (!$erro) {
            $n = (int) QTD_QUESTOES_PROVA;
            $ids = $pdo->query('SELECT id FROM questoes ORDER BY RAND() LIMIT ' . $n)->fetchAll(PDO::FETCH_COLUMN);
            if (count($ids) < $n) {
                $erro = 'O banco ainda não tem questões suficientes para montar a avaliação.';
            } else {
                $pdo->beginTransaction();
                $st = $pdo->prepare('INSERT INTO tentativas (usuario_id) VALUES (?)');
                $st->execute([$u['id']]);
                $novo = (int) $pdo->lastInsertId();
                $ins = $pdo->prepare('INSERT INTO tentativa_questoes (tentativa_id, questao_id, ordem) VALUES (?, ?, ?)');
                foreach ($ids as $i => $qid) {
                    $ins->execute([$novo, $qid, $i + 1]);
                }
                $pdo->commit();
                redirecionar('prova.php?t=' . $novo);
            }
        }
    }
}

// 2) Tela da prova em andamento e correção.
if ($tid) {
    $st = $pdo->prepare('SELECT id, finalizada_em FROM tentativas WHERE id = ? AND usuario_id = ?');
    $st->execute([$tid, $u['id']]);
    $t = $st->fetch();
    if (!$t) {
        redirecionar('prova.php');
    }
    if ($t['finalizada_em'] !== null) {
        redirecionar('resultado.php?t=' . $tid);
    }

    $st = $pdo->prepare(
        'SELECT tq.id AS tq_id, tq.ordem, q.enunciado, q.alt_a, q.alt_b, q.alt_c, q.alt_d, q.alt_e, q.correta
         FROM tentativa_questoes tq
         JOIN questoes q ON q.id = tq.questao_id
         WHERE tq.tentativa_id = ?
         ORDER BY tq.ordem'
    );
    $st->execute([$tid]);
    $questoes = $st->fetchAll();

    if ($acao === 'corrigir') {
        if (!csrf_valido()) {
            $erro = 'A sessão expirou. Tente de novo.';
        } else {
            $enviadas = isset($_POST['q']) && is_array($_POST['q']) ? $_POST['q'] : [];
            $completo = true;
            foreach ($questoes as $q) {
                $l = $enviadas[$q['tq_id']] ?? '';
                if (is_string($l) && array_key_exists($l, alternativas($q))) {
                    $respostas[$q['tq_id']] = $l;
                } else {
                    $completo = false;
                }
            }

            if (!$completo) {
                $erro = 'Responda todas as questões antes de enviar.';
            } else {
                $pdo->beginTransaction();
                $acertos = 0;
                $up = $pdo->prepare('UPDATE tentativa_questoes SET resposta = ?, correta = ? WHERE id = ? AND tentativa_id = ?');
                foreach ($questoes as $q) {
                    $resp = $respostas[$q['tq_id']];
                    $ok = ($resp === $q['correta']) ? 1 : 0;
                    $acertos += $ok;
                    $up->execute([$resp, $ok, $q['tq_id'], $tid]);
                }
                $fim = $pdo->prepare('UPDATE tentativas SET finalizada_em = NOW(), acertos = ? WHERE id = ? AND finalizada_em IS NULL');
                $fim->execute([$acertos, $tid]);
                $pdo->commit();
                redirecionar('resultado.php?t=' . $tid);
            }
        }
    }

    cabecalho('Avaliação final');
    ?>
    <h1>Avaliação final</h1>
    <p>Marque uma alternativa em cada questão e envie. O gabarito aparece depois.</p>
    <?php if ($erro): ?><p class="aviso erro"><?= e($erro) ?></p><?php endif; ?>
    <form method="post" action="prova.php?t=<?= (int) $tid ?>">
      <?= csrf_campo() ?>
      <input type="hidden" name="acao" value="corrigir">
      <?php foreach ($questoes as $i => $q): ?>
        <fieldset class="questao">
          <legend>Questão <?= $i + 1 ?></legend>
          <p class="enunciado"><?= nl2br(e($q['enunciado'])) ?></p>
          <?php foreach (alternativas($q) as $l => $txt): ?>
            <label class="alt">
              <input type="radio" name="q[<?= (int) $q['tq_id'] ?>]" value="<?= e($l) ?>" required
                <?= (($respostas[$q['tq_id']] ?? '') === $l) ? 'checked' : '' ?>>
              <span><strong><?= e(strtoupper($l)) ?>)</strong> <?= nl2br(e($txt)) ?></span>
            </label>
          <?php endforeach; ?>
        </fieldset>
      <?php endforeach; ?>
      <button type="submit" class="botao">Enviar respostas</button>
    </form>
    <?php
    rodape();
    exit;
}

// 3) Tela inicial da avaliação.
$st = $pdo->prepare('SELECT id, finalizada_em, acertos FROM tentativas WHERE usuario_id = ? AND finalizada_em IS NOT NULL ORDER BY id DESC LIMIT 5');
$st->execute([$u['id']]);
$historico = $st->fetchAll();

cabecalho('Avaliação final');
?>
<h1>Avaliação final</h1>
<?php if ($erro): ?><p class="aviso erro"><?= e($erro) ?></p><?php endif; ?>
<section class="cartao">
  <p>A avaliação tem <?= (int) QTD_QUESTOES_PROVA ?> questões de múltipla escolha, sorteadas do banco a cada tentativa. Você pode refazer quantas vezes quiser, e cada rodada traz uma combinação diferente.</p>
  <form method="post">
    <?= csrf_campo() ?>
    <input type="hidden" name="acao" value="iniciar">
    <button type="submit" class="botao">Iniciar avaliação</button>
  </form>
</section>

<?php if ($historico): ?>
  <section class="cartao">
    <h2>Suas últimas tentativas</h2>
    <ul class="historico">
      <?php foreach ($historico as $h): ?>
        <li>
          <a href="resultado.php?t=<?= (int) $h['id'] ?>"><?= e(date('d/m/Y H:i', strtotime($h['finalizada_em']))) ?></a>:
          <?= (int) $h['acertos'] ?> acertos
        </li>
      <?php endforeach; ?>
    </ul>
  </section>
<?php endif; ?>
<?php rodape(); ?>
