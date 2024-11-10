<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro e Login de Usuário</title>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form method="POST" action="processa_cadastro.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br>

        <button type="submit">Cadastrar</button>
    </form>

    <h1>Login de Usuário</h1>
    <form method="POST" action="processa_login.php">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br>

        <button type="submit">Entrar</button>
    </form>

    <?php
    if (isset($_SESSION['mensagem'])) {
        echo "<p>{$_SESSION['mensagem']}</p>";
        unset($_SESSION['mensagem']);
    }
    ?>
</body>
</html>
