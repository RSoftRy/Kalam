<?php
require_once 'config/conexao.php'; // ← seu arquivo

$mensagem = null;
$produto  = null;

// --- FASE 1: Salvar edição (POST) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar'])) {
    $id         = (int) $_POST['id'];
    $nome       = trim($_POST['nome']);
    $fabricante = trim($_POST['fabricante']);
    $preco      = str_replace(',', '.', $_POST['preco']);
    $estoque    = (int) $_POST['estoque'];

    if ($id > 0 && $nome !== '' && $fabricante !== '' && is_numeric($preco) && $estoque >= 0) {
        $stmt = $conexao->prepare("
            UPDATE produtos
            SET nome = ?, fabricante = ?, preco = ?, estoque = ?
            WHERE id = ?
        ");

        // PDO: passa os valores direto no execute()
        $stmt->execute([$nome, $fabricante, $preco, $estoque, $id]);

        if ($stmt->rowCount() > 0) {
            $mensagem = ['tipo' => 'sucesso', 'texto' => 'Produto atualizado com sucesso!'];
        } else {
            $mensagem = ['tipo' => 'erro', 'texto' => 'Nenhuma alteração foi salva.'];
        }

        // Recarrega o produto atualizado
        $stmt = $conexao->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

    } else {
        $mensagem = ['tipo' => 'erro', 'texto' => 'Preencha todos os campos corretamente.'];
    }
}

// --- FASE 2: Buscar produto pelo ID (GET) ---
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($id > 0) {
        $stmt = $conexao->prepare("SELECT * FROM produtos WHERE id = ?");
        $stmt->execute([$id]);
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$produto) {
            $mensagem = ['tipo' => 'erro', 'texto' => "Nenhum produto encontrado com ID $id."];
        }
    }
}

require_once 'includes/header.php';
?>

<main class="container">
<h1 class="page-title">Editar Produto</h1>

<form method="GET" action="editar.php" class="form-cadastro">
    <div class="form-grupo">
    <label>Buscar por ID:
        <input type="number" name="id" min="1"
               value="<?= isset($_GET['id']) ? (int)$_GET['id'] : '' ?>"
               placeholder="Digite o ID do produto">
    </label>
    <button type="submit" class="btn btn-primario">Buscar</button>
    </div>
</form>

<?php if ($mensagem): ?>
    <p class="msg-<?= $mensagem['tipo'] ?>">
        <?= htmlspecialchars($mensagem['texto']) ?>
    </p>
<?php endif; ?>

<?php if ($produto): ?>

<hr>
<h3 class="page-subtitle">Editando: <?= htmlspecialchars($produto['nome']) ?> (ID <?= (int)$produto['id'] ?>)</h3>

<form method="POST" action="editar.php" class="form-cadastro">
    <input type="hidden" name="id" value="<?= (int) $produto['id'] ?>">

        <div class="form-grupo">
    <label>Nome:
        <input type="text" name="nome"
               value="<?= htmlspecialchars($produto['nome']) ?>" required>
    </label><br>
    </div>
    <div class="form-grupo">
    
    <label>Fabricante:
        <input type="text" name="fabricante"
               value="<?= htmlspecialchars($produto['fabricante']) ?>" required>
    </label><br>
    </div>
    <div class="form-grupo">
    <label>Preço (R$):
        <input type="text" name="preco"
               value="<?= number_format($produto['preco'], 2, ',', '.') ?>" required>
    </label><br>
    </div>
    <div class="form-grupo">
    <label>Estoque:
        <input type="number" name="estoque" min="0"
               value="<?= (int) $produto['estoque'] ?>" required>
</div>
</label><br>

    <div class="form-acoes">
    <button type="submit" name="salvar" class="btn btn-primario">Salvar alterações</button>
    <a href="editar.php" class="btn btn-secundario">Cancelar</a>
    </div>
</form>
</main>
<?php endif; ?>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php require_once 'includes/footer.php'; ?>
