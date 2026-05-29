<!--
Data: 29/03/2026
Autor: Nathan Gabriel e Ryan Vinícius
Objetivo:
Exercício 5 - Somatório de Fatoriais
 Leia 5 números inteiros e mostre a soma dos fatoriais 
desses números
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Somatório de Fatoriais </title>
</head>
<body>
    <form action="calcula.php" method="post">
    <?php
    for($i = 0; $i < 5; $i++) {
        echo "Número " . ($i+1) . ": ";
        echo "<input type='number' name='numeros[]' required><br><br>";
    }
    ?>

    <input type="submit" value="Calcular">
</form>

</body>
</html>