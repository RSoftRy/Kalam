<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/layout.php';

exige_admin();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    redirecionar('questoes.php');
}

$st = $pdo->prepare('SELECT id, tema, enunciado FROM questoes WHERE id = ?');
$st->execute([$id]);
$q = $st->fetch();
if (!$q) {
    flash('Questão não encontrada.', 'erro');
    redirecionar('questoes.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_valido()) {
    $total = (int) $pdo->query('SELECT COUNT(*) FROM questoes')->fetchColumn();
    if ($total <= QTD_QUESTOES_PROVA) {
        flash('Não dá para excluir: o banco precisa manter pelo menos ' . QTD_QUESTOES_PROVA . ' questões para sortear a avaliação.', 'erro');
    } else {
        $pdo->prepare('DELETE FROM questoes WHERE id = ?')->execute([$id]);
        flash('Questão excluída.');
    }
    redirecionar('questoes.php');
}

cabecalho('Excluir questão', '../');
?>
<section class="cartao estreito">
  <h1>Excluir questão <?= (int) $q['id'] ?>?</h1>
  <p class="nota">Tema: <?= e($q['tema']) ?></p>
  <p class="enunciado"><?= nl2br(e(mb_strimwidth($q['enunciado'], 0, 400, '...'))) ?></p>
  <p>Essa ação não pode ser desfeita. Provas antigas que usaram a questão continuam no histórico, mas sem o texto dela.</p>
  <form method="post" class="acoes">
    <?= csrf_campo() ?>
    <button type="submit" class="botao perigo">Sim, excluir</button>
    <a class="botao secundario" href="questoes.php">Cancelar</a>
  </form>
</section>
<?php rodape(); ?>
