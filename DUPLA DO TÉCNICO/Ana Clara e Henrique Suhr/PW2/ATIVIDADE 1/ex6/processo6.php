<?php 
$n = isset($_POST["n"]) ? $_POST["n"] : 0;
$a = 0;
$b = 1;
$i = 1;

$resultado = "";

while ($i <= $n) {
    $resultado .= "$a ";
    $c = $a + $b;
    $a = $b;
    $b = $c;
    $i++;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h1>Resultado da Série de Fibonacci</h1>
<p><?php echo $resultado; ?></p>

<a href="index6.php">Voltar</a>

</body>
</html>
