<!--
Data: 29/03/2026
Autor: Nathan Gabriel e Ryan Vinícius
Objetivo:
Exercício 2 - Faça um programa que leia um caractere "F" ou "C", indicando se o valor informado está em Fahrenheit ou Celsius.
Depois, o programa deve converter para a outra unidade.
-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversão de temperatura</title>
</head>
<body>

<h1>Conversão de Temperatura</h1>

<form action="calcula.php" method="post">
    Digite a temperatura:
    <input type="number" step="any" name="temp" required>
    <br><br>

    Tipo:
    <select name="tipo">
        <option value="C">Celsius</option>
        <option value="F">Fahrenheit</option>
    </select>

    <br><br>
    <input type="submit" value="Converter">
</form>
    
</body>
</html>