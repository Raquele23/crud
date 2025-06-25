<?php
include_once "conexao.php";
include_once "protecao.php";

$idFuncionario = $_GET['idFuncionario'] ?? '';
$nomeFun = '';
$email = '';
$telefone = '';
$cargo = '';

if (isset($_GET['act']) && $_GET['act'] === 'upd' && $idFuncionario !== '') {
    try {
        $stmt = $pdo->prepare("SELECT * FROM Funcionario WHERE idFuncionario = :idFuncionario");
        $stmt->bindValue(':idFuncionario', $idFuncionario);
        $stmt->execute();
        $produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produto) {
            $nomeFun = $produto['nomeFun'];
            $email = $produto['email'];
            $telefone = $produto['telefone'];
            $cargo = $produto['cargo'];
        }
    } catch (PDOException $erro) {
        echo "Erro ao carregar produto: " . $erro->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar funcionários</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body class="cadastrar-atualizar">

    <div class="link-voltar">
        <a href="listagemFun.php"> ← Voltar</a>
    </div>

    <div class="form-container">
        <p class="titulo">Funcionário</p>

        <?php if (isset($_GET['erro'])): ?>
            <div class="mensagem-erro"><?= htmlspecialchars($_GET['erro']) ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="idFuncionario" value="<?= htmlspecialchars($idFuncionario) ?>">

            <label class="label">Nome:</label>
            <input type="text" name="nomeFun" value="<?= htmlspecialchars($nomeFun) ?>" class="inputs">

            <label class="label">Descrição:</label>
            <input name="email" value="<?= htmlspecialchars($email) ?>" class="inputs">

            <label class="label">Preço:</label>
            <input type="text" name="telefone" value="<?= htmlspecialchars($telefone) ?>" class="inputs">

            <label class="label">Quantidade em cargo:</label>
            <input type="number" name="cargo" value="<?= htmlspecialchars($cargo) ?>" class="inputs">
        
            <button type="submit" name="salvar" class="button-cadastrar">Salvar</button>
        </form>
    </div>
</body>
</html>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idFuncionario = $_POST['idFuncionario'];
    $nome = $_POST['nomeFun'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cargo = $_POST['cargo'];
 

    try {
        $stmt = $pdo->prepare("UPDATE Funcionario SET nomeFun = :nome, email = :email, telefone = :telefone, cargo = :cargo WHERE idFuncionario = :idFuncionario");
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':telefone', $telefone);
        $stmt->bindValue(':cargo', $cargo);
        $stmt->bindValue(':idFuncionario', $idFuncionario);

        $stmt->execute();

        header("Location: listagemFun.php?sucesso=Funcionario atualizado com sucesso!");
        exit;
    } catch (PDOException $erro) {
        header("Location: atualizarFun.php?act=upd&idFuncionario=$idFuncionario&erro=Erro ao atualizar: " . urlencode($erro->getMessage()));
        exit;
    }
}

?>