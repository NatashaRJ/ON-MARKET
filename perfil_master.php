<?php
session_start();
require 'conexao.php';
$conn = conectaPDO();

if (!$conn) {
    die("Erro ao conectar ao banco de dados.");
}

if (!isset($_SESSION['usuario'])) {
    header("Location: master.php");
    exit();
}

// Recupera os dados do usuário com base no login
$stmt = $conn->prepare("SELECT * FROM cadastro WHERE login = :login");
$stmt->bindParam(':login', $_SESSION['usuario']);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("Usuário não encontrado.");
}

$isMaster = $usuario['nivel_acesso'] === 'master';

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Captura o valor do campo sexo
$sexo = isset($_POST['sexo']) ? htmlspecialchars($_POST['sexo']) : null;
    
// Validação para garantir que o valor está no conjunto permitido
$valores_permitidos = ['fem', 'masc', 'outro'];
if (!in_array($sexo, $valores_permitidos)) {
    $sexo = null; // Ou trate como erro, exibindo uma mensagem
    echo "<div class='mensagem'>Erro: Sexo inválido.</div>";
    exit(); // Para impedir o cadastro com valor inválido
}

    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = isset($_POST['sexo']) ? htmlspecialchars($_POST['sexo']) : null;
    $nome_materno = $_POST['nome_materno'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone_celular = $_POST['telefone_celular'];
    $telefone_fixo = $_POST['telefone_fixo'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];

    // Atualiza os dados no banco de dados
    $updateStmt = $conn->prepare(
        "UPDATE cadastro 
        SET nome = :nome, 
            data_nascimento = :data_nascimento,
            sexo = :sexo, 
            nome_materno = :nome_materno, 
            cpf = :cpf, 
            email = :email, 
            telefone_celular = :telefone_celular, 
            telefone_fixo = :telefone_fixo, 
            endereco = :endereco, 
            cep = :cep, 
            cidade = :cidade 
        WHERE login = :login"
    );

    $updateStmt->bindParam(':nome', $nome);
    $updateStmt->bindParam(':data_nascimento', $data_nascimento);
    $updateStmt->bindParam(':sexo', $sexo);
    $updateStmt->bindParam(':nome_materno', $nome_materno);
    $updateStmt->bindParam(':cpf', $cpf);
    $updateStmt->bindParam(':email', $email);
    $updateStmt->bindParam(':telefone_celular', $telefone_celular);
    $updateStmt->bindParam(':telefone_fixo', $telefone_fixo);
    $updateStmt->bindParam(':endereco', $endereco);
    $updateStmt->bindParam(':cep', $cep);
    $updateStmt->bindParam(':cidade', $cidade);
    $updateStmt->bindParam(':login', $_SESSION['usuario']);

    if ($updateStmt->execute()) {
        echo "Perfil atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar o perfil.";
    }
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
    <br>
    <br>
    <p>Usuário: <?php echo htmlspecialchars($usuario['login']); ?></p>


    <!-- Formulário para atualização de dados -->
    <form method="POST" action="">
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
    <br>

    <label for="data_nascimento">Data de Nascimento:</label>
    <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo htmlspecialchars($usuario['data_nascimento']); ?>" required>
    <br>

    <label for="sexo">Sexo:</label>
<select name="sexo" id="sexo" required>
    <option value="masc">Masculino</option>
    <option value="fem">Feminino</option>
    <option value="outro">Outro</option>
</select>
<br>
<br>

    <label for="nome_materno">Nome da Mãe:</label>
    <input type="text" id="nome_materno" name="nome_materno" value="<?php echo htmlspecialchars($usuario['nome_materno']); ?>" required>
    <br>

    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($usuario['cpf']); ?>" required>
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
    <br>

    <label for="telefone_celular">Telefone Celular:</label>
    <input type="text" id="telefone_celular" name="telefone_celular" value="<?php echo htmlspecialchars($usuario['telefone_celular']); ?>" required>
    <br>

    <label for="telefone_fixo">Telefone Fixo:</label>
    <input type="text" id="telefone_fixo" name="telefone_fixo" value="<?php echo htmlspecialchars($usuario['telefone_fixo']); ?>">
    <br>

    <label for="endereco">Endereço:</label>
    <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($usuario['endereco']); ?>" required>
    <br>

    <label for="cep">CEP:</label>
    <input type="text" id="cep" name="cep" value="<?php echo htmlspecialchars($usuario['cep']); ?>" required>
    <br>

    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($usuario['cidade']); ?>" required>
    <br>

    <button type="submit">Atualizar</button>
</form>

</body>
</html>
