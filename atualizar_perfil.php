<?php
session_start();
require 'conexao.php';

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");  // Redireciona para a página de login se não estiver logado
    exit();
}

// Recupera o login do usuário logado
$usuario_login = $_SESSION['usuario'];

// Estabelece a conexão com o banco de dados
$conn = conectaPDO();

// Verifica se a conexão foi bem-sucedida
if (!$conn) {
    die("Erro ao conectar ao banco de dados.");
}

// Verifica se os dados do formulário foram enviados
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitiza e obtém os dados enviados
    $nome = $_POST['nome'];
    $data_nascimento = $_POST['data_nascimento'];
    $sexo = $_POST['sexo'];
    $nome_materno = $_POST['nome_materno'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $telefone_celular = $_POST['telefone_celular'];
    $telefone_fixo = $_POST['telefone_fixo'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $cidade = $_POST['cidade'];

     // Converte a data de DD/MM/AAAA para o formato AAAA-MM-DD
     $data_nascimento = DateTime::createFromFormat('Y-m-d', $data_nascimento);
     if ($data_nascimento) {
         $data_nascimento = $data_nascimento->format('Y-m-d');
     } else {
         die("Data de nascimento inválida.");
     }

     // Formata a data de nascimento para o formato AAAA-MM-DD
if (!empty($data_nascimento)) {
    $data_nascimento = date('Y-m-d', strtotime($data_nascimento));
}

    // Atualiza os dados do usuário no banco de dados
    $stmt = $conn->prepare("UPDATE cadastro SET nome = :nome, data_nascimento = :data_nascimento, sexo = :sexo, nome_materno = :nome_materno, cpf = :cpf, email = :email, telefone_celular = :telefone_celular, telefone_fixo = :telefone_fixo, endereco = :endereco, cep = :cep, cidade = :cidade WHERE login = :login");
    
    // Bind dos parâmetros
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
    $stmt->bindParam(':login', $usuario_login);

  
    // Executa a atualização
    if ($stmt->execute()) {
        // Define a mensagem de sucesso na sessão
        $_SESSION['mensagem'] = "Dados atualizado com sucesso!";
        // Redireciona para o perfil atualizado
        header("Location: perfil_master.php");
        exit();
    } else {
        echo "Erro ao atualizar os dados.";
    }
}
?>
