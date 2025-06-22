<?php
include_once "conexao.php";
include_once "protecao.php";

$id = $_GET['id'] ?? '';
$nomeProduto = '';
$descricao = '';
$preco = '';
$quantidadeEstoque = '';
$imagem = '';

if (isset($_GET['act']) && $_GET['act'] === 'upd' && $id !== '') {
    try {
        $stmt = $pdo->prepare("SELECT * FROM Produto WHERE idProduto = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produto) {
            $nomeProduto = $produto['nomeProduto'];
            $descricao = $produto['descricao'];
            $preco = $produto['preco'];
            $quantidadeEstoque = $produto['quantidadeEstoque'];
            $imagem = $produto['imagem'];
        }
    } catch (PDOException $erro) {
        echo "Erro ao carregar produto: " . $erro->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar produto</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="cadastrar-atualizar">

    <div class="link-voltar">
        <a href="listagemProdutos.php"> ← Voltar</a>
    </div>

    <div class="form-container">
        <p class="titulo">Atualize seu produto</p>

        <?php if (isset($_GET['erro'])): ?>
            <div class="mensagem-erro"><?= htmlspecialchars($_GET['erro']) ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idProduto" value="<?= htmlspecialchars($id) ?>">

            <label class="label">Nome:</label>
            <input type="text" name="nomeProduto" value="<?= htmlspecialchars($nomeProduto) ?>" class="inputs">

            <label class="label">Descrição:</label>
            <input name="descricao" value="<?= htmlspecialchars($descricao) ?>" class="inputs">

            <label class="label">Preço:</label>
            <input type="text" name="preco" value="<?= htmlspecialchars($preco) ?>" class="inputs">

            <label class="label">Quantidade em estoque:</label>
            <input type="number" name="quantidadeEstoque" value="<?= htmlspecialchars($quantidadeEstoque) ?>" class="inputs">

            <label class="label">Imagem:</label>
            <input type="file" name="imagem" class="inputs">
        
            <button type="submit" name="salvar" class="button-cadastrar">Salvar</button>
        </form>
    </div>
</body>
</html>

<?php
$imagemExistente = $imagem;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProduto = $_POST['idProduto'];
    $nome = $_POST['nomeProduto'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidadeEstoque = $_POST['quantidadeEstoque'];

    $imagem = $imagemExistente;

    if (!empty($_FILES['imagem']['name'])) {
        $imagem = uniqid() . '_' . $_FILES['imagem']['name'];
        move_uploaded_file($_FILES['imagem']['tmp_name'], 'assets/imagensProdutos/' . $imagem);
    } 

    try {
        $stmt = $pdo->prepare("UPDATE Produto SET nomeProduto = :nome, descricao = :descricao, preco = :preco, quantidadeEstoque = :estoque, imagem = :imagem WHERE idProduto = :id");
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':preco', $preco);
        $stmt->bindValue(':estoque', $quantidadeEstoque);
        $stmt->bindValue(':imagem', $imagem);
        $stmt->bindValue(':id', $idProduto);

        $stmt->execute();

        header("Location: listagemProdutos.php?sucesso=Produto atualizado com sucesso!");
        exit;
    } catch (PDOException $erro) {
        header("Location: atualizarProduto.php?act=upd&id=$id&erro=Erro ao atualizar: " . urlencode($erro->getMessage()));
        exit;
    }
}

?>