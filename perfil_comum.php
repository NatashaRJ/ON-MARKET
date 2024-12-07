<?php
session_start();
require 'conexao.php';

// Verifica se o usuário está autenticado
if (!isset($_SESSION['login'])) {
    header("Location: comum.php");
    exit();
}

// Conecta ao banco de dados
$conn = conectaPDO();

// Recupera o login do usuário a partir da sessão
$usuario_logado = $_SESSION['login'];

// Consulta os dados do usuário na tabela cadastro
$stmt = $conn->prepare("
    SELECT nome, data_nascimento, sexo, nome_materno, cpf, email, telefone_celular, telefone_fixo, endereco, cep, cidade 
    FROM cadastro 
    WHERE login = :usuario_login
");
$stmt->bindParam(':usuario_login', $usuario_logado, PDO::PARAM_STR);

if (!$stmt->execute()) {
    die("Erro ao executar consulta ao banco de dados.");
}

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Erro: Usuário não encontrado.");
}

// Inicializa os dados do perfil com valores do banco de dados ou vazio
$nome = $usuario['nome'] ?? '';
$data_nascimento = $usuario['data_nascimento'] ?? '';
$sexo = $usuario['sexo'] ?? '';
$nome_materno = $usuario['nome_materno'] ?? '';
$cpf = $usuario['cpf'] ?? '';
$email = $usuario['email'] ?? '';
$telefone_celular = $usuario['telefone_celular'] ?? '';
$telefone_fixo = $usuario['telefone_fixo'] ?? '';
$endereco = $usuario['endereco'] ?? '';
$cep = $usuario['cep'] ?? '';
$cidade = $usuario['cidade'] ?? '';

// Formata a data de nascimento para o formato AAAA-MM-DD
if (!empty($data_nascimento)) {
    $data_nascimento = date('Y-m-d', strtotime($data_nascimento));
}

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Filtra e sanitiza os dados enviados pelo formulário
    $nome = htmlspecialchars($_POST['nome']);
    $data_nascimento = htmlspecialchars($_POST['data_nascimento']);
    $sexo = htmlspecialchars($_POST['sexo']);
    $nome_materno = htmlspecialchars($_POST['nome_materno']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $email = htmlspecialchars($_POST['email']);
    $telefone_celular = htmlspecialchars($_POST['telefone_celular']);
    $telefone_fixo = htmlspecialchars($_POST['telefone_fixo']);
    $endereco = htmlspecialchars($_POST['endereco']);
    $cep = htmlspecialchars($_POST['cep']);
    $cidade = htmlspecialchars($_POST['cidade']);

    // Converte a data de DD/MM/AAAA para o formato AAAA-MM-DD
    $data_nascimento = DateTime::createFromFormat('Y-m-d', $data_nascimento);
    if ($data_nascimento) {
        $data_nascimento = $data_nascimento->format('Y-m-d');
    } else {
        die("Data de nascimento inválida.");
    }

    // Atualiza os dados no banco de dados
    $stmt = $conn->prepare("
        UPDATE cadastro
        SET nome = :nome, data_nascimento = :data_nascimento, sexo = :sexo, nome_materno = :nome_materno,
            cpf = :cpf, email = :email, telefone_celular = :telefone_celular, telefone_fixo = :telefone_fixo,
            endereco = :endereco, cep = :cep, cidade = :cidade
        WHERE login = :usuario_login
    ");

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':data_nascimento', $data_nascimento);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':nome_materno', $nome_materno);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone_celular', $telefone_celular);
    $stmt->bindParam(':telefone_fixo', $telefone_fixo);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':usuario_login', $usuario_logado, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar os dados.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="css/perfil_comum.css">
</head>
<body>
    <h1>Perfil do Usuário</h1>
    <div class="formulario">
        <form method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($nome, ENT_QUOTES, 'UTF-8'); ?>" required>
            <br>

            <label for="data_nascimento">Data de Nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento" value="<?= htmlspecialchars($data_nascimento); ?>" required>
            <br>

            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" required>
                <option value="fem" <?= ($sexo === 'fem') ? 'selected' : ''; ?>>Feminino</option>
                <option value="masc" <?= ($sexo === 'masc') ? 'selected' : ''; ?>>Masculino</option>
                <option value="outro" <?= ($sexo === 'outro') ? 'selected' : ''; ?>>Outro</option>
            </select>
            <br>

            <label for="nome_materno">Nome da Mãe:</label>
            <input type="text" id="nome_materno" name="nome_materno" value="<?= htmlspecialchars($nome_materno); ?>" required>
            <br>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($cpf); ?>" required>
            <br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($email); ?>" required>
            <br>

            <label for="telefone_celular">Telefone Celular:</label>
            <input type="text" id="telefone_celular" name="telefone_celular" value="<?= htmlspecialchars($telefone_celular); ?>" required>
            <br>

            <label for="telefone_fixo">Telefone Fixo:</label>
            <input type="text" id="telefone_fixo" name="telefone_fixo" value="<?= htmlspecialchars($telefone_fixo); ?>">
            <br>

            <label for="endereco">Endereço:</label>
            <input type="text" id="endereco" name="endereco" value="<?= htmlspecialchars($endereco); ?>" required>
            <br>

            <label for="cep">CEP:</label>
            <input type="text" id="cep" name="cep" value="<?= htmlspecialchars($cep); ?>" required>
            <br>

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($cidade); ?>" required>
            <br>
            <div class="botao">
                <button type="submit">Salvar</button>
            </div>
        </form>
    </div>
</body>
</html>

<div class="inf-box">
    <h2>Informações do Perfil:</h2>
    <p><strong>Nome:</strong> <?php echo !empty($nome) ? htmlspecialchars($nome) : 'Não definido'; ?></p>
    <p><strong>Data de Nascimento:</strong> 
    <?php 
    // Verifica se a data de nascimento está vazia ou não
    echo !empty($data_nascimento) 
        ? htmlspecialchars(date('d/m/Y', strtotime($data_nascimento))) 
        : 'Não definido'; 
    ?>
    </p>
    <p><strong>Sexo:</strong> <?php echo !empty($sexo) ? htmlspecialchars($sexo) : 'Não definido'; ?></p>
    <p><strong>Nome da Mãe:</strong> <?php echo !empty($nome_materno) ? htmlspecialchars($nome_materno) : 'Não definido'; ?></p>
    <p><strong>CPF:</strong> <?php echo !empty($cpf) ? htmlspecialchars($cpf) : 'Não definido'; ?></p>
    <p><strong>Email:</strong> <?php echo !empty($email) ? htmlspecialchars($email) : 'Não definido'; ?></p>
    <p><strong>Telefone Celular:</strong> <?php echo !empty($telefone_celular) ? htmlspecialchars($telefone_celular) : 'Não definido'; ?></p>
    <p><strong>Telefone Fixo:</strong> <?php echo !empty($telefone_fixo) ? htmlspecialchars($telefone_fixo) : 'Não definido'; ?></p>
    <p><strong>Endereço:</strong> <?php echo !empty($endereco) ? htmlspecialchars($endereco) : 'Não definido'; ?></p>
    <p><strong>CEP:</strong> <?php echo !empty($cep) ? htmlspecialchars($cep) : 'Não definido'; ?></p>
    <p><strong>Cidade:</strong> <?php echo !empty($cidade) ? htmlspecialchars($cidade) : 'Não definido'; ?></p>
</div>
<p><a href="dashboard_comum.php">Voltar</a></p>
</body>
</html>
