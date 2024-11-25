<?php
require 'conexao.php';
session_start();

// Inicializa o contador de tentativas na sessão, se ainda não existir
if (!isset($_SESSION['tentativas'])) {
    $_SESSION['tentativas'] = 0;
}

// Função para redefinir as tentativas
function resetTentativas() {
    $_SESSION['tentativas'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Estabelece a conexão usando a função conectaPDO()
    $conn = conectaPDO();

    if ($conn) {
        // Prepara a consulta para verificar o login
        $stmt = $conn->prepare("SELECT * FROM cadastro WHERE login = :login");
        $stmt->bindParam(':login', $login);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se o número de tentativas foi excedido
        if ($_SESSION['tentativas'] >= 3) {
            // Exibe mensagem e redireciona para o login após 3 tentativas
            echo "<p style='color:black; font-weight: bold; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); margin-left: 50px;'>Você excedeu o número de tentativas. Tente novamente com a senha correta.</p>";
            resetTentativas();  // Reseta as tentativas
            header("Refresh: 3; url=login.php");  // Redireciona para o login após 3 tentativas
            exit();
        }

        // Verifica se o usuário foi encontrado e se a senha está correta
        if ($user && password_verify($senha, $user['senha'])) {
            // Login bem-sucedido
            $_SESSION['usuario'] = $user['login'];
            $_SESSION['id'] = $user['id'];
            resetTentativas(); // Reseta o contador de tentativas
            header("Location: autenticação_comum.html");  // Redireciona para a página após login
            exit();
        } else {
            // Incrementa tentativas apenas se o login for inválido
            $_SESSION['tentativas']++;

            if ($_SESSION['tentativas'] < 3) {
                // Se ainda restam tentativas, mostra quantas tentativas faltam
                $tentativasRestantes = 3 - $_SESSION['tentativas'];
                echo "<p style='color:black; font-weight: bold; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); margin-left: 50px;'>Usuário ou senha incorretos! Tentativas restantes: $tentativasRestantes</p>";
            } else {
                // Se já foram feitas 3 tentativas, redireciona para a tela de login
                echo "<p style='color:black; font-weight: bold; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3); margin-left: 50px;'>Você excedeu o número de tentativas. Tente novamente com a senha correta.</p>";
                resetTentativas();  // Reseta as tentativas após 3 erros
                header("Refresh: 3; url=login.php");  // Redireciona para o login após 3 tentativas
                exit();
            }
        }
    } else {
        echo "<p style='color:red;'>Erro: Conexão com o banco de dados não estabelecida.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/comum.css">
    <title>Login Comum</title>
</head>
<body>
<div class="login-container">
    <h2>Login Comum</h2>
    <form method="POST" action="">
        <label for="usuario">Usuário:</label>
        <input type="text" name="usuario" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>
        <br>
        <button type="submit">Entrar</button>
    </form>
</div>
</body>
</html>
