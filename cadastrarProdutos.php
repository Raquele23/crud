<?php
include_once "conexao.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "oiii";

if (empty($_POST['nomeProduto']) || empty($_POST['preco']) || empty($_POST['descricao']) || empty($_POST['quantEstoque']) || !isset($_FILES['imagemProduto']) || $_FILES['imagemProduto']['error'] === UPLOAD_ERR_OK){

    header("Location: cadastroProdutos.php?erro=Preencha todos os campos.");
    exit;
}

$nome = trim($_POST['nomeProduto']);
$preco = trim($_POST['preco']);
$descricao = trim($_POST['descricao']);
$quantEstoque = trim($_POST['quantEstoque']);

$stmtVerificando = $pdo->prepare("SELECT nomeProduto FROM Produto WHERE nomeProduto = :nome");
$stmtVerificando->execute([':nome' => $nome]);

if ($stmtVerificando->rowCount()>0){
    header("Location: cadastroProdutos.php?erro=Este produto já está cadastrado.");
    exit;
}

$imagem = $_FILES['imagemProduto'];
$extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];
$extensaoArquivo = strtolower(pathinfo($imagem['name'], PATHINFO_EXTENSION));

if (!in_array($extensaoArquivo, $extensoesPermitidas)) {
    header("Location: cadastroProdutos.php?erro=Tipo de arquivo não permitido.");
    exit;
}

    
$diretorioUpload = __DIR__ . '/assets/imagensProdutos/';
$nomeArquivo = uniqid('img_') . '.' . $extensaoArquivo;
$caminhoCompleto = $diretorioUpload . $nomeArquivo;

if (!move_uploaded_file($imagem['tmp_name'], $caminhoCompleto)) {
    header("Location: cadastroProdutos.php?erro=Falha ao salvar a imagem.");
    exit;
}

$stmt = $pdo->prepare("INSERT INTO Produto (nomeProduto, preco, descricao, quantidadeEstoque, imagem) VALUES (:nome, :preco, :descricao, :estoque, :imagem)");

$stmt->bindValue(':nome', $nome, PDO::PARAM_STR);
$stmt->bindValue(':preco', $preco, PDO::PARAM_INT);
$stmt->bindValue(':descricao', $descricao, PDO::PARAM_STR);
$stmt->bindValue(':estoque', $quantEstoque, PDO::PARAM_INT);
$stmt->bindValue(':imagem', $nomeArquivo, PDO::PARAM_STR);

if ($stmt->execute()) {
    // echo "Produto inserido com sucesso!";
    header("Location: listagemProdutos.php");
    exit;
} else {
    header("Location: cadastroProdutos.php?erro=Erro ao salvar no banco.");
    exit;
    // echo "Erro ao inserir o produto.";
}
?>