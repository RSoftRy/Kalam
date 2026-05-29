<?php
$n1 = isset($_POST["n1"]) ? $_POST["n1"] : 0;
$n2 = isset($_POST["n2"]) ? $_POST["n2"] : 0;
$n3 = isset($_POST["n3"]) ? $_POST["n3"] : 0;
$n4 = isset($_POST["n4"]) ? $_POST["n4"] : 0;
$n5 = isset($_POST["n5"]) ? $_POST["n5"] : 0;
$n6 = isset($_POST["n6"]) ? $_POST["n6"] : 0;
$n7 = isset($_POST["n7"]) ? $_POST["n7"] : 0;
$n8 = isset($_POST["n8"]) ? $_POST["n8"] : 0;

$vetorp = [];
$vetorn = [];
$vetort = [$n1, $n2, $n3, $n4, $n5, $n6, $n7, $n8];

$resultado = "";

for ($i = 0; $i < 8; $i++) {
    if ($vetort[$i] > 0) {
        $vetorp[] = $vetort[$i];
        $resultado .= "O número {$vetort[$i]} é positivo;<br>";
    } else if ($vetort[$i] < 0) {
        $vetorn[] = $vetort[$i];
        $resultado .= "O número {$vetort[$i]} é negativo;<br>";
    } else {
        $resultado .= "Número é igual a zero<br>";
    }
}
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
        <?php echo $resultado; ?>
    </p>

    <p><strong>Números positivos:</strong>
        <?php
        if (count($vetorp) > 0) {
            for ($i = 0; $i < count($vetorp); $i++) {
                echo $vetorp[$i] . " ";
            }
        } else {
            echo "Nenhum";
        }
        ?>
    </p>

    <p><strong>Números negativos:</strong>
        <?php
        if (count($vetorn) > 0) {
            for ($i = 0; $i < count($vetorn); $i++) {
                echo $vetorn[$i] . " ";
            }
        } else {
            echo "Nenhum";
        }
        ?>
    </p>

    <a href="index7.php">Voltar</a>
</body>

</html>