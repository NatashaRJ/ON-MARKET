<?php 
session_start();

// Inclua a conexão com o banco de dados
require 'conexao.php';

// Estabeleça a conexão
$conn = conectaPDO();

// Verifica se o usuário está autenticado e é do tipo master
if (!isset($_SESSION['usuario']) || $_SESSION['nivel_acesso'] !== 'master') {
    header("Location: master.php");
    exit();
}

$relatorios = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Aqui você pode buscar dados no banco de dados e gerar relatórios
    $stmt = $conn->query("SELECT * FROM cadastro"); // Certifique-se de que a tabela está correta
    $relatorios = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <link rel="stylesheet" href="css/relatorioo.css">
</head>
<body>
    <h1>Relatórios</h1>
    
    <!-- Formulário para gerar o relatório -->
    <form method="POST" action="relatorios.php">
        <button type="submit" class="button">Gerar Relatório de Usuários</button>
    </form>
    
    <?php if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($relatorios)): ?>
        <!-- Exibe a tabela somente após o envio do formulário -->
        <table class="show-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Nível de Acesso</th>
                    <th>Data de Cadastro</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($relatorios as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['id_cad'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nome'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($usuario['cpf'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nivel_acesso'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($usuario['data_cadastro'] ?? 'N/A'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST'): ?>
        <!-- Caso não haja relatórios, mostra esta mensagem -->
        <p>Nenhum relatório disponível.</p>
    <?php endif; ?>

    <p><a href="dashboard_master.php">Voltar</a></p>
</body>
</html>
