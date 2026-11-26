<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/layout.php';

$u = exige_login();
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    redirecionar('trilha.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_valido()) {
    $st = $pdo->prepare('INSERT IGNORE INTO progresso (usuario_id, aula_id) VALUES (?, ?)');
    $st->execute([$u['id'], $id]);
    flash('Aula marcada como concluída.');
    redirecionar('aula.php?id=' . $id);
}

$st = $pdo->prepare('SELECT a.*, m.titulo AS modulo_titulo FROM aulas a JOIN modulos m ON m.id = a.modulo_id WHERE a.id = ?');
$st->execute([$id]);
$aula = $st->fetch();

if (!$aula) {
    http_response_code(404);
    cabecalho('Aula não encontrada');
    echo '<p class="aviso erro">Aula não encontrada.</p><p><a href="trilha.php">Voltar à trilha</a></p>';
    rodape();
    exit;
}

$st = $pdo->prepare('SELECT 1 FROM progresso WHERE usuario_id = ? AND aula_id = ?');
$st->execute([$u['id'], $id]);
$concluida = (bool) $st->fetchColumn();

$st = $pdo->prepare('SELECT id FROM aulas WHERE id < ? ORDER BY id DESC LIMIT 1');
$st->execute([$id]);
$anterior = $st->fetchColumn();

$st = $pdo->prepare('SELECT id FROM aulas WHERE id > ? ORDER BY id ASC LIMIT 1');
$st->execute([$id]);
$proxima = $st->fetchColumn();

$video = (string) ($aula['video_url'] ?? '');
$videoOk = strpos($video, 'https://') === 0;

cabecalho($aula['titulo']);
?>
<p class="migalha"><a href="trilha.php">Trilha</a> / Módulo <?= (int) $aula['modulo_id'] ?>: <?= e($aula['modulo_titulo']) ?></p>
<article class="aula">
  <h1>Aula <?= (int) $aula['id'] ?>: <?= e($aula['titulo']) ?></h1>

  <?= $aula['conteudo'] /* conteúdo inserido pelo grupo no banco, não vem de usuários */ ?>

  <?php if ($videoOk): ?>
    <p class="video"><a class="botao secundario" href="<?= e($video) ?>" target="_blank" rel="noopener">Assistir videoaula no YouTube</a></p>
  <?php endif; ?>

  <aside class="documento">
    <h2>Documento histórico: <?= e($aula['doc_titulo']) ?></h2>
    <p><?= e($aula['doc_resumo']) ?></p>
  </aside>

  <?php if ($concluida): ?>
    <p class="selo grande">Aula concluída</p>
  <?php else: ?>
    <form method="post">
      <?= csrf_campo() ?>
      <button type="submit" class="botao">Marcar como concluída</button>
    </form>
  <?php endif; ?>

  <nav class="paginacao">
    <?php if ($anterior): ?><a href="aula.php?id=<?= (int) $anterior ?>">Aula anterior</a><?php else: ?><span></span><?php endif; ?>
    <?php if ($proxima): ?><a href="aula.php?id=<?= (int) $proxima ?>">Próxima aula</a><?php else: ?><a href="prova.php">Ir para a avaliação</a><?php endif; ?>
  </nav>
</article>
<?php rodape(); ?>
