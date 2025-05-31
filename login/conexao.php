<?php

try{
    $pdo = new PDO("mysql:host=localhost;dbname=EsterAcessorios;charset=utf8mb4","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $erro){
    echo "Erro: " .$erro->getMessage();
    exit;
}

?>