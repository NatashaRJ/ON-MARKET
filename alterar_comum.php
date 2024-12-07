<?php
session_start();
include 'conexao.php'; // Incluindo a conexão com o banco de dados

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    echo "<p>Você não está logado. Faça login para continuar.</p>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe a nova senha
    $nova_senha = $_POST['nova_senha'];

    // Verifica se a nova senha não está vazia
    if (empty($nova_senha)) {
        echo "<p>Por favor, insira uma nova senha.</p>";
    } else {
        // Chama a função para atualizar a senha no banco de dados
        $resultado = update_user_password($_SESSION['usuario'], password_hash($nova_senha, PASSWORD_DEFAULT));

        // Verifica se a atualização foi bem-sucedida
        if ($resultado) {
            echo "<p>Senha alterada com sucesso!</p>";
        } else {
            echo "<p>Erro ao alterar a senha. Tente novamente.</p>";
        }
    }
}

// Função para atualizar a senha do usuário no banco de dados
function update_user_password($usuario, $senha) {
    $conn = conectaPDO(); // Conecta com o banco de dados
    try {
        // AQUI: ALTERE 'login' PARA O NOME CORRETO DA COLUNA NO SEU BANCO DE DADOS
        $stmt = $conn->prepare("UPDATE cadastro SET senha = :senha WHERE login = :usuario LIMIT 1");
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();

        // Verifica se a atualização foi realizada com sucesso
        return $stmt->rowCount() > 0;  // Retorna true se pelo menos uma linha foi afetada
    } catch (PDOException $e) {
        echo "Erro ao atualizar a senha: " . $e->getMessage();
        return false;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha</title>
    <link rel="stylesheet" href="css/alterar_comum.css">
</head>
<body>
    <div class="container">
        <h2>Alterar Senha</h2>
        <form method="post">
            <label for="nova_senha">Nova Senha:</label>
            <input type="password" id="nova_senha" name="nova_senha" required>
            <button type="submit">Alterar Senha</button>
        </form>
    </div>
    <p><a href="dashboard_comum.php">Voltar</a></p>
</body>
</html>
