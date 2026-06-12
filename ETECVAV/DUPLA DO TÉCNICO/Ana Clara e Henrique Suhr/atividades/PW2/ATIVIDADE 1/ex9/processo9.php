<?php
$n1 = isset($_POST["n1"]) ? $_POST["n1"] : 0;
$n2 = isset($_POST["n2"]) ? $_POST["n2"] : 0;
$n3 = isset($_POST["n3"]) ? $_POST["n3"] : 0;

$vetor = [$n1, $n2, $n3];

function media($vetor)
{
    $soma = 0;
    for ($i = 0; $i < count($vetor); $i++) {
        $soma += $vetor[$i];
    }
    $media = $soma / count($vetor);
    return $media;
}

$resultado = media($vetor);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>

<body>
    <h1>Resultado</h1>
    <p><?php echo "A média é: $resultado"; ?></p>
    <a href="index9.php">Voltar</a>
</body>

</html>