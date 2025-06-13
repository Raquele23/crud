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
        $stmt = $pdo->prepare("SELECT * FROM Produto WHERE idProduto = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
    <input type="hidden" name="idProduto" value="<?= htmlspecialchars($id) ?>">

    <label>Nome:</label>
    <input type="text" name="nomeProduto" value="<?= htmlspecialchars($nomeProduto) ?>"><br>

    <label>Descrição:</label>
    <textarea name="descricao"><?= htmlspecialchars($descricao) ?></textarea><br>

    <label>Preço:</label>
    <input type="text" name="preco" value="<?= htmlspecialchars($preco) ?>"><br>

    <label>Quantidade em estoque:</label>
    <input type="number" name="quantidadeEstoque" value="<?= htmlspecialchars($quantidadeEstoque) ?>"><br>

    <label>Imagem:</label>
    <input type="file" name="imagem"><br>
    <img src="assets/imagensProdutos/<?= htmlspecialchars($imagem) ?>" width="100"><br>

    <input type="submit" name="salvar" value="Salvar">
</form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idProduto = $_POST['idProduto'];
    $nome = $_POST['nomeProduto'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidadeEstoque = $_POST['quantidadeEstoque'];

    // Lógica da imagem (simples - opcional)
    $imagem = $produto['imagem'];
    if ($_FILES['imagem']['name'] !== '') {
        $imagem = $_FILES['imagem']['name'];
        move_uploaded_file($_FILES['imagem']['tmp_name'], 'assets/imagensProdutos/' . $imagem);
    }

    try {
        $stmt = $pdo->prepare("UPDATE Produto SET nomeProduto=?, descricao=?, preco=?, quantidadeEstoque=?, imagem=? WHERE idProduto=?");
        $stmt->execute([$nome, $descricao, $preco, $quantidadeEstoque, $imagem, $idProduto]);
        echo "Produto atualizado com sucesso!";
        header("Location: index.php");
        exit;
    } catch (PDOException $erro) {
        echo "Erro ao atualizar: " . $erro->getMessage();
    }
}
?>