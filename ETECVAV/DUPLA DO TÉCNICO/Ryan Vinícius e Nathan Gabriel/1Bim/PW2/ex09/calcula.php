<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h1>Resultado</h1>

<?php

function media($v) {
    $soma = 0;
    $quant = count($v);

    foreach($v as $valor) {
        $soma += $valor;
    }

    return $soma / $quant;
}

if(isset($_POST['valores'])) {
    $numeros = $_POST['valores'];

    $resultado = media($numeros);

    echo "A média é: " . $resultado;

} else {
    echo "Nenhum valor informado.";
}

?>

<br><br>
<a href="index.php">Voltar</a>

</body>
</html>