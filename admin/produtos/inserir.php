<?php
include_once "conexao.php";

if (isset($_POST['nomeProduto'], $_POST['preco'], $_POST['descricao'], $_POST['quantEstoque'])){

    $nome = trim($_POST['nomeProduto']);
    $preco = trim($_POST['preco']);
    $descricao = trim($_POST['descricao']);
    $quantEstoque = trim($_POST['quantEstoque']);

    if (!$nome || !$preco || !$descricao || !$quantEstoque){
        exit("Por favor, preencha todos os campos");
    }

    else{
        $stmtVerificando = $pdo->prepare("SELECT nomeProduto FROM Produto WHERE nomeProduto = :nome");

        $stmtVerificando->execute([':nome' => $nome]);

        if ($stmtVerificando->rowCount()) {
            exit("Este produto já está cadastrado!");
        }

        $stmt = $pdo->prepare("INSERT INTO Produto (nomeProduto, preco, descricao, quantidadeEstoque) VALUES (:nome, :preco, :descricao, :estoque)");

        $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindValue(':preco', $preco, PDO::PARAM_STR);
        $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
        $stmt->bindValue(':estoque', $quantEstoque, PDO::PARAM_STR);

        if ($stmt->execute()) {
        echo "Produto inserido com sucesso!";
        } else {
        echo "Erro ao inserir o produto.";
        }
    }


}
?>