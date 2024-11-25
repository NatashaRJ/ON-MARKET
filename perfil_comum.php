<?php
session_start();
require 'conexao.php';

// Verifica se o usuário está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: comum.php");
    exit();
}

// Conecta ao banco de dados
$conn = conectaPDO();

// Recupera os dados do usuário a partir da sessão
$usuario_logado = $_SESSION['usuario'];
$stmt = $conn->prepare("SELECT nome, data_nascimento, sexo, nome_materno, cpf, email, telefone_celular, telefone_fixo, endereco, cep, cidade FROM cadastro WHERE login = :usuario");
$stmt->bindParam(':usuario', $usuario_logado);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// Inicializa os dados do perfil se não existir
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

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Salva os dados do perfil no banco de dados
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

    $stmt = $conn->prepare("UPDATE cadastro SET nome = :nome, data_nascimento = :data_nascimento, sexo = :sexo, nome_materno = :nome_materno, cpf = :cpf, email = :email, telefone_celular = :telefone_celular, telefone_fixo = :telefone_fixo, endereco = :endereco, cep = :cep, cidade = :cidade WHERE login = :usuario");
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
    $stmt->bindParam(':usuario', $usuario_logado);
    $stmt->execute();
    
    // Atualiza as informações na sessão
    $_SESSION['nome'] = $nome;
    $_SESSION['data_nascimento'] = $data_nascimento;
    $_SESSION['sexo'] = $sexo;
    $_SESSION['nome_materno'] = $nome_materno;
    $_SESSION['cpf'] = $cpf;
    $_SESSION['email'] = $email;
    $_SESSION['telefone_celular'] = $telefone_celular;
    $_SESSION['telefone_fixo'] = $telefone_fixo;
    $_SESSION['endereco'] = $endereco;
    $_SESSION['cep'] = $cep;
    $_SESSION['cidade'] = $cidade;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="css/perfil_comumM.css">
</head>
<body>
    <h1>Perfil do Usuário</h1>

    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
        <br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo htmlspecialchars($data_nascimento); ?>" required>
        <br>

        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
            <option value="fem" <?php echo ($sexo === 'fem') ? 'selected' : ''; ?>>Feminino</option>
            <option value="masc" <?php echo ($sexo === 'masc') ? 'selected' : ''; ?>>Masculino</option>
            <option value="outro" <?php echo ($sexo === 'outro') ? 'selected' : ''; ?>>Outro</option>
        </select>
        <br>

        <label for="nome_materno">Nome da Mãe:</label>
        <input type="text" id="nome_materno" name="nome_materno" value="<?php echo htmlspecialchars($nome_materno); ?>" required>
        <br>

        <label for="cpf">CPF:</label>
        <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($cpf); ?>" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        <br>

        <label for="telefone_celular">Telefone Celular:</label>
        <input type="text" id="telefone_celular" name="telefone_celular" value="<?php echo htmlspecialchars($telefone_celular); ?>" required>
        <br>

        <label for="telefone_fixo">Telefone Fixo:</label>
        <input type="text" id="telefone_fixo" name="telefone_fixo" value="<?php echo htmlspecialchars($telefone_fixo); ?>">
        <br>

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($endereco); ?>" required>
        <br>

        <label for="cep">CEP:</label>
        <input type="text" id="cep" name="cep" value="<?php echo htmlspecialchars($cep); ?>" required>
        <br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($cidade); ?>" required>
        <br>

        <button type="submit">Salvar</button>
    </form>

    <h2>Informações do Perfil:</h2>
    <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome) ?: 'Não definido'; ?></p>
    <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars($data_nascimento) ?: 'Não definido'; ?></p>
    <p><strong>Sexo:</strong> <?php echo htmlspecialchars($sexo) ?: 'Não definido'; ?></p>
    <p><strong>Nome da Mãe:</strong> <?php echo htmlspecialchars($nome_materno) ?: 'Não definido'; ?></p>
    <p><strong>CPF:</strong> <?php echo htmlspecialchars($cpf) ?: 'Não definido'; ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($email) ?: 'Não definido'; ?></p>
    <p><strong>Telefone Celular:</strong> <?php echo htmlspecialchars($telefone_celular) ?: 'Não definido'; ?></p>
    <p><strong>Telefone Fixo:</strong> <?php echo htmlspecialchars($telefone_fixo) ?: 'Não definido'; ?></p>
    <p><strong>Endereço:</strong> <?php echo htmlspecialchars($endereco) ?: 'Não definido'; ?></p>
    <p><strong>CEP:</strong> <?php echo htmlspecialchars($cep) ?: 'Não definido'; ?></p>
    <p><strong>Cidade:</strong> <?php echo htmlspecialchars($cidade) ?: 'Não definido'; ?></p>
</body>
</html>
