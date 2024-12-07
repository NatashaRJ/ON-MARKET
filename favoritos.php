<?php
session_start();
require 'conexao.php'; // Arquivo de conexão ao banco de dados

if (!isset($_SESSION['favoritos'])) {
    $_SESSION['favoritos'] = [];
}

// Conectar ao banco de dados
try {
    $pdo = conectaPDO(); // Função que retorna o objeto PDO
} catch (PDOException $e) {
    die("Erro ao conectar ao banco de dados: " . $e->getMessage());
}

// Adicionar aos favoritos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar_favorito'])) {
    $produto = $_POST['produto'];
    if (!in_array($produto, $_SESSION['favoritos'])) {
        $_SESSION['favoritos'][] = $produto;
        $mensagem = "Produto adicionado aos favoritos!";
    }
}

// Remover dos favoritos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remover_favorito'])) {
    $produto = $_POST['produto'];
    if (($key = array_search($produto, $_SESSION['favoritos'])) !== false) {
        unset($_SESSION['favoritos'][$key]);
        $mensagem = "Produto removido dos favoritos!";
    }
}

// Buscar os produtos no banco de dados
try {
    $stmt = $pdo->prepare("SELECT id_prod, nome FROM produtos");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar produtos: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritos</title>
    <link rel="stylesheet" href="css/favorito.css">
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


<h1>Gerenciar Favoritos</h1>

<!-- Mensagem de Feedback -->
<?php if (isset($mensagem)): ?>
    <p class="mensagem"><?php echo htmlspecialchars($mensagem); ?></p>
<?php endif; ?>

<!-- Lista de Produtos -->
<div class="produtos">
    <h2>Produtos Disponíveis</h2>
    <?php foreach ($produtos as $produto): ?>
        <div class="produto-item">
            <div class="produto-nome"><?php echo htmlspecialchars($produto['nome']); ?></div>
            <div class="produto-form">
                <form method="POST">
                    <input type="hidden" name="produto" value="<?php echo htmlspecialchars($produto['nome']); ?>">
                    <button class="btn-12" type="submit" name="adicionar_favorito">
                        <span>Adicionar</span>
                        <span>Adicionar</span>
                    </button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Favoritos -->
<div class="favoritos">
    <h2>Seus Favoritos</h2>
    <?php if (!empty($_SESSION['favoritos'])): ?>
        <?php foreach ($_SESSION['favoritos'] as $favorito): ?>
            <div class="favorito-item">
                <div class="favorito-nome"><?php echo htmlspecialchars($favorito); ?></div>
                <div class="favorito-form">
                    <form method="POST">
                        <input type="hidden" name="produto" value="<?php echo htmlspecialchars($favorito); ?>">
                        <button class="btn-12 delete-btn" type="submit" name="remover_favorito">
                            <span>Remover</span>
                            <span>Remover</span>
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="MSN">
        <p>Você ainda não adicionou nenhum favorito.</p>
        </div>
    <?php endif; ?>
</div>

<div id="cart" class="cart">
    <h2>Carrinho de Compras</h2>
    <ul id="cart-items"></ul>
    <button onclick="clearCart()">Limpar Carrinho</button>
    <button onclick="toggleCart()">Fechar Carrinho</button>
    <button id="pay-button">Pagar</button>
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