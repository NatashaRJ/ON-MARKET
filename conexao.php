<?php
require_once 'dados_acesso.php'; // Certifique-se de que o caminho está correto

function conectaPDO() {
    try {
        // Utilize as constantes definidas no arquivo de configuração
        $conn = new PDO(DSN, USUARIO, SENHA);
        
        // Definir o modo de erro do PDO para lançar exceções
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       
        return $conn; // Retorne a conexão após definir os atributos
    } catch(PDOException $e) {
        // Exibir mensagem de erro caso ocorra algum problema na conexão
        echo 'Erro ao conectar com banco de dados: ' . $e->getMessage();
        exit; // Encerre o script para evitar erros adicionais
    }
}
?>
