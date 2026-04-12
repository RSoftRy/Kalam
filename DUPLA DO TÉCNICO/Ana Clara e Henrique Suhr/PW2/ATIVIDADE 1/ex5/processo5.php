<?php

function fatorial($num) {
    $res = 1;
    for ($i = 1; $i <= $num; $i++) {
        $res *= $i;
    }
    return $res;
}
   
$n1 = isset($_POST["n1"]) ? $_POST["n1"] : 0;
$n2 = isset($_POST["n2"]) ? $_POST["n2"] : 0;
$n3 = isset($_POST["n3"]) ? $_POST["n3"] : 0;
$n4 = isset($_POST["n4"]) ? $_POST["n4"] : 0;
$n5 = isset($_POST["n5"]) ? $_POST["n5"] : 0;
  
$a = fatorial($n1);
$b = fatorial($n2);
$c = fatorial($n3);
$d = fatorial($n4);
$e = fatorial($n5);

$res = $a + $b + $c + $d + $e;
$mensagem = "A soma dos fatoriais de $n1, $n2, $n3, $n4 e $n5 é igual a $res";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
</head>
<body>
    <h1>Resultado</h1>
    <p><?php echo $mensagem; ?></p>
    <a href="index5.php">Voltar</a>
</body>
</html>
