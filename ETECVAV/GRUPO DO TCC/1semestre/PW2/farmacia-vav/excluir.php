<?php
require_once "config/conexao.php";

$mensagem = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    if ($id > 0) {
        $stmt = $conexao->prepare("DELETE FROM produtos WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            $mensagem = ['tipo' => 'sucesso', 'texto' => 'Produto excluído com sucesso!'];
        } else {
            $mensagem = ['tipo' => 'erro', 'texto' => 'Produto não encontrado.'];
        }
    }
}

$stmt = $conexao->prepare("SELECT id, nome, fabricante, preco, estoque FROM produtos ORDER BY id ASC");
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once 'includes/header.php';
?>

<main class="container">
<h2 class="page-title">Exclusão de Produtos</h2>

<?php if ($mensagem): ?>
    <p class="msg-<?= $mensagem['tipo'] ?>">
        <?= htmlspecialchars($mensagem['texto']) ?>
    </p>
<?php endif; ?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Fabricante</th>
        <th>Preço</th>
        <th>Estoque</th>
        <th>Ação</th>
    </tr>

    <?php foreach ($produtos as $linha): ?>
    <tr>
        <td><?= (int) $linha['id'] ?></td>
        <td><?= htmlspecialchars($linha['nome']) ?></td>
        <td><?= htmlspecialchars($linha['fabricante']) ?></td>
        <td>R$ <?= number_format($linha['preco'], 2, ',', '.') ?></td>
        <td><?= (int) $linha['estoque'] ?></td>
        <td>
            <form method="POST" action="excluir.php" style="display:inline"
                  onsubmit="return confirm('Excluir <?= htmlspecialchars($linha['nome'], ENT_QUOTES) ?>?')">
                <input type="hidden" name="id" value="<?= (int) $linha['id'] ?>">
                <button type="submit" class="btn btn-secundario" >Excluir</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
    </main>
<?php require_once 'includes/footer.php'; ?>
