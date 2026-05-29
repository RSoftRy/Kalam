<?php
$op = isset($_POST["op"]) ? $_POST["op"] : '';
$n1 = isset($_POST["n1"]) ? $_POST["n1"] : '';
$n2 = isset($_POST["n2"]) ? $_POST["n2"] : '';

if ($op == "+") {
    $res = $n1 + $n2;
    $mensagem = "O resultado é $res";
}
else if ($op == "-") {
    $res = $n1 - $n2;
    $mensagem = "O resultado é $res";
}
else if ($op == "/" && $n2 != 0) {
    $res = $n1 / $n2;
    $mensagem = "O resultado é $res";
}
else if ($op == "*") {
    $res = $n1 * $n2;
    $mensagem = "O resultado é $res";
}
else {
    $mensagem = "Operador inválido ou divisão por zero.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h1>Resultado da Operação</h1>
<p><?php echo $mensagem; ?></p>

<a href="index3.php">Voltar</a>

</body>
</html>