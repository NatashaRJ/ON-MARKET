<?php
session_start();

// Verifica se o usuário está autenticado e é do tipo master
if (!isset($_SESSION['usuario']) || $_SESSION['nivel_acesso'] !== 'master') {
    header("Location: master.php");
    exit();
}

// Conexão com o banco de dados
require 'conexao.php';
$conn = conectaPDO(); // Chama a função e atribui o resultado à variável $conn

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    die("Erro ao conectar ao banco de dados.");
}

// Inicializa a variável $cadastro
$cadastro = [];

try {
    // Recupera todos os usuários da tabela cadastro
    $stmt = $conn->query("SELECT id_cad, nome, data_nascimento, sexo, nome_materno, cpf, email, telefone_celular, telefone_fixo, endereco, cep, cidade, login, senha, nivel_acesso, data_cadastro FROM cadastro");
    $cadastro = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    // Lida com erros de consulta
    echo "Erro ao recuperar dados: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Usuários</title>
    <link rel="stylesheet" href="css/gerenciar.css">
</head>
<body>
    <h1>Gerenciar Usuários</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Data de Nascimento</th>
                <th>Sexo</th>
                <th>Nome Materno</th>
                <th>CPF</th>
                <th>Email</th>
                <th>Telefone Celular</th>
                <th>Telefone Fixo</th>
                <th>Endereço</th>
                <th>CEP</th>
                <th>Cidade</th>
                <th>Login</th>
                <th>Nível de Acesso</th>
                <th>Data de Cadastro</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($cadastro)): ?>
                <?php foreach ($cadastro as $usuario): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usuario['id_cad']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nome']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['data_nascimento']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['sexo']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nome_materno']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['cpf']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['telefone_celular']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['telefone_fixo']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['endereco']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['cep']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['cidade']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['login']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['nivel_acesso']); ?></td>
                        <td><?php echo htmlspecialchars($usuario['data_cadastro']); ?></td>
                        <td>
                            <a href="editar_usuario.php?id_cad=<?php echo htmlspecialchars($usuario['id_cad']); ?>" style="color: blue; text-decoration: underline;">Editar</a>
                            <form method="POST" action="excluir_usuario.php" style="display:inline;">
                                <input type="hidden" name="id_cad" value="<?php echo htmlspecialchars($usuario['id_cad']); ?>">
                                <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" style="color: red; text-decoration: underline;">Excluir</a>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="17">Nenhum usuário encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    
    
    <!-- Formulário para gerar o PDF -->
    <form method="POST" action="gerar_pdf.php">
        <input type="hidden" name="cadastro" value="<?php echo htmlspecialchars(serialize($cadastro)); ?>"> <!-- Passando os dados serializados -->
        <button type="submit" name="gerar_pdf" class="btn">Gerar PDF</button>
    </form>
</body>
</html>
