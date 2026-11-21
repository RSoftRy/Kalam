<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/layout.php';

exige_admin();

$tema = (string) ($_GET['tema'] ?? '');
if ($tema !== '' && !in_array($tema, TEMAS, true)) {
    $tema = '';
}

if ($tema !== '') {
    $st = $pdo->prepare('SELECT id, tema, enunciado, correta FROM questoes WHERE tema = ? ORDER BY id');
    $st->execute([$tema]);
} else {
    $st = $pdo->query('SELECT id, tema, enunciado, correta FROM questoes ORDER BY id');
}
$lista = $st->fetchAll();

cabecalho('Questões', '../');
?>
<h1>Banco de questões</h1>
<div class="acoes">
  <a class="botao" href="questao_form.php">Nova questão</a>
  <a class="botao secundario" href="index.php">Painel</a>
</div>

<form method="get" class="filtro">
  <label>Filtrar por tema
    <select name="tema">
      <option value="">Todos</option>
      <?php foreach (TEMAS as $t): ?>
        <option value="<?= e($t) ?>" <?= $t === $tema ? 'selected' : '' ?>><?= e($t) ?></option>
      <?php endforeach; ?>
    </select>
  </label>
  <button type="submit" class="botao secundario">Filtrar</button>
</form>

<p class="nota"><?= count($lista) ?> questão(ões) listada(s).</p>

<div class="tabela-rolavel">
  <table class="tabela">
    <thead>
      <tr><th>ID</th><th>Tema</th><th>Enunciado</th><th>Gabarito</th><th>Ações</th></tr>
    </thead>
    <tbody>
      <?php foreach ($lista as $q): ?>
        <tr>
          <td><?= (int) $q['id'] ?></td>
          <td><?= e($q['tema']) ?></td>
          <td><?= e(mb_strimwidth($q['enunciado'], 0, 140, '...')) ?></td>
          <td><?= e(strtoupper($q['correta'])) ?></td>
          <td class="acoes-linha">
            <a href="questao_form.php?id=<?= (int) $q['id'] ?>">Editar</a>
            <a href="questao_excluir.php?id=<?= (int) $q['id'] ?>">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php rodape(); ?>
