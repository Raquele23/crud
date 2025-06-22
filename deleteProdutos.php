<?php
include "conexao.php";

$id = $_GET['id'] ?? '';

if ($id !== '') {
    try {
        $stmt = $pdo->prepare("DELETE FROM Produto WHERE idProduto = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        header("Location: listagemProdutos.php?sucesso=Produto excluído com sucesso!");
        exit;
    } catch (PDOException $erro) {
        header("Location: listagemProdutos.php?erro=" . urlencode("Erro ao excluir: " . $erro->getMessage()));
        exit;
    }
}else {
    header("Location: listagemProdutos.php?erro=" . urlencode("Id inválido para exclusão."));
    exit;
}