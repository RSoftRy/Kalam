<!--
Data: 29/03/2026
Autor: Ryan Vinícius Gomes e Nathan Gabriel
Objetivo:

Exercício 7 - Separar Positivos e Negativos
Leia 8 números inteiros e separe em dois vetores:

Um vetor com números positivos
Um vetor com números negativos
-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=
    , initial-scale=1.0">
    <title>Positivos e Negativos</title>
</head>
<body>
    
</body>
</html>
<h1>Digite 8 números inteiros</h1>

<form action="calcula.php" method="post">
    <?php
    for($i = 0; $i < 8; $i++) {
        echo "Número " . ($i+1) . ": ";
        echo "<input type='number' name='numeros[]' required><br><br>";
    }
    ?>

    <input type="submit" value="Separar">
</form>

</body>
</html>