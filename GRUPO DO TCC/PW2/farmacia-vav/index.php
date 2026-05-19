<?php 
  require_once "config/conexao.php"; // Puxa o banco
  require_once 'includes/header.php'; // Puxa o topo visual
?>

<div class="espaco">
<h2 style="text-align: center">Bem-vindo à Farmácia VAV</h2>
<p style="text-align: center">Aqui você pode gerenciar a Fármacia VAV.</p> <br> <br>
</div>
<div style="padding:5px">
  
<table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Fabricante</th>
        <th>Preço</th>
        <th>Estoque</th>
    </tr>
<?php 
$sql = "SELECT * FROM produtos ORDER BY id ASC";
$stmt = $conexao->prepare($sql);
$stmt->execute();


// 3. BUSCAR TODOS (fetchAll):
// O PDO::FETCH_ASSOC organiza cada linha como um array associativo ['campo' => 'valor']
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 4. EXIBIR (O laço de repetição):
echo "<h2>Lista de Produtos</h2>";

if ($produtos) {
    foreach ($produtos as $produto) {
        echo  "<td>" . $produto['id'] . "</td>";
        echo  "<td>" . $produto['nome'] . "</td>";
        echo  "<td>" . $produto['fabricante'] . "</td>";
        echo  "<td>" . $produto['preco'] . "</td>";
        echo  "<td>" . $produto['estoque'] . "</td>";
        echo "<tr>";
    }
} else {
    echo "A lista está vazia.";
}
  ?>
  </table>
</div>
  
<?php
  require_once 'includes/footer.php'; // Puxa o final do site
?>
