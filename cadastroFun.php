<?php
include_once "protecao.php";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de funcionários</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body class="cadastrar-atualizar">
    <div class="link-voltar">
        <a href="listagemFun.php"> ← Voltar</a>
    </div>
    <div class="form-container">
        <p class="titulo">Cadastrar funcionário</p>

        <?php if (isset($_GET['sucesso'])): ?>
            <div class="mensagem-sucesso">
                <?php echo htmlspecialchars($_GET['sucesso']); ?>
            </div>
        <?php elseif (isset($_GET['erro'])): ?>
            <div class="mensagem-erro">
                <?php echo htmlspecialchars($_GET['erro']); ?>
            </div>
        <?php endif; ?>

        <form action="cadastrarFun.php" method="POST">
            <label for="nomeFun" class="label">Nome:</label>
            <input type="text" name="nomeFun" id="nomeFun" class="inputs">

            <label for="email" class="label">Email:</label>
            <input type="email" name="email" id="email" class="inputs">

            <label for="telefone" class="label">Telefone:</label>
            <input type="text" name="telefone" id="telefone" class="inputs">

            <label for="cargo" class="label">Cargo:</label>
            <input type="text" name="cargo" id="cargo" class="inputs">

            <button type="submit" class="button-cadastrar">CADASTRAR</button>
        </form>
    </div>
</body>
</html>