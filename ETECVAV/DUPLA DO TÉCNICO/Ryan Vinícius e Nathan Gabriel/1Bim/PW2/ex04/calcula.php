<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h2>Resultado</h2>

<?php

if(isset($_POST['n'])) {

    $n = $_POST['n'];

    for($i = 1; $i <= $n; $i++) {

        for($j = 1; $j <= $i; $j++) {
            echo $j . " ";
        }

        echo "<br>";
    }

} else {
    echo "Nenhum valor informado.";
}

?>

<br><br>
<a href="index.php">Voltar</a>

</body>
</html>