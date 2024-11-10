<?php
session_start();

// Conexão com o banco de dados SQLite
$db = new PDO('sqlite:usuarios.db');

// Criar tabela de usuários se não existir
$db->exec("CREATE TABLE IF NOT EXISTS usuarios (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nome TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    senha TEXT NOT NULL
)");

// Verifica se os dados foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Hash seguro da senha

    // Inserir o usuário no banco de dados
    $stmt = $db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
    } else {
        $_SESSION['mensagem'] = "Erro ao cadastrar usuário.";
    }
}

header('Location: index.php');
exit;
?>
