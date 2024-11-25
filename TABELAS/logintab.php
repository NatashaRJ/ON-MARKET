<?php
// Incluindo o arquivo de conexão
try {
    require_once '../conexao.php'; // Ajuste o caminho conforme necessário
    $conn = conectaPDO();
} catch (Exception $e) {
    die("<p style='color: red;'>Erro ao incluir conexão: " . $e->getMessage() . "</p>");
}

// Consulta ao banco de dados
try {
    // Preparando a consulta para a tabela login
    $stmt = $conn->prepare('SELECT id_log, usuario, senha, tipo FROM login'); // Ajuste para o nome da tabela correta
    $stmt->execute(); // Execute a consulta

    // Exibindo os resultados
    echo '<div class="login"><h1>Tabela Login</h1>';
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Id_log</th>";
    echo "<th>Usuário</th>";
    echo "<th>Senha</th>";
    echo "<th>Tipo</th>";
    echo "</tr>";

    // Usando fetch() para obter os dados
    while ($registro = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($registro["id_log"]) . "</td>";
        echo "<td>" . htmlspecialchars($registro["usuario"]) . "</td>";
        echo "<td>" . htmlspecialchars($registro["senha"]) . "</td>";
        echo "<td>" . htmlspecialchars($registro["tipo"]) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "</div>";
} catch (Exception $e) {
    // Caso ocorra um erro na consulta
    echo "<p style='color: red;'>Erro ao consultar o banco de dados: " . $e->getMessage() . "</p>";
}

// Incluindo o arquivo de produtos, ajustando o caminho conforme necessário
try {
    require_once 'produtostab.php'; // Ajuste o caminho conforme necessário
} catch (Exception $e) {
    echo "<p style='color: red;'>Erro ao incluir arquivo de produtos: " . $e->getMessage() . "</p>";
}

?>
