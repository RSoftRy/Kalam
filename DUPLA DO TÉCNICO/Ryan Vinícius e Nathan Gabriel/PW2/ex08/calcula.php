<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h1>Resultado</h1>

<?php
function soma($n) {
    $total = 0;

    for($i = 0; $i <= $n; $i++) {
        $total += $i;
    }

    return $total;
}

if(isset($_POST['n'])) {
    $n = $_POST['n'];

    if($n < 0) {
        echo "Digite um número inteiro positivo";
    } else {
        $resultado = soma($n);
        echo "A soma de 0 até $n é: $resultado";
    }
} else {
    echo "Nenhum valor colocado";
}
?>
<br><br>
<a href="index.php">Voltar</a>

</body>
</html>