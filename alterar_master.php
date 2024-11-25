<?php
session_start();
include 'conexao.php'; // Incluindo a conexão com o banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nova_senha = $_POST['nova_senha'];

    // Chama a função para atualizar a senha no banco de dados
    update_master_password(password_hash($nova_senha, PASSWORD_DEFAULT));

    echo "<p>Senha master alterada com sucesso!</p>";
}

// Função para atualizar a senha master no banco de dados
function update_master_password($senha) {
    // A função de conexão deve retornar um objeto de conexão PDO
    $conn = conectaPDO(); // Assumindo que a função 'conectaPDO()' existe em 'conexao.php'

    try {
        $stmt = $conn->prepare("UPDATE cadastro SET senha = :senha WHERE nivel_acesso = 'master'");
        $stmt->bindParam(':senha', $senha);
        $stmt->execute();
    } catch (PDOException $e) {
        echo "Erro ao atualizar a senha: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Senha Master</title>
    <link rel="stylesheet" href="css/alterar_masterr.css">
</head>
<body>
    <div class="container">
        <h2>Alterar Senha Master</h2>
        <form method="post">
            <label for="nova_senha">Nova Senha:</label>
            <input type="password" id="nova_senha" name="nova_senha" required>
            <button type="submit">Alterar Senha</button>
        </form>
    </div>
    <p><a href="dashboard_master.php">Voltar</a></p>
</body>
</html>
