<?php
include "conexao.php";

$id = $_GET['id'] ?? '';

if ($id !== '') {
    try {
        $stmt = $pdo->prepare("DELETE FROM Funcionario WHERE idFuncionario = :idFun");
        $stmt->bindValue(':idFun', $id);
        $stmt->execute();

        header("Location: listagemFun.php?sucesso=Excluído com sucesso!");
        exit;
    } catch (PDOException $erro) {
        header("Location: listagemFun.php?erro=" . urlencode("Erro ao excluir: " . $erro->getMessage()));
        exit;
    }
}else {
    header("Location: listagemFun.php?erro=" . urlencode("Id inválido para exclusão."));
    exit;
}