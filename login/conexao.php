<?php
$server = "localhost";
$username = "root";
$password = "";

try{
    $pdo = new PDO("mysql:host=$server;dbname=EsterAcessorios;charset=utf8mb4", $username,$password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "ERRO: " .$e->getMessage();
    exit;
}

?>