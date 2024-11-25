<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>On Market</title>
  <link href="css/produtoss.css" rel="stylesheet">
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

  <h2 align="center">Produtos</h2>
  <br>

  <h2>Confira abaixo nossos produtos!</h2>
  <br>
  <main>
    <section class="about">
      <center><img src="img/fone.png" width="200" height="250" alt="fone de ouvido Bluetooth"></center>
      <a href="fone.html"><p>Fone de ouvido sem fio TWS Philips TAT1108BK/00 - bluetooth com microfone, formato em haste, IPX4, energia para 15 horas totais e na cor preto</p>
        <strong><h3>R$299,99</h3></a></strong>
      <button onclick="addToCart('Fone de ouvido', 299.99)">Adicionar ao Carrinho</button>
    </section>
    <br>
    <section class="about">
      <center><img src="img/firestick.png" width="200" height="250" alt="firestick"></center>
      <a href="firestick.html"><p>TV Stick Lite | Streaming em Full HD com Alexa | Com Controle Remoto Lite por Voz com Alexa (sem controles de TV)</p>
        <strong><h3>R$255,51</h3></a></strong>
        <button onclick="addToCart('TV Stick Lite', 255.51)">Adicionar ao Carrinho</button>
    
    </section>
    <br>
    <section class="about">
      <center><img src="img/celular1.png" width="200" height="250" alt="xiaomi 13"></center>
      <a href="celula.html"><p>Xiaomi Redmi Note 13 8+256G Global Version Powerful Snapdragon® performance 120Hz FHD+ AMOLED display 33W fast charging with 5000mAh battery No NFC (Black)</p>
        <strong><h3>R$1.199,99</h3></a></strong>
      <button onclick="addToCart('Xiaomi Redmi Note 13', 1199.99)">Adicionar ao Carrinho</button>
    </section>
    <br>
    <section class="about">
      <center><img src="img/carregador.png" width="150" height="250" alt="carregador.html"></center>
      <a href="carregador.html"><p>Portátil (Power Bank) Ultra Rápido 10000mAh Power Delivery 20W 2 Saídas USB + 1 Saída/Entrada USB-C Preto I2GO - I2GO PRO</p>
        <strong><h3>R$149,99</h3></a></strong>
      <button onclick="addToCart('Power Bank', 149.99)">Adicionar ao Carrinho</button>
    </section>
    <br>
    <section class="about">
      <center><img src="img/gabinete.png" width="200" height="250" alt="Gabinete"></center>
      <a href="gabinete.html"><p>Gabinete Gamer Rise Mode Glass 06X, Mid Tower, Lateral em Vidro Fumê e Frontal em Vidro Temperado, Preto - RM-CA-06X-FB</p>
        <strong><h3>R$149,99</h3></a></strong>
      <button onclick="addToCart('Gabinete', 149.99)">Adicionar ao Carrinho</button>
    </section>
    <br>
    <section class="about">
      <center><img src="img/processador.png" width="200" height="250" alt="Processador"></center>
      <a href="processador.html"><p>Processador AMD Ryzen 7 5700X 3.4GHz</p>
        <strong><h3>R$2.500,00</h3></a></strong>
      <button onclick="addToCart('Processador', 2.500)">Adicionar ao Carrinho</button>
    </section>
  <br>
  <section class="about">
    <center><img src="img/maquina.jpg" width="250" height="250" alt="maquina"></center>
    <a href="maquina.html"><p>Samsung Lava e Seca 11kg Branco WD11M4473PW - 127V</p>
      <strong><h3>R$3.829,00</h3></a></strong>
      <button onclick="addToCart('Maquina de Lava e Seca', 3829)">Adicionar ao Carrinho</button>
  </section>
<br>
<section class="about">
    <center><img src="img/geladeira.jpg" width="250" height="250" alt="refrigerador"></center>
    <a href="refrigerador.html"><p>Refrigerador 260L 2 Portas Classe A 220 Volts, Branco, Electrolux</p>
      <strong><h3>R$2.289,00</h3></a></strong>
      <button onclick="addToCart('Refrigerador de 2 Portas Branco', 3829)">Adicionar ao Carrinho</button>
  </section>

</main>


  <div id="cart" class="cart">
    <h2>Carrinho de Compras</h2>
    <ul id="cart-items"></ul>
    <button onclick="clearCart()">Limpar Carrinho</button>
    <button onclick="toggleCart()">Fechar Carrinho</button>
    <button id="pay-button">Pagar</button> <!-- Adicionado o botão de pagamento -->
  </div>


  <footer>
    <p>&copy; 2024 ON MARKET. Todos os direitos reservados.</p>
    <p>Entre em contato conosco: (21) 1234-5678</p>
    <div class="footer-logo">
      <img src="img/logo.png" alt="Logo">
      <p>Preço bom sempre é ON!</p>
    </div>
  </footer>

  <script src="js/produtos.js"></script>
  <script src="js/carregador.js"></script>
  <script src="js/DPLUS.js"></script>
  
</body>

</html>
 
  
  