<?php

require_once 'config/conexao.php';

$mensagem = "";
$tipo_mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome       = trim($_POST['nome']);
    $fabricante = trim($_POST['fabricante']);
    $preco      = $_POST['preco'];
    $estoque    = $_POST['estoque'];

    if (empty($nome) || empty($fabricante) || empty($preco) || empty($estoque)) {
        $mensagem = "Por favor, preencha todos os campos.";
        $tipo_mensagem = "erro";
    } else {

        $sql  = "INSERT INTO produtos (nome, fabricante, preco, estoque) VALUES (:nome, :fabricante, :preco, :estoque)";
        $stmt = $conexao->prepare($sql);

        $sucesso = $stmt->execute([
            ':nome'       => $nome,
            ':fabricante' => $fabricante,
            ':preco'      => $preco,
            ':estoque'    => $estoque
        ]);

        if ($sucesso) {
            $mensagem = "Produto cadastrado com sucesso! (ID: " . $conexao->lastInsertId() . ")";
            $tipo_mensagem = "sucesso";
        } else {
            $mensagem = "Erro ao cadastrar o produto. Tente novamente.";
            $tipo_mensagem = "erro";
        }
    }
}
?>

<?php require_once 'includes/header.php'; ?>

<main class="container">
    <h1 class="page-title">Cadastro de Produto</h1>

    <?php if (!empty($mensagem)): ?>
        <div class="alerta alerta-<?= $tipo_mensagem ?>">
            <?= $mensagem ?>
        </div>
    <?php endif; ?>

    <form action="cadastro.php" method="POST" class="form-cadastro">

        <div class="form-grupo">
            <label for="nome">Nome do Produto</label>
            <input type="text" id="nome" name="nome" placeholder="Ex: Dipirona 500mg"
                   value="<?= isset($_POST['nome']) && $tipo_mensagem === 'erro' ? $_POST['nome'] : '' ?>"
                   required>
        </div>

        <div class="form-grupo">
            <label for="fabricante">Fabricante</label>
            <input type="text" id="fabricante" name="fabricante" placeholder="Ex: Medley"
                   value="<?= isset($_POST['fabricante']) && $tipo_mensagem === 'erro' ? $_POST['fabricante'] : '' ?>"
                   required>
        </div>

        <div class="form-grupo">
            <label for="preco">Preço (R$)</label>
            <input type="number" id="preco" name="preco" placeholder="Ex: 12.90"
                   step="0.01" min="0"
                   value="<?= isset($_POST['preco']) && $tipo_mensagem === 'erro' ? $_POST['preco'] : '' ?>"
                   required>
        </div>

        <div class="form-grupo">
            <label for="estoque">Quantidade em Estoque</label>
            <input type="number" id="estoque" name="estoque" placeholder="Ex: 100"
                   min="0"
                   value="<?= isset($_POST['estoque']) && $tipo_mensagem === 'erro' ? $_POST['estoque'] : '' ?>"
                   required>
        </div>

        <div class="form-acoes">
            <button type="submit" class="btn btn-primario">Salvar Produto</button>
            <a href="index.php" class="btn btn-secundario">Cancelar</a>
        </div>

    </form>
</main>

<?php require_once 'includes/footer.php'; ?>

</body>
</html>