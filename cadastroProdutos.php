<?php
include_once "protecao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos</title>
</head>
<body>
    <form action="inserirProdutos.php" method="POST" enctype="multipart/form-data">
        <label for="nomeProduto">Nome:</label>
        <input type="text" name="nomeProduto" id="nomeProduto">

        <label for="preco">Preço:</label>
        <input type="number" name="preco" id="preco">

        <label for="descricao">Descrição:</label>
        <input type="textaerea" name="descricao" id="descricao">

        <label for="quantEstoque">Quantidade em estoque:</label>
        <input type="number" name="quantEstoque" id="quantEstoque">

        <label for="imagemProduto">Imagem do Produto:</label>
        <input type="file" name="imagemProduto" id="imagemProduto" accept="image/*">
        
        <button type="submit">CADASTRAR</button>
    </form>
</body>
</html>