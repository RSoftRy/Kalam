<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/layout.php';

if (usuario_logado()) {
    redirecionar('trilha.php');
}

$erro = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valido()) {
        $erro = 'A sessão expirou. Envie o formulário de novo.';
    } else {
        $email = trim((string) ($_POST['email'] ?? ''));
        $senha = (string) ($_POST['senha'] ?? '');

        $st = $pdo->prepare('SELECT id, nome, senha_hash, tipo FROM usuarios WHERE email = ? LIMIT 1');
        $st->execute([$email]);
        $u = $st->fetch();

        if ($u && password_verify($senha, $u['senha_hash'])) {
            if ($u['tipo'] === 'admin') {
                $erro = 'Esta conta é de administrador. Use o login em Área admin.';
            } else {
                iniciar_sessao_usuario($u);
                redirecionar('trilha.php');
            }
        } else {
            $erro = 'E-mail ou senha incorretos.';
        }
    }
}

cabecalho('Entrar');
?>
<section class="cartao estreito">
  <h1>Entrar</h1>
  <?php if ($erro): ?><p class="aviso erro"><?= e($erro) ?></p><?php endif; ?>
  <form method="post" class="formulario">
    <?= csrf_campo() ?>
    <label>E-mail
      <input type="email" name="email" value="<?= e($email) ?>" required maxlength="150" autocomplete="email">
    </label>
    <label>Senha
      <input type="password" name="senha" required autocomplete="current-password">
    </label>
    <button type="submit" class="botao">Entrar</button>
  </form>
  <p class="nota">Ainda não tem conta? <a href="cadastro.php">Cadastre-se</a>.</p>
</section>
<?php rodape(); ?>
