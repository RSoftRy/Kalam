<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h1>Resultado</h1>

<?php
if(isset($_POST['numeros'])) {

    $numeros = $_POST['numeros'];
    $positiv = [];
    $negativ = [];

    foreach($numeros as $num) {
        if($num >= 0) {
            $positiv[] = $num;
        } else {
            $negativ[] = $num;
        }
    }

    echo "<h2>Números Positivos:</h2>";
    foreach($positiv as $p) {
        echo $p . " ";
    }

    echo "<h2>Números Negativos:</h2>";
    foreach($negativ as $n) {
        echo $n . " ";
    }

} else {
    echo "Nenhum número foi colocado.";
}
?>

<br><br>
<a href="index.php">Voltar</a>

</body>
</html>