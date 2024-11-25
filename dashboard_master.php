<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header("Location: autenticação.html");  // Redireciona para a página de login, se o usuário não estiver logado
    exit();
}

// Verifica se o usuário tem nível de acesso master
if ($_SESSION['nivel_acesso'] !== 'master') {
    echo "Acesso restrito. Somente usuários master podem acessar esta página.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="css/dashboard_masterr.css">
    
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

        <!-- Acesso Master: menu com links -->
        <h2>Acesso Master</h2>
        <p>Como usuário master, você tem acesso a funcionalidades administrativas.</p>
        <br>
        <ul>
            <li><a href="gerenciar_usuarios.php">Gerenciar Usuários</a></li>
            <li><a href="relatorios.php">Relatórios</a></li>
            <li><a href="perfil_master.php">Meu Perfil</a></li>
            <li><a href="alterar_master.php">Alterar Senha</a></li>
        </ul>
    </div>
</body>
</html>
