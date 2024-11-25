<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
<?php
session_start();  // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    echo "<p>Você não está logado. Faça login para continuar.</p>";
    exit();
}

// Verifica se os dados foram enviados via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário e os sanitiza
    $nome_mae = htmlspecialchars($_POST['nome_mae']);
    $data_nascimento = htmlspecialchars($_POST['data_nascimento']);
    $cep = htmlspecialchars($_POST['cep']);

    // Verifica se todos os campos estão preenchidos
    if (!empty($nome_mae) && !empty($data_nascimento) && !empty($cep)) {
        // Exibe os dados inseridos pelo usuário
        echo "<h2>Olá, {$_SESSION['usuario']}! O nome da sua mãe é: $nome_mae!</h2>";
        echo "<p>A data do seu nascimento é: $data_nascimento.</p>";
        echo "<p>Você mora no CEP: $cep.</p>";

        // Agora, processa os dados e define o nível de acesso
        // Aqui você define o nível de acesso e o usuário (simulação)
        $usuario = $_SESSION['usuario'];  // Nome do usuário logado
        $nivel_acesso = 'comum';  // Definindo o nível de acesso como "comum"

        // Salva o nome de usuário e o nível de acesso na sessão
        $_SESSION['usuario'] = $usuario;
        $_SESSION['nivel_acesso'] = $nivel_acesso;

        // Redireciona para a página de dashboard após exibir as informações
        header("Location: dashboard_comum.php");
        exit();  // Importante para garantir que o código após o redirecionamento não seja executado
    } else {
        echo "<p>Os dados não foram preenchidos corretamente.</p>";
    }
} else {
    echo "<p>Dados não enviados corretamente.</p>";
}
?>
</body>
</html>
