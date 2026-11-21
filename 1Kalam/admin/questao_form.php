<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/layout.php';

exige_admin();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: null;
$q = [
    'tema' => TEMAS[0], 'enunciado' => '',
    'alt_a' => '', 'alt_b' => '', 'alt_c' => '', 'alt_d' => '', 'alt_e' => '',
    'correta' => 'a',
];

if ($id) {
    $st = $pdo->prepare('SELECT * FROM questoes WHERE id = ?');
    $st->execute([$id]);
    $existente = $st->fetch();
    if (!$existente) {
        flash('Questão não encontrada.', 'erro');
        redirecionar('questoes.php');
    }
    foreach ($q as $campo => $_) {
        $q[$campo] = (string) ($existente[$campo] ?? '');
    }
}

$erros = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valido()) {
        $erros[] = 'A sessão expirou. Envie o formulário de novo.';
    } else {
        $q['tema']      = (string) ($_POST['tema'] ?? '');
        $q['enunciado'] = trim((string) ($_POST['enunciado'] ?? ''));
        foreach (LETRAS as $l) {
            $q['alt_' . $l] = trim((string) ($_POST['alt_' . $l] ?? ''));
        }
        $q['correta'] = (string) ($_POST['correta'] ?? '');

        if (!in_array($q['tema'], TEMAS, true)) {
            $erros[] = 'Escolha um tema válido.';
        }
        if ($q['enunciado'] === '' || mb_strlen($q['enunciado']) > 5000) {
            $erros[] = 'O enunciado é obrigatório e deve ter até 5000 caracteres.';
        }
        if ($q['alt_a'] === '' || $q['alt_b'] === '') {
            $erros[] = 'As alternativas A e B são obrigatórias.';
        }
        // Sem "buracos": C só existe se B existe, D só se C existe, e assim por diante.
        $anteriorVazia = false;
        foreach (LETRAS as $l) {
            $vazia = $q['alt_' . $l] === '';
            if (!$vazia && $anteriorVazia) {
                $erros[] = 'Preencha as alternativas em ordem, sem pular letras.';
                break;
            }
            if (mb_strlen($q['alt_' . $l]) > 2000) {
                $erros[] = 'Cada alternativa deve ter até 2000 caracteres.';
                break;
            }
            $anteriorVazia = $anteriorVazia || $vazia;
        }
        if (!in_array($q['correta'], LETRAS, true) || $q['alt_' . $q['correta']] === '') {
            $erros[] = 'A resposta certa precisa ser uma alternativa preenchida.';
        }

        if (!$erros) {
            $alts = [];
            foreach (LETRAS as $l) {
                $alts[] = $q['alt_' . $l] === '' ? null : $q['alt_' . $l];
            }
            if ($id) {
                $sql = 'UPDATE questoes SET tema = ?, enunciado = ?, alt_a = ?, alt_b = ?, alt_c = ?, alt_d = ?, alt_e = ?, correta = ? WHERE id = ?';
                $params = array_merge([$q['tema'], $q['enunciado']], $alts, [$q['correta'], $id]);
                $msg = 'Questão atualizada.';
            } else {
                $sql = 'INSERT INTO questoes (tema, enunciado, alt_a, alt_b, alt_c, alt_d, alt_e, correta) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
                $params = array_merge([$q['tema'], $q['enunciado']], $alts, [$q['correta']]);
                $msg = 'Questão adicionada ao banco.';
            }
            $pdo->prepare($sql)->execute($params);
            flash($msg);
            redirecionar('questoes.php');
        }
    }
}

cabecalho($id ? 'Editar questão' : 'Nova questão', '../');
?>
<h1><?= $id ? 'Editar questão ' . (int) $id : 'Nova questão' ?></h1>
<?php foreach ($erros as $m): ?><p class="aviso erro"><?= e($m) ?></p><?php endforeach; ?>

<form method="post" class="formulario largo">
  <?= csrf_campo() ?>
  <label>Tema
    <select name="tema" required>
      <?php foreach (TEMAS as $t): ?>
        <option value="<?= e($t) ?>" <?= $t === $q['tema'] ? 'selected' : '' ?>><?= e($t) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <label>Enunciado
    <textarea name="enunciado" rows="6" required maxlength="5000"><?= e($q['enunciado']) ?></textarea>
  </label>
  <?php foreach (LETRAS as $l): ?>
    <label>Alternativa <?= e(strtoupper($l)) ?><?= in_array($l, ['a', 'b'], true) ? ' (obrigatória)' : ' (opcional)' ?>
      <textarea name="alt_<?= e($l) ?>" rows="2" maxlength="2000" <?= in_array($l, ['a', 'b'], true) ? 'required' : '' ?>><?= e($q['alt_' . $l]) ?></textarea>
    </label>
  <?php endforeach; ?>
  <label>Resposta certa
    <select name="correta" required>
      <?php foreach (LETRAS as $l): ?>
        <option value="<?= e($l) ?>" <?= $l === $q['correta'] ? 'selected' : '' ?>><?= e(strtoupper($l)) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <div class="acoes">
    <button type="submit" class="botao">Salvar</button>
    <a class="botao secundario" href="questoes.php">Cancelar</a>
  </div>
</form>
<?php rodape(); ?>
