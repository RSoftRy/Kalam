<!--
Data: 29/03/2026
Autor: Ryan Vinícius Gomes
Objetivo:

Exercício 10 - Ano Bissexto
Leia um ano e informe se ele é bissexto.

Um ano é bissexto se:

É múltiplo de 400
ou
É múltiplo de 4 e não é múltiplo de 100
-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculo de Ano Bissexto</title>
</head>
<body>
    <h1>Calcular se é um Ano Bissexto</h1>

<form action="calcula.php" method="post">
    Digite um ano:
    <input type="number" name="ano" required>
    <br><br>
    <input type="submit" value="Verificar">
</form>
</body>
</html>
