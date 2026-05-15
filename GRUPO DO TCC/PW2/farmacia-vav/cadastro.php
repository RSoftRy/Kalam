<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Farmácia</title>
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<h1>Cadastro de Produtos</h1>

<form action="salvar.php" method="POST">
    Nome:
    <input type="text" name="nome"><br><br>
    Fabricante:
    <input type="text" name="fabricante"><br><br>
    Preço:
    <input type="text" name="preco"><br><br>
    Estoque:
    <input type="text" name="estoque"><br><br>

    <button type="submit">Salvar</button>
</form>
<br> 
<a href="listar.php">Ver Produtos</a>

</body>
</html>