<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de Compras</title>
   
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

// Consultando os dados da tabela Compras
$stmt = $conn->prepare('SELECT * FROM Compras');
$stmt->execute();

// Exibindo os resultados na tabela
echo '<h1>Tabela Compras</h1>';
echo "<table>";
echo "<tr>";
echo "<th>Id_prod</th>";
echo "<th>Quantidade</th>";
echo "<th>Id_ped</th>";
echo "</tr>";

// Loop para exibir os registros
while ($registro = $stmt->fetch()) {
    echo "<tr>";
    echo "<td>" . $registro["id_prod"] . "</td>";
    echo "<td>" . $registro["quantidade"] . "</td>";
    echo "<td>" . $registro["id_ped"] . "</td>";
    echo "</tr>";
}

echo "</table>";

// Incluindo o arquivo da próxima tabela (se necessário)
try {
    require_once 'nota_fiscaltab.php'; // Ajuste o caminho conforme necessário
} catch (Exception $e) {
    echo "<p style='color: red;'>Erro ao incluir arquivo de nota fiscal: " . $e->getMessage() . "</p>";
}

?>

</body>
</html>
