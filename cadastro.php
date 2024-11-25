<?php
require 'conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Coleta e sanitização de dados do formulário

// Captura o valor do campo sexo
$sexo = isset($_POST['sexo']) ? htmlspecialchars($_POST['sexo']) : null;
    
// Validação para garantir que o valor está no conjunto permitido
$valores_permitidos = ['fem', 'masc', 'outro'];
if (!in_array($sexo, $valores_permitidos)) {
    $sexo = null; // Ou trate como erro, exibindo uma mensagem
    echo "<div class='mensagem'>Erro: Sexo inválido.</div>";
    exit(); // Para impedir o cadastro com valor inválido
}

    $nome = htmlspecialchars($_POST['nome']);
    $data_nascimento = htmlspecialchars($_POST['data_nascimento']);
    $sexo = isset($_POST['sexo']) ? htmlspecialchars($_POST['sexo']) : null;
    $nome_materno = htmlspecialchars($_POST['nome_materno']);
    $cpf = htmlspecialchars($_POST['cpf']);
    $email = htmlspecialchars($_POST['email']);
    $telefone_celular = htmlspecialchars($_POST['telefone_celular']);
    $telefone_fixo = htmlspecialchars($_POST['telefone_fixo']);
    $endereco = htmlspecialchars($_POST['endereco']);
    $cep = htmlspecialchars($_POST['cep']);
    $cidade = htmlspecialchars($_POST['cidade']);
    $login = htmlspecialchars($_POST['login']);
    $senha = $_POST['senha'];
    $nivel_acesso = htmlspecialchars($_POST['nivel_acesso']); // 'comum' ou 'master'
     
    // Criptografando a senha
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

    // Conexão com o banco de dados
    $conn = conectaPDO();

    try {
        // Verificação de duplicidade para CPF ou login
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM cadastro WHERE cpf = :cpf OR login = :login");
        $checkStmt->bindParam(':cpf', $cpf);
        $checkStmt->bindParam(':login', $login);
        $checkStmt->execute();
        $exists = $checkStmt->fetchColumn();

        if ($exists > 0) {
            echo "<div class='mensagem'>Erro: Usuário ou CPF já cadastrado.</div>";
        } else {
            // Preparação da consulta SQL para inserção
            $stmt = $conn->prepare("INSERT INTO cadastro (nome, data_nascimento, sexo, nome_materno, cpf, email, telefone_celular, telefone_fixo, endereco, cep, cidade, login, senha, nivel_acesso, data_cadastro) VALUES (:nome, :data_nascimento, :sexo, :nome_materno, :cpf, :email, :telefone_celular, :telefone_fixo, :endereco, :cep, :cidade, :login, :senha, :nivel_acesso, NOW())");

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
            $stmt->bindParam(':login', $login);
            $stmt->bindParam(':senha', $senha_criptografada);
            $stmt->bindParam(':nivel_acesso', $nivel_acesso);

            // Execução e feedback
            if ($stmt->execute()) {
                echo "<div class='mensagem'>Usuário cadastrado com sucesso!</div>";
            } else {
                echo "<div class='mensagem'>Erro ao cadastrar usuário.</div>";
            }
        }
    } catch (PDOException $e) {
        echo "<div class='mensagem'>Erro: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link  href="css/cadastro.css" rel="stylesheet" >
    <link href="css/validacao.css" rel="stylesheet" >
  
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
  <div class="main-container">
  <div class="letra">
  <h1>Vamos criar seu perfil!</h1>
</div>
  <form action="cadastro.php" method="post" enctype="multipart/form-data">
    <label for="nome">Nome Completo:</label>
    <input type="text" id="nome" name="nome" placeholder="Escreva seu nome completo" required>
    <br>

    <label for="data_nascimento">Data de Nascimento:</label>
    <input type="date" id="data_nascimento" name="data_nascimento" required>
    <br>

    <label for="sexo">Sexo:</label>
    <select name="sexo" id="sexo" required>
    <option value="masc">Masculino</option>
    <option value="fem">Feminino</option>
    <option value="outro">Outro</option>
    </select>

    <br>
    <label for="nome_materno">Nome Materno:</label>
    <input type="text" id="nome_materno" name="nome_materno" placeholder="Escreva o nome materno" required>
    <br>

    <label for="cpf">Digite o CPF (somente números):</label>
    <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="123.456.789-01" required pattern="^(\d{3}\.\d{3}\.\d{3}-\d{2}|\d{11})$">
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Escreva seu email" required>
    <br>

    <label for="telefone_celular">Telefone Celular:</label>
    <input type="tel" id="telefone_celular" name="telefone_celular" placeholder="(+55) XX-XXXXX-XXXX" required>
    <br>

    <label for="telefone_fixo">Telefone Fixo:</label>
    <input type="tel" id="telefone_fixo" name="telefone_fixo" placeholder="(+55) XX-XXXX-XXXX">
    <br>

    <label for="endereco">Endereço Completo:</label>
    <input type="text" id="endereco" name="endereco" placeholder="Rua/Bairro/Número" required>
    <br>

    <label for="cep">CEP:</label>
    <input type="text" id="cep" name="cep" placeholder="00000-000" required>
    <br>

    <label for="cidade">Cidade:</label>
    <input type="text" id="cidade" name="cidade" placeholder="Escreva Sua Cidade" required>
    <br>

    <label for="login">Crie seu Login:</label>
    <input type="text" id="login" name="login" placeholder="Escolha um login" required>
    <br>

    <label for="senha">Criar uma senha:</label>
    <input type="password" id="senha" name="senha" placeholder="Crie uma senha" minlength="8" required>
    <br>

    <label for="confirmar_senha">Confirme sua senha:</label>
    <input type="password" id="confirmar_senha" name="confirmar_senha" placeholder="Confirme sua senha" minlength="8" required>
    <br>

    <label for="nivel_acesso">Nível de Acesso:</label>
    <select id="nivel_acesso" name="nivel_acesso" required>
        <option value="comum">Comum</option>
        <option value="master">Master</option>
    </select>
    <br>
  <input type="submit" value="Cadastrar">
  <input type="reset" value="Limpar">
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

