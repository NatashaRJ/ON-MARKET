<?php
session_start();
require 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

// Recupera o login do usuário logado
$usuario_login = $_SESSION['usuario'];

// Estabelece a conexão com o banco de dados
$conn = conectaPDO();
if (!$conn) {
    die("Erro ao conectar ao banco de dados.");
}

// Consulta os dados do usuário
$stmt = $conn->prepare("SELECT * FROM cadastro WHERE login = :login");
$stmt->bindParam(':login', $usuario_login);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    die("Usuário não encontrado.");
}

// Verifica se o nível de acesso é "master"
if (strtolower(trim($usuario['nivel_acesso'])) !== 'master') {
    die("Acesso restrito: Você não tem permissão para acessar este perfil.");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?php echo htmlspecialchars($usuario['nome']); ?></title>
    <link rel="stylesheet" href="css/perfil_master.css">
</head>
<body>

<h1>Perfil de <?php echo htmlspecialchars($usuario['nome']); ?></h1>
<p><strong>Login:</strong> <?php echo htmlspecialchars($usuario['login']); ?></p>


<!-- Exibe a mensagem de sucesso se houver -->
<?php
if (isset($_SESSION['mensagem'])) {
    echo '<p class="mensagem-sucesso">' . $_SESSION['mensagem'] . '</p>';
    // Remove a mensagem da sessão após exibição
    unset($_SESSION['mensagem']);
}
?>

<!-- Formulário para editar dados -->
<h2>Editar Perfil</h2>
<form method="POST" action="atualizar_perfil.php">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required><br>

    <label for="data_nascimento">Data de Nascimento:</label>
    <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo htmlspecialchars($usuario['data_nascimento']); ?>" required><br>

    <label for="sexo">Sexo:</label>
    <select name="sexo" id="sexo" required>
        <option value="masc" <?php echo $usuario['sexo'] == 'masc' ? 'selected' : ''; ?>>Masculino</option>
        <option value="fem" <?php echo $usuario['sexo'] == 'fem' ? 'selected' : ''; ?>>Feminino</option>
        <option value="outro" <?php echo $usuario['sexo'] == 'outro' ? 'selected' : ''; ?>>Outro</option>
    </select><br><br>

    <label for="nome_materno">Nome da Mãe:</label>
    <input type="text" id="nome_materno" name="nome_materno" value="<?php echo htmlspecialchars($usuario['nome_materno']); ?>" required><br>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($usuario['cpf']); ?>" required><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required><br>

    <label for="telefone_celular">Telefone Celular:</label>
    <input type="text" id="telefone_celular" name="telefone_celular" value="<?php echo htmlspecialchars($usuario['telefone_celular']); ?>" required><br>

    <label for="telefone_fixo">Telefone Fixo:</label>
    <input type="text" id="telefone_fixo" name="telefone_fixo" value="<?php echo htmlspecialchars($usuario['telefone_fixo']); ?>" required><br>

    <label for="endereco">Endereço:</label>
    <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($usuario['endereco']); ?>" required><br>

    <label for="cep">CEP:</label>
    <input type="text" id="cep" name="cep" value="<?php echo htmlspecialchars($usuario['cep']); ?>" required><br>

    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($usuario['cidade']); ?>" required><br>

    <button type="submit">Atualizar</button>
</form>

<h1>Informações de <?php echo htmlspecialchars($usuario['nome']); ?></h1>

<div class="inf-box">
    <h2>Informações do Perfil:</h2>
    <p><strong>Nome:</strong> <?php echo !empty($usuario['nome']) ? htmlspecialchars($usuario['nome']) : 'Não definido'; ?></p>
    <p><strong>Data de Nascimento:</strong> 
    <?php 
    // Verifica se a data de nascimento está vazia ou não
    echo !empty($usuario['data_nascimento']) 
        ? htmlspecialchars(date('d/m/Y', strtotime($usuario['data_nascimento']))) 
        : 'Não definido'; 
    ?>
    </p>
    <p><strong>Sexo:</strong> <?php echo !empty($usuario['sexo']) ? htmlspecialchars($usuario['sexo']) : 'Não definido'; ?></p>
    <p><strong>Nome da Mãe:</strong> <?php echo !empty($usuario['nome_materno']) ? htmlspecialchars($usuario['nome_materno']) : 'Não definido'; ?></p>
    <p><strong>CPF:</strong> <?php echo !empty($usuario['cpf']) ? htmlspecialchars($usuario['cpf']) : 'Não definido'; ?></p>
    <p><strong>Email:</strong> <?php echo !empty($usuario['email']) ? htmlspecialchars($usuario['email']) : 'Não definido'; ?></p>
    <p><strong>Telefone Celular:</strong> <?php echo !empty($usuario['telefone_celular']) ? htmlspecialchars($usuario['telefone_celular']) : 'Não definido'; ?></p>
    <p><strong>Telefone Fixo:</strong> <?php echo !empty($usuario['telefone_fixo']) ? htmlspecialchars($usuario['telefone_fixo']) : 'Não definido'; ?></p>
    <p><strong>Endereço:</strong> <?php echo !empty($usuario['endereco']) ? htmlspecialchars($usuario['endereco']) : 'Não definido'; ?></p>
    <p><strong>CEP:</strong> <?php echo !empty($usuario['cep']) ? htmlspecialchars($usuario['cep']) : 'Não definido'; ?></p>
    <p><strong>Cidade:</strong> <?php echo !empty($usuario['cidade']) ? htmlspecialchars($usuario['cidade']) : 'Não definido'; ?></p>
</div>

<p><a href="dashboard_master.php">Voltar</a></p>
</body>
</html>
