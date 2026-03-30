<!--
Data: 29/03/2026
Autor: Ryan Vinícius Gomes
Objetivo:

Exercício 9 - Média Aritmética com Função
Crie uma função:

function media($v)

Que receba uma lista de números reais e retorne a média aritmética.
-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Média Aritmética com Função</title>
</head>
<body>
    <h1> Média Aritmética dos valores</h1>

    <form action="calcula.php" method="post">
    <?php
    for($i = 0; $i < 5; $i++) {
        echo "Número " . ($i+1) . ": ";
        echo "<input type='number' step='any' name='valores[]' required><br>";
    }
    ?>

    <input type="submit" value="Calcular Média">
</form>
    
</body>
</html>