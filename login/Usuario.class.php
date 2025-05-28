<?php

session_start();

class Usuario{
    public function login($email, $senha){
        global $pdo;

        $sql = "SELECT * FROM admin WHERE email = :email AND senha = :senha";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":senha", $senha);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $dado = $stmt->fetch();

            $_SESSION["idadmin"] = $dado["idAdmin"];

            return true;
        }else {
            return false;
        }
    }
}

?>