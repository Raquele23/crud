<?php
session_start();

if(!isset($_SESSION['idAdmin'])){
    // header("Location: login.php");
    // exit;

    die("Você não pode acessar essa página porque não está logado! <p><a href=\"login.php\">Tela de login</a></p>");
}
?>