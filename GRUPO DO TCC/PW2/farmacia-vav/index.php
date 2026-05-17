<?php 
  require_once "config/conexao.php"; // Puxa o banco
  require_once 'includes/header.php'; // Puxa o topo visual
?>

<h2>Bem-vindo à Farmácia VAV</h2> <br>
<p>Aqui você pode gerenciar a Fármacia VAV.</p> <br> <br>
<?php 
$sql = "SELECT * FROM produtos ORDER BY id ASC";
$stmt = $conexao->prepare($sql);
$stmt->execute();


// 3. BUSCAR TODOS (fetchAll):
// O PDO::FETCH_ASSOC organiza cada linha como um array associativo ['campo' => 'valor']
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 4. EXIBIR (O laço de repetição):
echo "<h2>Lista de Produtos</h2>";
<br>
if ($produtos) {
    foreach ($produtos as $produto) {
        echo "ID: " . $produto['id'] . " | ";
        echo "Nome: " . $produto['nome'] . " | ";
        echo "Fabricante: " . $produto['fabricante'] . "<br>";
        echo "Preco: " . $produto['preco'] . "<br>";
        echo "Estoque: " . $produto['estoque'] . "<br>";
        echo "-----------------------------------<br>";
    }
} else {
    echo "A agenda está vazia.";
}
  

  require_once 'includes/footer.php'; // Puxa o final do site
?>
