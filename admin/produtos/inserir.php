<?php
include_once "../../conexao.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (
    isset($_POST['nomeProduto'], $_POST['preco'], $_POST['descricao'], $_POST['quantEstoque']) && 
    isset($_FILES['imagemProduto']) && 
    $_FILES['imagemProduto']['error'] === UPLOAD_ERR_OK){

    $nome = trim($_POST['nomeProduto']);
    $preco = trim($_POST['preco']);
    $descricao = trim($_POST['descricao']);
    $quantEstoque = trim($_POST['quantEstoque']);

    if (!$nome || !$preco || !$descricao || !$quantEstoque){
        exit("Por favor, preencha todos os campos");
    }

    $stmtVerificando = $pdo->prepare("SELECT nomeProduto FROM Produto WHERE nomeProduto = :nome");
    $stmtVerificando->execute([':nome' => $nome]);

    if ($stmtVerificando->rowCount()) {
        exit("Este produto já está cadastrado!");
    }

    $imagem = $_FILES['imagemProduto'];

    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
    $extensaoArquivo = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));

    if (!in_array($extensaoArquivo, $extensoesPermitidas)) {
        exit("Tipo de arquivo não permitido. Use jpg, jpeg, png ou gif.");
    }

    
    $diretorioUpload = __DIR__ . '/imagens/';
    $nomeArquivo = uniqid('img_') . '.' . $extensaoArquivo;
    $caminhoCompleto = $diretorioUpload . $nomeArquivo;

    if (!move_uploaded_file($imagem['tmp_name'], $caminhoCompleto)) {
        exit("Falha ao salvar a imagem.");
    }

    $stmt = $pdo->prepare("INSERT INTO Produto (nomeProduto, preco, descricao, quantidadeEstoque, imagem) VALUES (:nome, :preco, :descricao, :estoque, :imagem)");

    $stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindValue(':preco', $preco, PDO::PARAM_INT);
    $stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
    $stmt->bindValue(':estoque', $quantEstoque, PDO::PARAM_INT);
    $stmt->bindValue(':imagem', $nomeArquivo, PDO::PARAM_STR);

    if ($stmt->execute()) {
        // echo "Produto inserido com sucesso!";
        header("Location: listagem.php");
        exit;
    } else {
        echo "Erro ao inserir o produto.";
    }
}
?>