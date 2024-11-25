<?php
session_start();  // Inicia a sessão

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: autenticação.html");  // Redireciona para a página de login, se o usuário não estiver logado
    exit();           
}

// Verifica se o usuário tem nível de acesso comum
if ($_SESSION['nivel_acesso'] !== 'comum') {
    echo "Acesso restrito. Somente usuários comuns podem acessar esta página.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/dashboardI_comum.css">
    <title>Painel de Controle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .usuario {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .conteudo {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="usuario">
        Login: <?php echo $_SESSION['usuario']; ?>
        <a href="logout.php">Sair</a>
    </div>

    <div class="conteudo">
        <h1>Bem-vindo ao On Market!</h1>
        <p>Esta é uma área exclusiva para usuários autenticados. Aqui você encontra recursos e informações importantes.</p>
        <img src="img/logo.png" alt="logo" style="width:300px;height:auto;">
        <h2>Acesso Comum</h2>
        <p>Como usuário comum, você tem acesso a diversos recursos. Veja abaixo:</p>
        <ul>
            <li><a href="perfil_comum.php">Meus Dados</a></li>
            <li><a href="alterar_comum.php">Alterar Senha</a></li>
        </ul>
    </div>
</body>
</html>
