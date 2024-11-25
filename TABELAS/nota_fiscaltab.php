<?php
// Incluindo o arquivo de conexão
try {
    require_once '../conexao.php'; // Ajuste o caminho conforme necessário
    $conn = conectaPDO();
} catch (Exception $e) {
    die("<p style='color: red;'>Erro ao incluir conexão: " . $e->getMessage() . "</p>");
}

// Consultando os dados da tabela Nota_fiscal
$stmt = $conn->prepare('SELECT * FROM Nota_fiscal');
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela Nota Fiscal</title>
    <style>
        /* Estilo geral para o corpo da página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        /* Estilo do título */
        h1 {
            color: #333;
            font-size: 2.5em;
            margin-top: 20px;
            font-weight: bold;
        }

        /* Estilo da tabela */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden; /* Evitar que as bordas arredondadas se sobreponham */
        }

        /* Estilo das células da tabela */
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            color: #333;
            font-size: 1.1em;
        }

        /* Cor de fundo dos cabeçalhos */
        th {
            background-color: #ff6600;
            color: white;
            font-weight: bold;
        }

        /* Efeito de hover nas linhas da tabela */
        tr:hover {
            background-color: rgba(239, 122, 12, 0.2);
        }

        /* Ajuste do box-sizing para garantir que bordas e paddings sejam levados em conta */
        * {
            box-sizing: border-box;
        }
    </style>
</head>
<body>

    <h1>Tabela Nota Fiscal</h1>
    <table>
        <tr>
            <th><strong>Id_nf</strong></th>
            <th><strong>Valor_nf</strong></th>
            <th><strong>Uf</strong></th>
            <th><strong>Id_ped</strong></th>
        </tr>

        <?php
        // Loop para exibir os registros
        while ($registro = $stmt->fetch()) {
            echo "<tr>";
            echo "<td>" . $registro["id_nf"] . "</td>";
            echo "<td>" . $registro["valor_nf"] . "</td>";
            echo "<td>" . $registro["uf"] . "</td>";
            echo "<td>" . $registro["id_ped"] . "</td>";
            echo "</tr>";
        }
        ?>

    </table>

</body>
</html>
