<?php
include_once "conexao.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    if (
        !empty($_POST['nomeProduto']) &&
        !empty($_POST['preco']) &&
        !empty($_POST['descricao']) && 
        !empty($_POST['quantEstoque']) && isset($_FILES['imagemProduto']) && $_FILES['imagemProduto']['error'] === UPLOAD_ERR_OK
    ) {
        $nome = trim($_POST['nomeProduto']);
        $preco = trim($_POST['preco']);
        $descricao = trim($_POST['descricao']);
        $quantEstoque = trim($_POST['quantEstoque']);

        $stmtVerificando = $pdo->prepare("SELECT nomeProduto FROM Produto WHERE nomeProduto = :nome");
        $stmtVerificando->bindValue(':nome', $nome);
        $stmtVerificando->execute();

        if ($stmtVerificando->rowCount() > 0){
        header("Location: cadastroProdutos.php?erro=Este produto já está cadastrado.");
        exit;
        }

        $imagemNome = uniqid() . "_" . basename($_FILES['imagemProduto']['name']);
        $caminhoImagem = "assets/imagensProdutos/" . $imagemNome;

    

        if (move_uploaded_file($_FILES['imagemProduto']['tmp_name'],$caminhoImagem)) {

            try{
                $stmt = $pdo->prepare("INSERT INTO Produto (nomeProduto, preco, descricao, quantidadeEstoque, imagem) VALUES (:nome, :preco, :descricao, :estoque, :imagem)");

                $stmt->bindValue(':nome', $nome);
                $stmt->bindValue(':preco', $preco);
                $stmt->bindValue(':descricao', $descricao);
                $stmt->bindValue(':estoque', $quantEstoque);
                $stmt->bindValue(':imagem', $imagemNome);

                if ($stmt->execute()) {
                header("Location: cadastroProdutos.php?sucesso=Produto cadastrado com sucesso!");
                exit;
                } else {
                header("Location: cadastroProdutos.php?erro=Erro ao cadastrar produto.");
                exit;
                }
            }catch (PDOException $e) {
                header("Location: cadastroProdutos.php?erro=" . urlencode("Erro no banco de dados: " . $e->getMessage()));
                exit;
            }
    } else {
        header("Location: cadastroProdutos.php?erro=Falha no upload da imagem");
        exit;
    }
    } else {
        header("Location: cadastroProdutos.php?erro=Preencha todos os campos");
        exit;
    }
} else {
    header("Location: cadastroProdutos.php?erro=Requisição inválida.");
    exit;
}
?>