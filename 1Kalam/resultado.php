<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/layout.php';

$u = exige_login();
$tid = filter_input(INPUT_GET, 't', FILTER_VALIDATE_INT);
if (!$tid) {
    redirecionar('prova.php');
}

$st = $pdo->prepare('SELECT id, acertos, finalizada_em FROM tentativas WHERE id = ? AND usuario_id = ?');
$st->execute([$tid, $u['id']]);
$t = $st->fetch();
if (!$t) {
    redirecionar('prova.php');
}
if ($t['finalizada_em'] === null) {
    redirecionar('prova.php?t=' . $tid);
}

$st = $pdo->prepare(
    'SELECT tq.ordem, tq.resposta, tq.correta AS acertou,
            q.enunciado, q.alt_a, q.alt_b, q.alt_c, q.alt_d, q.alt_e, q.correta
     FROM tentativa_questoes tq
     LEFT JOIN questoes q ON q.id = tq.questao_id
     WHERE tq.tentativa_id = ?
     ORDER BY tq.ordem'
);
$st->execute([$tid]);
$itens = $st->fetchAll();

$total = count($itens);
$acertos = (int) $t['acertos'];
$nivel = $total > 0 ? (int) round($acertos / $total * 5) : 0;

$reacoes = [
    0 => ['Czarismo intacto', 'Nenhum acerto desta vez. A trilha continua aberta: releia as aulas e tente outra rodada.'],
    1 => ['Tropas em retirada', 'Pouca base por enquanto. Os módulos 1 e 2 são um bom lugar para recomeçar.'],
    2 => ['Greve geral', 'Você reconhece alguns fatos, mas datas e conceitos ainda se misturam. O gabarito abaixo mostra onde.'],
    3 => ['Soviete em formação', 'A base está boa, com lacunas pontuais que o gabarito ajuda a localizar.'],
    4 => ['Palácio de Inverno tomado', 'Falta só um detalhe para a pontuação máxima.'],
    5 => ['Revolução vitoriosa', 'Gabarito perfeito, sem nada a corrigir.'],
];
[$reacaoTitulo, $reacaoTexto] = $reacoes[$nivel];

cabecalho('Resultado');
?>
<h1>Resultado</h1>
<section class="reacao reacao-<?= (int) $nivel ?>">
  <p class="placar"><?= $acertos ?> de <?= $total ?></p>
  <h2><?= e($reacaoTitulo) ?></h2>
  <p><?= e($reacaoTexto) ?></p>
</section>

<h2>Gabarito</h2>
<?php foreach ($itens as $i): ?>
  <section class="questao resultado <?= $i['acertou'] ? 'acerto' : 'erro-q' ?>">
    <h3>Questão <?= (int) $i['ordem'] ?>: <?= $i['acertou'] ? 'acertou' : 'errou' ?></h3>
    <?php if ($i['enunciado'] === null): ?>
      <p class="nota">Esta questão foi removida do banco pelo administrador depois da prova.</p>
    <?php else: ?>
      <p class="enunciado"><?= nl2br(e($i['enunciado'])) ?></p>
      <?php foreach (alternativas($i) as $l => $txt): ?>
        <?php
        $classe = '';
        if ($l === $i['correta']) {
            $classe = 'certa';
        } elseif ($l === $i['resposta']) {
            $classe = 'marcada-errada';
        }
        ?>
        <p class="alt-res <?= $classe ?>">
          <strong><?= e(strtoupper($l)) ?>)</strong> <?= nl2br(e($txt)) ?>
          <?php if ($l === $i['correta']): ?><em> (resposta certa)</em><?php endif; ?>
          <?php if ($l === $i['resposta'] && $l !== $i['correta']): ?><em> (sua resposta)</em><?php endif; ?>
        </p>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
<?php endforeach; ?>

<div class="acoes">
  <form method="post" action="prova.php">
    <?= csrf_campo() ?>
    <input type="hidden" name="acao" value="iniciar">
    <button type="submit" class="botao">Tentar de novo</button>
  </form>
  <a class="botao secundario" href="trilha.php">Voltar à trilha</a>
</div>
<?php rodape(); ?>
