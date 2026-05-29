<?php
if (isset($_POST["n"])) {
    $numero = $_POST["n"];

    if ($numero >= 100 && $numero <= 200) {
        $mensagem = "O número $numero está entre 100 e 200";
    } else {
        $mensagem = "O número $numero NÃO está entre 100 e 200";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h1>Resultado</h1>

<?php 
if (isset($mensagem)) { 
    ?>
    <p>
        <?php
         echo $mensagem; 
         ?>
<?php
 } 
 ?>

<a href="index1.php">Voltar</a>

</body>
</html>