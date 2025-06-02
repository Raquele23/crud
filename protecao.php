<?php
session_start();

if(!isset($_SESSION['idAdmin'])){
    die("Você não pode acessar essa página porque não está logado! <p><a href=\"login.php\">Tela de login</a></p>");
}
?>