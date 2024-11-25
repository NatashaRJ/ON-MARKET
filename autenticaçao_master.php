<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Entrada</title>
    <link rel="stylesheet" href="css/autent_master.css">
    
</head>
<body>
    <h2>Formulário de Entrada de Dados</h2>
    <form action="processar_master.php" method="POST" onsubmit="return validaForm()">
    <label for="nome_mae" class="label-nome-mae">Qual o nome da sua mãe?</label><br>
<input type="text" id="nome_mae" name="nome_mae" pattern="[A-Za-zÀ-ÿ\s]{3,}" required title="O nome deve ter pelo menos 3 letras."><br><br>

<label for="data_nascimento">Qual a data do seu nascimento?</label><br>
<input type="date" id="data_nascimento" name="data_nascimento" required><br><br>

<label for="cep">Qual o CEP do seu endereço?</label><br>
<input type="text" id="cep" name="cep" pattern="\d{5}-?\d{3}" required title="Formato: 12345-678 ou 12345678"><br><br>

        <input type="submit" value="Enviar">
    </form>
    
</body>
</html>
