<?php
$ano = isset($_POST["ano"]) ? $_POST["ano"] : 0;

function bissexto($ano) {
    if (($ano % 400 == 0) || ($ano % 4 == 0 && $ano % 100 != 0)) {
        return true;
    } else {
        return false;
    }
}

$resultado = bissexto($ano);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <h1>Resultado</h1>
    <p>
        <?php 
        if ($resultado) {
            echo "O ano $ano é bissexto.";
        } else {
            echo "O ano $ano não é bissexto.";
        }
        ?>
    </p>
    <a href="index10.php">Voltar</a>
</body>
</html>
