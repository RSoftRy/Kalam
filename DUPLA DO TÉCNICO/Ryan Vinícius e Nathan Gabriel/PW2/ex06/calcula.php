<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>

<h1>Resultado</h1>

<?php
if(isset($_POST['n'])) {
    $n = $_POST['n'];

    if($n <= 0) {
        echo "Digite um número maior que 0.";
    } else {
        $a = 0;
        $b = 1;

        echo "$a ";

        if($n > 1) {
            echo "$b ";
        }

        for($i = 2; $i < $n; $i++) {
            $c = $a + $b;
            echo "$c ";
            $a = $b;
            $b = $c;
        }
    }
} else {
    echo "Nenhum valor foi inserido.";
}
?>

<br><br>
<a href="index.php">Voltar</a>

</body>
</html>