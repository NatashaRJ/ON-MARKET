<?php
require 'conexao.php';  // Certifique-se de que a função de conexão está corretamente configurada

// Verificar se o e-mail foi passado via GET
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    // Conectar ao banco de dados
    $conn = conectaPDO();

    // Verificar se o e-mail existe na base de dados
    $query = $conn->prepare("SELECT * FROM cadastro WHERE email = ?");
    $query->execute([$email]);
    $usuario = $query->fetch();

    if ($usuario) {
        // Se o usuário existe, permitir a redefinição da senha
        if (isset($_POST['nova_senha'], $_POST['confirma_senha'])) {
            $nova_senha = $_POST['nova_senha'];
            $confirma_senha = $_POST['confirma_senha'];

            // Verificar se as senhas coincidem
            if ($nova_senha === $confirma_senha) {
                // Gerar o hash da nova senha
                $senha_hash = password_hash($nova_senha, PASSWORD_BCRYPT);

                // Atualizar a senha no banco de dados
                $update = $conn->prepare("UPDATE cadastro SET senha = ?, codigo_verificacao = NULL, codigo_expiry = NULL WHERE email = ?");
                if ($update->execute([$senha_hash, $email])) {
                    echo 'Senha redefinida com sucesso!';
                } else {
                    echo 'Erro ao redefinir a senha. Tente novamente mais tarde.';
                }
            } else {
                echo 'As senhas não coincidem. Tente novamente.';
            }
        }
    } else {
        echo "Nenhum usuário encontrado com esse e-mail.";
    }
} else {
    echo "E-mail não fornecido.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link  href="css/redefinir_senha.css" rel="stylesheet" >
    
  
</head>
<body>
    <!-- Cabeçalho -->
    <header>
    <div class="logo">
      <a href="index.html"><img src="img/logo.png" alt="Logo"></a>
    </div>
    <h1 class="titulo">ON MARKET</h1>

    <nav class="menu-navegacao">
      <ul class="barra-navegacao">

      <li class="botao-letra">
                <button onclick="aumentarLetra()">Aumentar</button> 

                <button onclick="diminuirLetra()">Diminuir</button>
              </li>

        <li><a href="index.html">Home</a></li>
        <li><a href="favoritos.php">Favoritos</a></li>
        <li>
          <a href="produtos.php">Produtos</a>
          <ul class="sub-menu">
            <li><a href="destaque.html">Produtos Destaque</a></li>
          </ul>
        </li>
        <li>
        <a href="login.php">Login Perfil</a>
          <ul class="sub-menu">
            <li><a href="cadastro.php">Cadastre-se</a></li>
          </ul>
        </li>
        <li>
          <a href="#" onclick="toggleCart()"><img src="img/carrinho.png" alt="Carrinho" class="cart-icon"></a>
        </li>
        <li>
      <button class="dark-mode-toggle" onclick="toggleDarkMode()">
        <img src="img/dark.png" alt="Modo Escuro" class="dark-mode-icon">
      </button>
    </nav>
  </header>
  <div class="container">
    <form method="POST" action="">
        <label for="nova_senha">Nova Senha:</label>
        <div class="password-container">
            <input type="password" name="nova_senha" id="nova_senha" required>
            <button type="button" class="toggle-password" onclick="togglePassword('nova_senha')">👁</button>
        </div>

        <label for="confirma_senha">Confirmar Senha:</label>
        <div class="password-container">
            <input type="password" name="confirma_senha" id="confirma_senha" required>
            <button type="button" class="toggle-password" onclick="togglePassword('confirma_senha')">👁</button>
        </div>

        <button type="submit" class="submit-button">Redefinir Senha</button>
    </form>
</div>

<div id="cart" class="cart" style="display: none;"> <!-- Inicialmente escondido -->
    <h2>Carrinho de Compras</h2>
    <ul id="cart-items"></ul>
    <button onclick="clearCart()">Limpar Carrinho</button>
    <button onclick="toggleCart()">Fechar Carrinho</button>
    <button onclick="window.location.href='pagamento.html'">Pagar</button>
  </div>

     <footer>
    <p>&copy; 2024 ON MARKET. Todos os direitos reservados.</p>
    <p>Entre em contato conosco: (21) 1234-5678</p>
    <div class="footer-logo">
      <img src="img/logo.png" alt="Logo">
      <p>Preço bom sempre é ON!</p>
    </div>
  </footer>


    <script src="js/carregador.js"></script>
    <script src="js/DPLUS.js"></script>
    <script src="js/visibilidade.js"></script>
</body>
</html>