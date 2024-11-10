<?php
session_start();

// Conexão com o banco de dados SQLite
$db = new PDO('sqlite:usuarios.db');

// Verifica se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Busca o usuário no banco de dados pelo email
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se a senha está correta
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = $usuario['nome'];
        $_SESSION['mensagem'] = "Login realizado com sucesso! Bem-vindo, {$_SESSION['usuario']}.";
    } else {
        $_SESSION['mensagem'] = "Email ou senha incorretos.";
    }
}

header('Location: index.php');
exit;
?>
