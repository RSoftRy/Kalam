<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h2>Resultado</h2>

<?php

// Função para calcular fatorial
function fatorial($n) {
    $fat = 1;

    for($i = 1; $i <= $n; $i++) {
        $fat *= $i;
    }

    return $fat;
}

if(isset($_POST['numeros'])) {

    $numeros = $_POST['numeros'];
    $soma = 0;

    foreach($numeros as $num) {

        if($num < 0) {
            echo "Não existe fatorial de número negativo.<br>";
            continue;
        }

        $soma += fatorial($num);
    }

    echo "A soma dos fatoriais é: " . $soma;

} else {
    echo "Nenhum valor informado.";
}

?>

<br><br>
<a href="index.php">Voltar</a>

</body>
</html>