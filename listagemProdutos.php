<?php
include_once "conexao.php";
include_once "protecao.php";

$stmt = $pdo->query("SELECT * FROM Produto");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    <?php if ($produtos): ?>
        <?php foreach ($produtos as $produto): ?>
            <div class="produto">
                <img src="assets/imagensProdutos/<?= htmlspecialchars($produto['imagem']) ?>" alt="<?= htmlspecialchars($produto['nomeProduto']) ?>">
                <div class="info">
                    <p><strong>Nome:</strong> <?= htmlspecialchars($produto['nomeProduto']) ?></p>
                    <p><strong>Preço:</strong> R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
                    <p><strong>Descrição:</strong> <?= nl2br(htmlspecialchars($produto['descricao'])) ?></p>
                    <p><strong>Estoque:</strong> <?= htmlspecialchars($produto['quantidadeEstoque']) ?></p>
                    <a href="deleteProdutos.php">Excluir</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum produto encontrado.</p>
    <?php endif; ?>
</body>
</html>