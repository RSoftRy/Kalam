<?php
require_once __DIR__ . '/../includes/bootstrap.php';
require_once __DIR__ . '/../includes/layout.php';

$erros = [];
$nome = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_valido()) {
        $erros[] = 'A sessão expirou. Envie o formulário de novo.';
    } else {
        $nome   = trim((string) ($_POST['nome'] ?? ''));
        $email  = trim((string) ($_POST['email'] ?? ''));
        $senha  = (string) ($_POST['senha'] ?? '');
        $senha2 = (string) ($_POST['senha2'] ?? '');
        $codigo = (string) ($_POST['codigo'] ?? '');

        if (!hash_equals(ADMIN_CODE, $codigo)) {
            $erros[] = 'Código de administrador incorreto.';
        }
        if (mb_strlen($nome) < 2 || mb_strlen($nome) > 100) {
            $erros[] = 'Informe um nome com 2 a 100 caracteres.';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
            $erros[] = 'Informe um e-mail válido.';
        }
        if (strlen($senha) < 8) {
            $erros[] = 'A senha de administrador precisa ter pelo menos 8 caracteres.';
        }
        if ($senha !== $senha2) {
            $erros[] = 'As senhas não conferem.';
        }

        if (!$erros) {
            try {
                $st = $pdo->prepare('INSERT INTO usuarios (nome, email, senha_hash, tipo) VALUES (?, ?, ?, ?)');
                $st->execute([$nome, $email, password_hash($senha, PASSWORD_DEFAULT), 'admin']);
                iniciar_sessao_usuario(['id' => $pdo->lastInsertId(), 'nome' => $nome, 'tipo' => 'admin']);
                redirecionar('index.php');
            } catch (PDOException $ex) {
                if ($ex->getCode() === '23000') {
                    $erros[] = 'Já existe uma conta com esse e-mail.';
                } else {
                    throw $ex;
                }
            }
        }
    }
}

cabecalho('Cadastro de administrador', '../');
?>
<section class="cartao estreito">
  <h1>Cadastro de administrador</h1>
  <?php foreach ($erros as $m): ?><p class="aviso erro"><?= e($m) ?></p><?php endforeach; ?>
  <form method="post" class="formulario">
    <?= csrf_campo() ?>
    <label>Nome
      <input type="text" name="nome" value="<?= e($nome) ?>" required maxlength="100">
    </label>
    <label>E-mail
      <input type="email" name="email" value="<?= e($email) ?>" required maxlength="150">
    </label>
    <label>Senha (mínimo 8 caracteres)
      <input type="password" name="senha" required minlength="8" autocomplete="new-password">
    </label>
    <label>Repita a senha
      <input type="password" name="senha2" required minlength="8" autocomplete="new-password">
    </label>
    <label>Código de administrador
      <input type="password" name="codigo" required>
    </label>
    <button type="submit" class="botao">Criar conta de admin</button>
  </form>
</section>
<?php rodape(); ?>
