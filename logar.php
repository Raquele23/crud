<?php
include_once "conexao.php";
session_start();


if (isset($_POST['email'], $_POST['senha'])) {

    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if(empty($email)){
        $_SESSION['mensagemErro'] = "Preencha seu email!";
        header("Location: login.php");
        exit;
    }elseif(empty($senha)){
        $_SESSION['mensagemErro'] = "Preencha sua senha!";
        header("Location: login.php");
        exit;
    }else{

        $sql = "SELECT * FROM Admin WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if($admin && password_verify($senha, $admin['senha'])){
                $_SESSION['idAdmin'] = $admin['idAdmin'];
                header("Location: dashboard.php");
                exit;
            } else{
                header("Location: login.php?erro=1");
                exit;
            }
    }
}
?>