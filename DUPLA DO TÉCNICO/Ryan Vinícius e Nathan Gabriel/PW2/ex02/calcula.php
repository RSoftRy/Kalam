<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h2>Resultado</h2>

<?php

if(isset($_POST['temp']) && isset($_POST['tipo'])) {

    $temp = $_POST['temp'];
    $tipo = $_POST['tipo'];

    if($tipo == "C") {
        // Celsius → Fahrenheit
        $resultado = ($temp * 9/5) + 32;
        echo "$temp °C equivale a $resultado °F";
    } 
    elseif($tipo == "F") {
        // Fahrenheit → Celsius
        $resultado = ($temp - 32) * 5/9;
        echo "$temp °F equivale a $resultado °C";
    } 
    else {
        echo "Tipo inválido.";
    }

} else {
    echo "Dados não enviados.";
}

?>

<br><br>
<a href="index.php">Voltar</a>

</body>
</html>