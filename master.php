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
                // Se a senha estiver correta, inicia a sessão e redireciona com base no nível de acesso
                $_SESSION['usuario'] = $user['login'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['nivel_acesso'] = $user['nivel_acesso'];

                // Redireciona conforme o nível de acesso
                if ($_SESSION['nivel_acesso'] == 'master') {
                    header("Location: autenticaçao_master.html");
                } else {
                    header("Location: autenticaçao_comum.html");
                }
                exit();
            } else {
                // Incrementa tentativas e exibe mensagem de erro
                $_SESSION['tentativas']++;
                $tentativasRestantes = 3 - $_SESSION['tentativas'];
                echo "
                <div style='text-align: center; margin-bottom: 20px;'>
                    <p style='color: black; font-weight: bold; text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);'>
                        Usuário ou senha incorretos! Tentativas restantes: $tentativasRestantes 
                    </p>
                </div>";
            }
        } else {
            // Se o usuário não for encontrado
            echo "
            <div style='text-align: center; margin-bottom: 20px;'>
                <p style='color: red; font-weight: bold;'>
                    Usuário não encontrado!
                </p>
            </div>";
        }
    } else {
        // Se não conseguiu conectar ao banco de dados
        echo "
        <div style='text-align: center; margin-bottom: 20px;'>
            <p style='color: red; font-weight: bold;'>
                Erro: Conexão com o banco de dados não estabelecida.
            </p>
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/comum.css">
    <title>Login Master</title>
</head>
<body>
<div class="login-container" style="text-align: center;">
    <h2>Login Master</h2>
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
