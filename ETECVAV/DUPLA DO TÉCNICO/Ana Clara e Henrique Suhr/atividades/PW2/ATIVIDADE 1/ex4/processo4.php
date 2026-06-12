<?php
$n = isset($_POST["n"]) ? $_POST["n"] : '';
$i = 0;

$resultado = "";

while ($i <= $n) {
    $j = 1;
    while ($j <= $i) {
        $resultado .= "$j ";
        $j++;
    }
    $resultado .= "<br>";
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

<h1>Triângulo Numérico</h1>
<p><?php echo $resultado; ?></p>

<a href="index4.php">Voltar</a>

</body>
</html>
