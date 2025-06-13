<?php
include "conexao.php"; // ou seu arquivo de conexão
$id = $_GET['id'] ?? '';

if ($id !== '') {
    try {
        $stmt = $pdo->prepare("DELETE FROM Produto WHERE idProduto = ?");
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        echo "Produto excluído com sucesso!";
    } catch (PDOException $erro) {
        echo "Erro ao excluir: " . $erro->getMessage();
    }
}

header("Location: index.php");
exit;
?>