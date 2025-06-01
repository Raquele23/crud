<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ester acessórios</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div id="big-div-login">
        <div id="tela-parte1">
            <img src="assets/logoo.jpeg" alt="Logo Ester Acessórios" id="img-logo-form">
            <h1 id="bem-vindo">Seja bem vindo de volta!</h1>
        </div>
        <div id="tela-parte2">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#ffffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-round-icon lucide-circle-user-round"><path d="M18 20a6 6 0 0 0-12 0"/><circle cx="12" cy="10" r="4"/><circle cx="12" cy="12" r="10"/></svg>

            <?php
            $mensagemErro = $_SESSION['mensagemErro'] ?? '';
            unset($_SESSION['mensagemErro']);

            if(!empty($mensagemErro)){
                echo '<p class="mensagem-erro">' . htmlspecialchars($mensagemErro) . '</p>';
            }
            ?>
            
            <?php
            if (isset($_GET['erro']) && $_GET['erro'] == 1) {
                echo '<p class="mensagem-erro">E-mail ou senha incorretos!</p>';
            }
            ?>

            <form action="logar.php" method="POST" id="form">
                <label for="email" class="form-campos">Email:</label>
                <div class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#F582A7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mail-icon lucide-mail"><path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7"/><rect x="2" y="4" width="20" height="16" rx="2"/></svg>
                    <input type="email" id="email" name="email" placeholder="Email" class="inputs-form">
                </div>

                <label for="senha" class="form-campos">Senha:</label>
                <div class="input-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="#F582A7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-lock-keyhole-icon lucide-lock-keyhole"><circle cx="12" cy="16" r="1"/><rect x="3" y="10" width="18" height="12" rx="2"/><path d="M7 10V7a5 5 0 0 1 10 0v3"/></svg>
                    <input type="password" id="senha" name="senha" placeholder="Senha" class="inputs-form">
                </div>
                <button type="submit" id="botao-form">Entrar</button>
            </form>
            
            
            <p id="sem-conta">Não tem uma conta? Cadastre-se agora</p>
        </div>
    </div>
</body>
</html>