<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/tabelas.css" rel="stylesheet">
</head>
<body>

<?php
// Incluindo o arquivo de conexão
try {
    require_once '../conexao.php'; // Ajuste o caminho conforme necessário
    $conn = conectaPDO();
} catch (Exception $e) {
    die("<p style='color: red;'>Erro ao incluir conexão: " . $e->getMessage() . "</p>");
}

// Consultando os dados da tabela Produtos
$stmt = $conn->prepare('SELECT * FROM Produtos');
$stmt->execute();

// Exibindo os resultados na tabela
echo '<h1>Tabela Produtos</h1>';
echo "<table>";
echo "<tr>";
echo "<th>Id_prod</th>";
echo "<th>Nome</th>";
echo "<th>Valor</th>";
echo "<th>Fornecedor</th>";
echo "<th>Modelo</th>";
echo "<th>Sit</th>";
echo "</tr>";

// Loop para exibir os registros
while ($registro = $stmt->fetch()) {
    echo "<tr>";
    echo "<td>" . $registro["id_prod"] . "</td>";
    echo "<td>" . $registro["nome"] . "</td>";
    echo "<td>" . $registro["valor"] . "</td>";
    echo "<td>" . $registro["fornecedor"] . "</td>";
    echo "<td>" . $registro["modelo"] . "</td>";
    echo "<td>" . $registro["sit"] . "</td>";
    echo "</tr>";
}

echo "</table>";

// Incluindo o arquivo de pedidos (se necessário)
try {
    require_once 'pedidotab.php'; // Ajuste o caminho conforme necessário
} catch (Exception $e) {
    echo "<p style='color: red;'>Erro ao incluir arquivo de produtos: " . $e->getMessage() . "</p>";
}

?>

</body>
</html>
