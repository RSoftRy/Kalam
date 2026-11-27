<?php
function cabecalho(string $titulo, string $raiz = ''): void
{
    $u = usuario_logado();
    ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($titulo) ?> | Kalam</title>
<link rel="stylesheet" href="<?= e($raiz) ?>css/style.css">
</head>
<body>
<header class="topo">
  <a class="marca" href="<?= e($raiz) ?>index.php">KALAM</a>
  <input type="checkbox" id="menu-toggle" class="menu-toggle">
  <label for="menu-toggle" class="menu-botao">Menu</label>
  <nav class="menu">
    <?php if ($u): ?>
      <a href="<?= e($raiz) ?>trilha.php">Trilha</a>
      <a href="<?= e($raiz) ?>prova.php">Avaliação final</a>
      <?php if ($u['tipo'] === 'admin'): ?>
        <a href="<?= e($raiz) ?>admin/index.php">Painel admin</a>
      <?php endif; ?>
      <form method="post" action="<?= e($raiz) ?>logout.php" class="form-sair">
        <?= csrf_campo() ?>
        <button type="submit" class="link-botao">Sair (<?= e($u['nome']) ?>)</button>
      </form>
    <?php else: ?>
      <a href="<?= e($raiz) ?>login.php">Entrar</a>
      <a href="<?= e($raiz) ?>cadastro.php">Cadastrar-se</a>
      <a href="<?= e($raiz) ?>admin/login.php">Área admin</a>
    <?php endif; ?>
  </nav>
</header>
<main class="conteudo">
<?php
    if (!empty($_SESSION['flash'])) {
        $f = $_SESSION['flash'];
        unset($_SESSION['flash']);
        echo '<p class="aviso ' . e($f['tipo']) . '">' . e($f['msg']) . '</p>';
    }
}

function rodape(): void
{
    ?>
</main>
<footer class="rodape">
  <p>Grupo Kalam. Revolução Russa, comunismo e capitalismo.</p>
</footer>
</body>
</html>
<?php
}
