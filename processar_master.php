<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado</title>
</head>
<body>
<?php
session_start(); 
// Verifica se o usuário está autenticado e redireciona com base no nível de acesso
if ($_SESSION['nivel_acesso'] === 'master') {
    // Se o nível de acesso é 'comum', redireciona para o dashboard correspondente
    header("Location: dashboard_master.php");
    exit();
}

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nome_mae = htmlspecialchars($_POST['nome_mae']);
            $data_nascimento = htmlspecialchars($_POST['data_nascimento']);
            $cep = htmlspecialchars($_POST['cep']);
            
            if (!empty($nome_mae) && !empty($data_nascimento) && !empty($cep)) {
                echo "<h2>Olá! O nome da sua mãe é: $nome_mae!</h2>";
                echo "<p>A data do seu nascimento é: $data_nascimento.</p>";
                echo "<p>Você mora no CEP: $cep.</p>";
                
                exit();
            } else {
                echo "<p>Os dados não foram preenchidos corretamente.</p>";
            }
        } else {
            echo "<p>Dados não enviados corretamente.</p>";
        }
?>

</body>
</html>
