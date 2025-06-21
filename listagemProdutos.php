<?php
include_once "conexao.php";
include_once "protecao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos</title>
</head>
<body>
    <h1>Produtos Cadastrados</h1>
    <a href="cadastroProdutos.php">Cadastrar produtos</a>

    <?php 
    try {
        $stmt = $pdo->prepare("SELECT * FROM Produto");

        if ($stmt->execute()){
            while ($produto = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>

                <div>
                    <img src="assets/imagensProdutos/<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nomeProduto']) ?>">
                    <p>Nome:<?= htmlspecialchars($produto['nomeProduto'])?></p>
                    <p>Preço: R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                    <p>Descrição: <?= nl2br(htmlspecialchars($produto['descricao'])) ?></p>
                    <p>Estoque: <?= htmlspecialchars($produto['quantidadeEstoque']) ?></p>

                    <a href="deleteProdutos.php?id=<?= $produto['idProduto']?>">Excluir</a>
                    <a href="alterarProdutos.php?act=upd&id=<?= $produto['idProduto'] ?>">Alterar</a>
                </div>

                <?php
            }
        }
        
        
}catch (PDOException $erro){
    echo "Erro: ".$erro->getMessage();
}   
?>

</body>
</html>