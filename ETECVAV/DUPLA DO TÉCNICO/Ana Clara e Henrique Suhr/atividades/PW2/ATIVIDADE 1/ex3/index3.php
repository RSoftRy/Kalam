<!--Exercício 3 - Calculadora Aritmética
Faça um programa que leia dois números e um operador ("+", "-", "*" ou "/").
O programa deve mostrar o resultado da operação.-->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>

<h1>Digite um número</h1>
<form action="processo3.php" method="post">
    <input type="number" name="n1" required>
    
    <h1>Digite outro número</h1>
    <input type="number" name="n2" required>
    
    <h1>Escolha um operador (+, -, * ou /)</h1>
    <input type="text" name="op" required>
    
    <button type="submit">Enviar</button>
</form>

</body>
</html>