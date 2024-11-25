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

$nome = $_POST['nome'];
$data_nascimento = $_POST['data_nascimento'];
$nome_mae = $_POST['nome_materno'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$telefone_celular = $_POST['telefone_celular'];
$telefone_fixo = $_POST['telefone_fixo'];
$endereco = $_POST['endereco'];
$cep = $_POST['cep'];
$cidade = $_POST['cidade'];

// Atualiza as informações do usuário no banco de dados
$stmt = $conn->prepare("UPDATE cadastro SET 
    nome = :nome,
    data_nascimento = :data_nascimento,
    nome_mae = :nome_mae,
    cpf = :cpf,
    email = :email,
    telefone_celular = :telefone_celular,
    telefone_fixo = :telefone_fixo,
    endereco = :endereco,
    cep = :cep,
    cidade = :cidade
WHERE login = :login");

$stmt->bindParam(':nome', $nome);
$stmt->bindParam(':data_nascimento', $data_nascimento);
$stmt->bindParam(':nome_mae', $nome_mae);
$stmt->bindParam(':cpf', $cpf);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':telefone_celular', $telefone_celular);
$stmt->bindParam(':telefone_fixo', $telefone_fixo);
$stmt->bindParam(':endereco', $endereco);
$stmt->bindParam(':cep', $cep);
$stmt->bindParam(':cidade', $cidade);
$stmt->bindParam(':login', $_SESSION['usuario']);

try {
    $stmt->execute();

    $_SESSION['nome'] = $nome;
    echo "Perfil atualizado com sucesso!";
    header("Location: perfil_master.php");
    exit();
} catch (PDOException $e) {
    echo "Erro ao atualizar o perfil: " . $e->getMessage();
}
?>
