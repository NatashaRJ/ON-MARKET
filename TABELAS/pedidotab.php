<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Pedidos</title>
    <link href="../css/tabelas.css" rel="stylesheet"> <!-- Link para o arquivo CSS -->
    
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

// Consultando os dados da tabela Pedido
$stmt = $conn->prepare('SELECT * FROM Pedido');
$stmt->execute();

// Exibindo os resultados na tabela
echo '<h1>Tabela Pedido</h1>';
echo "<table>";
echo "<tr>";
echo "<th>Id_ped</th>";
echo "<th>N°_do_pedido</th>";
echo "<th>Data_do_pedido</th>";
echo "<th>Status</th>";
echo "<th>Id_cad</th>";
echo "</tr>";

// Loop para exibir os registros
while ($registro = $stmt->fetch()) {
    echo "<tr>";
    echo "<td>" . $registro["id_ped"] . "</td>";
    echo "<td>" . $registro["n°_do_pedido"] . "</td>";
    echo "<td>" . $registro["data_do_pedido"] . "</td>";
    echo "<td>" . $registro["status"] . "</td>";
    echo "<td>" . $registro["id_cad"] . "</td>";
    echo "</tr>";
}

echo "</table>";

// Incluindo o arquivo de compras (se necessário)
try {
    require_once 'comprastab.php'; // Ajuste o caminho conforme necessário
} catch (Exception $e) {
    echo "<p style='color: red;'>Erro ao incluir arquivo de compras: " . $e->getMessage() . "</p>";
}

?>

</body>
</html>
