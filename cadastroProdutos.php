<?php
include_once "protecao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produtos</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body class="cadastrar-atualizar">
    <div class="link-voltar">
        <a href="listagemProdutos.php"> ← Voltar</a>
    </div>
    <div class="form-container">
        <p class="titulo">Cadastre seu produto</p>

        <?php if (isset($_GET['sucesso'])): ?>
            <div class="mensagem-sucesso">
                <?php echo htmlspecialchars($_GET['sucesso']); ?>
            </div>
        <?php elseif (isset($_GET['erro'])): ?>
            <div class="mensagem-erro">
                <?php echo htmlspecialchars($_GET['erro']); ?>
            </div>
        <?php endif; ?>

        <form action="cadastrarProdutos.php" method="POST" enctype="multipart/form-data">
            <label for="nomeProduto" class="label">Nome:</label>
            <input type="text" name="nomeProduto" id="nomeProduto" class="inputs">

            <label for="preco" class="label">Preço:</label>
            <input type="number" name="preco" id="preco" class="inputs">

            <label for="descricao" class="label">Descrição:</label>
            <input type="text" name="descricao" id="descricao" class="inputs">

            <label for="quantEstoque" class="label">Quantidade em estoque:</label>
            <input type="number" name="quantEstoque" id="quantEstoque" class="inputs">

            <label for="imagemProduto" class="label">Imagem do Produto:</label>
            <input type="file" name="imagemProduto" id="imagemProduto" accept="image/*" class="inputs"> 
            
            <button type="submit" class="button-cadastrar">CADASTRAR</button>
        </form>
    </div>
</body>
</html>