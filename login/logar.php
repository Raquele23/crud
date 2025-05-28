<?php
include_once "conexao.php";
include_once "Usuario.class.php";

session_start();

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])) {


    $u = new Usuario();

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if($u->login($email, $senha) === true){
        if(isset($_SESSION["idadmin"])){
            header("Location: index.php");
        }else{
            echo "Email ou senha incorretos, tente novamente.";
            die;
        };
    }else{
        header("Location: login.php");
    };
}else{
    header("Location: login.php");
}

?>