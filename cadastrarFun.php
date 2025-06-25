<?php
include_once "conexao.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nome = trim($_POST['nomeFun']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $cargo = trim($_POST['cargo']);
    
    if (
        !empty($nome) &&
        !empty($email) &&
        !empty($telefone) && 
        !empty($cargo) 
    ) {

        $stmtVerificando = $pdo->prepare("SELECT nomeFun FROM Funcionario WHERE nomeFun = :nome");
        $stmtVerificando->bindValue(':nome', $nome);
        $stmtVerificando->execute();

        if ($stmtVerificando->rowCount() > 0){
        header("Location: cadastroFun.php?erro=Este produto já está cadastrado.");
        exit;
        }

            try{
                $stmt = $pdo->prepare("INSERT INTO Funcionario (nomeFun, email, telefone, cargo) VALUES (:nome, :email, :telefone, :cargo)");

                $stmt->bindValue(':nome', $nome);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':telefone', $telefone);
                $stmt->bindValue(':cargo', $cargo);

                if ($stmt->execute()) {
                header("Location: cadastroFun.php?sucesso=Funcionário cadastrado com sucesso!");
                exit;
                } else {
                header("Location: cadastroFun.php?erro=Erro ao cadastrar funcionário.");
                exit;
                }
            }catch (PDOException $e) {
                header("Location: cadastroFun.php?erro=" . urlencode("Erro no banco de dados: " . $e->getMessage()));
                exit;
            }
    
    } else {
        header("Location: cadastroFun.php?erro=Preencha todos os campos");
        exit;
    }
} else {
header("Location: cadastroFun.php?erro=Requisição inválida.");
exit;
}
?>