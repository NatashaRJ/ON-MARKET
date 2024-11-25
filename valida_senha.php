<?php
require 'conexao.php';  // Certifique-se de que a função de conexão está corretamente configurada

// Verificar se o código e o e-mail foram enviados via POST
if (isset($_POST['codigo']) && isset($_POST['email'])) {
    $codigo_digitado = $_POST['codigo'];
    $email = $_POST['email'];

    // Conectar ao banco de dados
    $conn = conectaPDO();

    // Recuperar o código de verificação armazenado e a validade
    $query = $conn->prepare("SELECT codigo_verificacao, codigo_expiry FROM cadastro WHERE email = ?");
    $query->execute([$email]);
    $usuario = $query->fetch();

    // Verificar se o código digitado corresponde ao armazenado no banco de dados
    if ($usuario) {
        if ($usuario['codigo_verificacao'] == $codigo_digitado) {
            // Verificar se o código ainda é válido (não expirou)
            if (strtotime($usuario['codigo_expiry']) > time()) {
                echo "Código verificado com sucesso! Agora você pode redefinir sua senha.";

                // Apagar o código de verificação após usá-lo
                $update = $conn->prepare("UPDATE cadastro SET codigo_verificacao = NULL, codigo_expiry = NULL WHERE email = ?");
                $update->execute([$email]);

                // Redirecionar para o formulário de redefinição de senha com o e-mail na URL
                header("Location: redefinir_senha.php?email=$email");
                exit();
            } else {
                echo "O código de verificação expirou.";
                // Apagar o código expirado
                $update = $conn->prepare("UPDATE cadastro SET codigo_verificacao = NULL, codigo_expiry = NULL WHERE email = ?");
                $update->execute([$email]);
            }
        } else {
            echo "Código inválido.";
        }
    } else {
        echo "Nenhum usuário encontrado com esse e-mail.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validar Senha</title>
    <link  href="css/valida_senha.css" rel="stylesheet" >
    
  
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
<!-- Formulário para o usuário inserir o código -->
<div class="container">
<form method="POST" action="">
    <label for="codigo">Digite o código enviado para o seu e-mail:</label>
    <input type="text" name="codigo" required><br>

    <label for="email">Digite seu e-mail:</label>
    <input type="email" name="email" required><br>

    <button type="submit">Verificar Código</button>
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
    <script src="js/validacao.js"></script>
    <script src="js/DPLUS.js"></script>
</body>
</html>