<?php
$senha = 'segredo';
$hash = password_hash($senha, PASSWORD_DEFAULT);
echo $hash;
?>