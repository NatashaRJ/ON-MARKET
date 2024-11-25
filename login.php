<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>On Market</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/DPLUS.css">

</head>

<body>
  <header>
    <div class="logo">
      <a href="index.html"><img src="img/logo.png" alt="Logo"></a>
    </div>
    <h1 class="titulo">ON MARKET</h1>

    <nav class="menu-navegacao">
      <ul class="barra-navegacao">
        <li class="botao-letra"></li>
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
          <a href="#" onclick="toggleDarkMode()"><img src="img/dark.png" alt="Modo Escuro" class="dark-icon"></a>
        </li>
      </ul>
    </nav>
  </header>

  <div id="cart" class="cart">
    <h2>Carrinho de Compras</h2>
    <ul id="cart-items"></ul>
    <button onclick="clearCart()">Limpar Carrinho</button>
    <button onclick="toggleCart()">Fechar Carrinho</button>
    <button onclick="window.location.href='pagamento.html'">Pagar</button>
  </div>

  <div class="center-container">
  <h1>Bem-vindo ao Sistema do On Market</h1>
  <div class="login-button">
    <a class="login-button" href="comum.php">Login Comum</a>
    <a class="login-button" href="master.php">Login Master</a>
  </div>
  <h2>Recuperação de Senha</h2>
  <div class="forgot-password">
    <p><a href="enviar_codigo.php">Esqueci a Senha</a></p>
  </div>
</div>



    <footer>
    <p>&copy; 2024 ON MARKET. Todos os direitos reservados.</p>
    <p>Entre em contato conosco: (21) 1234-5678</p>
    <div class="footer-logo">
      <img src="img/logo.png" alt="Logo">
      <p>Preço bom sempre é ON!</p>
    </div>
  </footer>

<script src="js/carrinho.js"></script>
<script src="js/modoescuro.js"></script>
<script src="js/validacao.js"></script>
<script src="js/DPLUS.js"></script>

</body>
</html>

