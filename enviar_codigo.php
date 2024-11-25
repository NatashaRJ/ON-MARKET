<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
require 'conexao.php';  // Certifique-se de que a função de conexão está corretamente configurada

// Verifica se o e-mail foi enviado via POST
if (isset($_POST['email'])) {
    $email = $_POST['email'];

    // Conectar ao banco de dados
    $conn = conectaPDO();

    // Gerar código aleatório
    $codigo = rand(100000, 999999);

    // Definir o tempo de expiração (por exemplo, 15 minutos)
    $expiracao = date('Y-m-d H:i:s', strtotime('+15 minutes'));

    // Atualizar o banco de dados com o código gerado e a data de expiração
    $query = $conn->prepare("UPDATE cadastro SET codigo_verificacao = ?, codigo_expiry = ? WHERE email = ?");
    $query->execute([$codigo, $expiracao, $email]);

    // ALTERADO: GERAR O LINK DE REDEFINIÇÃO DE SENHA COM O CAMINHO DE SUA ESCOLHA
    $link_redefinicao = "http://localhost/NAT/GRUPO%2004-%202024-1-%20Natasha/valida_senha.php?codigo=840880&email=natasharj07@gmail.com";

   // Criar uma instância do PHPMailer
$mail = new PHPMailer(true);

try {
    // Configuração do servidor de e-mail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'natasharj07@gmail.com';  // Seu e-mail de envio
    $mail->Password = 'wztg jiuh zcbd jpzh';  // Sua senha de aplicativo
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Destinatário
    $mail->setFrom('natasharj07@gmail.com', 'Natasha');
    $mail->addAddress($email);  // Endereço de e-mail do usuário

    // Conteúdo do e-mail
    $mail->isHTML(true);
    $mail->Subject = 'Redefinição de Senha';

    // Corpo do e-mail com o código e o link
    $mail->Body = "
        <p>Você solicitou a redefinição de senha. Aqui está o código de verificação:</p>
        <p><strong>Código de Verificação: $codigo</strong></p>
        <p>Clique no link abaixo para redefinir sua senha:</p>
        <p><a href='$link_redefinicao'>$link_redefinicao</a></p>
    ";

    // Enviar o e-mail
    $mail->send();
    echo 'Código enviado para o e-mail!';

} catch (Exception $e) {
    echo "Erro ao enviar o código: {$mail->ErrorInfo}";
}
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Código</title>
    <link  href="css/enviar_codigo.css" rel="stylesheet" >
    
  
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
<!-- Formulário para o usuário inserir o e-mail -->
<div class="container">
    <div class="formulario">
        <form method="POST" action="">
            <label for="email">Digite seu e-mail:</label>
            <input type="email" name="email" required><br>
    
           <button class="glow-on-hover">ENVIAR CÓDIGO</button>


        </form>
    </div>
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