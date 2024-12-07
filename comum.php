<?php
require 'conexao.php';
session_start();

// Inicializa o contador de tentativas na sessão, se ainda não existir
if (!isset($_SESSION['tentativas'])) {
    $_SESSION['tentativas'] = 3; // Inicializa com 3 tentativas
}

// Função para redefinir as tentativas
function resetTentativas() {
    $_SESSION['tentativas'] = 3; // Reinicia para 3 tentativas
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
        if ($_SESSION['tentativas'] <= 0) {
            // Exibe mensagem de bloqueio e redireciona
            echo "
            <div style='text-align: center; margin-bottom: 20px;'>
                <p style='color: black; font-weight: bold; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);'>
                    Você excedeu o número de tentativas. Tente novamente mais tarde.
                </p>
            </div>";
            resetTentativas();
            header("Refresh: 3; url=login.php");
            exit();
        }

        // Verifica se o usuário foi encontrado
        if ($user) {
            // Verifica se a senha fornecida corresponde ao hash armazenado no banco
            if (password_verify($senha, $user['senha'])) {
                // Se a senha estiver correta, inicia a sessão e redireciona
                $_SESSION['login'] = $user['login']; // Guarda o login do usuário na sessão
                $_SESSION['id_cad'] = $user['id_cad']; // Guarda o ID do usuário
                $_SESSION['nivel_acesso'] = $user['nivel_acesso']; // Guarda o nível de acesso do usuário

                // Redireciona para a página do usuário comum
                header("Location: autenticação_comum.html");
                exit();
            } else {
                // Decrementa o contador de tentativas
                $_SESSION['tentativas']--;

                if ($_SESSION['tentativas'] > 0) {
                    $tentativasRestantes = $_SESSION['tentativas'];
                    echo "<p style='color:red;'>Usuário ou senha incorretos! Tentativas restantes: $tentativasRestantes</p>";
                } else {
                    echo "<p style='color:red;'>Você excedeu o número de tentativas. Tente novamente mais tarde.</p>";
                    resetTentativas(); // Reseta as tentativas após 0
                    header("Refresh: 3; url=login.php"); // Redireciona após 3 segundos
                    exit();
                }
            }
        } else {
            echo "<p style='color:red;'>Usuário não encontrado!</p>";
        }
    } else {
        // Caso não consiga conectar ao banco
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
<div class="login-container" style="text-align: center;">
    <h2>Login Comum</h2>
    <form method="POST" action="">
        <label for="usuario">Usuário:</label>
        <input type="text" placeholder="Digite Seu Usuário" name="usuario" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" placeholder="Digite Sua Senha" name="senha" required>
        <br>

        <button type="submit">Entrar</button>
        <button type="reset">Limpar</button>
    </form>
</div>
</body>
</html>
