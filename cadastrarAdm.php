<?php
include_once "conexao.php";

if (!isset($_POST['email'], $_POST['senha'])){
    exit("Acesso inválido");
}

$email = trim($_POST['email']);
$senha = trim($_POST['senha']);

if (!$email || !$senha){
    exit("Por favor, preencha todos os campos");
}

$stmtVerificando = $pdo->prepare("SELECT idAdmin FROM Admin WHERE email = :email");

$stmtVerificando->execute([':email' => $email]);

if ($stmtVerificando->rowCount()) {
    exit("Este email já está cadastrado");
}

$stmt = $pdo->prepare("INSERT INTO Admin (email, senha) VALUES (:email, :senha)");

if ($stmt->execute([':email' => $email, ':senha' => password_hash($senha, PASSWORD_DEFAULT)])) {
    header('Location: login.php');
    exit;
} else {
    exit("Erro ao cadastrar usuário");
}

?>