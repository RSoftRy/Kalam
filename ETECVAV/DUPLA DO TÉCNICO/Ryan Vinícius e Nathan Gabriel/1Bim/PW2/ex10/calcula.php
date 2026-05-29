<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h1>Resultado</h1>

<?php

if(isset($_POST['ano'])) {

    $ano = $_POST['ano'];

    if(($ano % 400 == 0) || ($ano % 4 == 0 && $ano % 100 != 0)) {
        echo "O ano $ano é bissexto.";
    } else {
        echo "O ano $ano não é bissexto.";
    }

} else {
    echo "Nenhum ano inserido.";
}

?>

<br><br>
<a href="index.php">Voltar</a>

</body>
</html>