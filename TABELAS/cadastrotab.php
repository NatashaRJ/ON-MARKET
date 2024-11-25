<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acesso ao Banco de Dados MySql</title>
    <link href="../css/tabelas.css" rel="stylesheet">
    </head>
<body>
    <h1>On Market: Conexão com Banco de Dados MySql</h1>
    <?php
        // Incluindo o arquivo de conexão
        try {
            require_once '../conexao.php'; // Ajuste conforme a localização real
            $conn = conectaPDO();
        } catch (Exception $e) {
            die("<p style='color: red;'>Erro ao incluir conexão: " . $e->getMessage() . "</p>");
        }

        // Consulta ao banco de dados
        try {
            $stmt = $conn->prepare('SELECT * FROM cadastro');
            if (!$stmt->execute()) {
                throw new Exception("Erro ao executar a consulta: " . implode(", ", $stmt->errorInfo()));
            }

            // Exibindo os resultados
            echo '<h2>Tabela de Cadastro</h2>';
            echo "<table>";
            echo "<tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Sexo</th>
                    <th>Nome Materno</th>
                    <th>CPF</th>
                    <th>E-Mail</th>
                    <th>Telefone Celular</th>
                    <th>Telefone Fixo</th>
                    <th>Endereço</th>
                    <th>CEP</th>
                    <th>Cidade</th>
                    <th>Login</th>
                    <th>Senha</th>
                    <th>Nível de Acesso</th>
                    <th>Data do Cadastro</th>
                </tr>";

            while ($registro = $stmt->fetch()) {
                echo "<tr>
                        <td>{$registro['id_cad']}</td>
                        <td>{$registro['nome']}</td>
                        <td>{$registro['data_nascimento']}</td>
                        <td>{$registro['sexo']}</td>
                        <td>{$registro['nome_materno']}</td>
                        <td>{$registro['cpf']}</td>
                        <td>{$registro['email']}</td>
                        <td>{$registro['telefone_celular']}</td>
                        <td>{$registro['telefone_fixo']}</td>
                        <td>{$registro['endereco']}</td>
                        <td>{$registro['cep']}</td>
                        <td>{$registro['cidade']}</td>
                        <td>{$registro['login']}</td>
                        <td>{$registro['senha']}</td>
                        <td>{$registro['nivel_acesso']}</td>
                        <td>{$registro['data_cadastro']}</td>
                    </tr>";
            }
            echo "</table>";
        } catch (Exception $e) {
            echo "<p style='color: red;'>Erro ao consultar o banco de dados: " . $e->getMessage() . "</p>";
        }

        
require_once 'logintab.php'; // Ajuste conforme a localização real
        
    ?>
</body>
</html>
