<?php
require_once "config/conexao.php";
require_once 'includes/header.php';

$sql = "SELECT * FROM produtos ORDER BY id ASC";
$stmt = $conexao->prepare($sql);
$stmt->execute();
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="container">
    <div class="espaco">
        <h1 class="page-title">Bem-vindo à Farmácia VAV</h1>
        <p class="page-subtitle">Aqui você pode gerenciar a Farmácia VAV.</p>
    </div>

    <?php if ($produtos): ?>

        <!-- CARDS (mobile) -->
        <div class="cards-lista">
            <?php foreach ($produtos as $produto): ?>
            <div class="card-produto">
                <div class="card-nome"><?= htmlspecialchars($produto['nome']) ?></div>
                <div class="card-linha">
                    <span>Fabricante</span>
                    <span><?= htmlspecialchars($produto['fabricante']) ?></span>
                </div>
                <div class="card-linha">
                    <span>Preço</span>
                    <span>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></span>
                </div>
                <div class="card-linha">
                    <span>Estoque</span>
                    <span><?= (int) $produto['estoque'] ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- TABELA (desktop) -->
        <div class="tabela-wrapper">
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Fabricante</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                </tr>
                <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= (int) $produto['id'] ?></td>
                    <td><?= htmlspecialchars($produto['nome']) ?></td>
                    <td><?= htmlspecialchars($produto['fabricante']) ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td><?= (int) $produto['estoque'] ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

    <?php else: ?>
        <p class="page-subtitle">A lista está vazia.</p>
    <?php endif; ?>

</main>

<?php require_once 'includes/footer.php'; ?>