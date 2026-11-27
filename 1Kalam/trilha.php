<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/layout.php';

$u = exige_login();

$modulos = $pdo->query('SELECT id, titulo, descricao FROM modulos ORDER BY id')->fetchAll();
$aulas = $pdo->query('SELECT id, modulo_id, titulo FROM aulas ORDER BY id')->fetchAll();

$st = $pdo->prepare('SELECT aula_id FROM progresso WHERE usuario_id = ?');
$st->execute([$u['id']]);
$feitas = array_flip(array_column($st->fetchAll(), 'aula_id'));

$porModulo = [];
foreach ($aulas as $a) {
    $porModulo[$a['modulo_id']][] = $a;
}

$total = count($aulas);
$concluidas = count($feitas);

cabecalho('Trilha do conhecimento');
?>
<h1>Trilha do conhecimento</h1>
<p class="progresso-texto">Você concluiu <strong><?= $concluidas ?></strong> de <strong><?= $total ?></strong> aulas.</p>
<progress class="barra" value="<?= $concluidas ?>" max="<?= max($total, 1) ?>"></progress>

<ol class="trilha">
  <?php foreach ($modulos as $m): ?>
    <li class="modulo" data-n="<?= (int) $m['id'] ?>">
      <div class="modulo-cartao">
        <h2>Módulo <?= (int) $m['id'] ?></h2>
        <p class="modulo-titulo"><?= e($m['titulo']) ?></p>
        <p class="modulo-desc"><?= e($m['descricao']) ?></p>
        <ul class="lista-aulas">
          <?php foreach ($porModulo[$m['id']] ?? [] as $a): ?>
            <li>
              <a href="aula.php?id=<?= (int) $a['id'] ?>">Aula <?= (int) $a['id'] ?>: <?= e($a['titulo']) ?></a>
              <?php if (isset($feitas[$a['id']])): ?><span class="selo">Concluída</span><?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </li>
  <?php endforeach; ?>
</ol>

<section class="cartao destaque">
  <h2>Avaliação final</h2>
  <p>São <?= (int) QTD_QUESTOES_PROVA ?> questões sorteadas do banco. No fim você vê o gabarito e a sua pontuação.</p>
  <a class="botao" href="prova.php">Ir para a avaliação</a>
</section>
<?php rodape(); ?>
