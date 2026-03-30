<!--
Data: 02/03/2026
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

    <form action="Calculo.php" method="get"> 
    <label> Digite a temperatura: </label>
        <input type="number" name="n1" step="any" required>
        <br><br>

        <label> Digite o tipo de temperatura deseja converter:</label>
        <input type="text" name="temp" step="any" required>

        <input type="submit" value="Calculo">
        
    </form>
    
</body>
</html>