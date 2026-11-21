<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/layout.php';

$u = usuario_logado();
if ($u && $u['tipo'] === 'admin') {
    redirecionar('index.php');
}

$erro = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valido()) {
        $erro = 'A sessão expirou. Envie o formulário de novo.';
    } else {
        $email = trim((string) ($_POST['email'] ?? ''));
        $senha = (string) ($_POST['senha'] ?? '');

        $st = $pdo->prepare("SELECT id, nome, senha_hash, tipo FROM usuarios WHERE email = ? AND tipo = 'admin' LIMIT 1");
        $st->execute([$email]);
        $a = $st->fetch();

        if ($a && password_verify($senha, $a['senha_hash'])) {
            iniciar_sessao_usuario($a);
            redirecionar('index.php');
        }
        $erro = 'E-mail ou senha de administrador incorretos.';
    }
}

cabecalho('Login de administrador', '../');
?>
<section class="cartao estreito">
  <h1>Login de administrador</h1>
  <?php if ($erro): ?><p class="aviso erro"><?= e($erro) ?></p><?php endif; ?>
  <form method="post" class="formulario">
    <?= csrf_campo() ?>
    <label>E-mail
      <input type="email" name="email" value="<?= e($email) ?>" required maxlength="150">
    </label>
    <label>Senha
      <input type="password" name="senha" required>
    </label>
    <button type="submit" class="botao">Entrar como admin</button>
  </form>
  <p class="nota">Ainda não tem conta de admin? <a href="cadastro.php">Cadastre-se com o código do grupo</a>.</p>
</section>
<?php rodape(); ?>
