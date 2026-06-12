<?php
$fc = isset($_POST["fc"]) ? $_POST["fc"] : '';
$n  = isset($_POST["n"]) ? $_POST["n"] : '';

if ($fc == "F") {
    $C = 5/9 * ($n - 32);
    $mensagem = "A temperatura em Celsius é $C";
}
else if ($fc == "C") {
    $F = ($n * 9/5) + 32;
    $mensagem = "A temperatura em Fahrenheit é $F";
}
else {
    $mensagem = "Digite 'F' ou 'C' corretamente.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h1>Resultado da Conversão</h1>
<p><?php echo $mensagem; ?></p>

<a href="index2.php">Voltar</a>

</body>
</html>
