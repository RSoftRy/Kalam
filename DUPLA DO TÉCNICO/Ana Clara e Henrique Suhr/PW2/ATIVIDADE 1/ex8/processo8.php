<?php
$n = isset($_POST["n"]) ? $_POST["n"] : 0;

function soma($n) {
    $soma = 0; 
    for ($i = 0; $i <= $n; $i++) { 
        $soma += $i; 
    }
    return $soma;
}

$resultado = soma($n);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <h1>Resultado</h1>
    <p><?php echo "A soma de 0 a $n é igual a $resultado"; ?></p>
    <a href="index8.php">Voltar</a>
</body>
</html>
