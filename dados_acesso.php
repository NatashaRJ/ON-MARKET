<?php
// Defina as constantes para conexão com o banco de dados
define("SERVIDOR", "localhost");
define("USUARIO", "admin");
define("SENHA", "admin0402");
define("BANCODEDADOS", "on_market");

// Definir o DSN (Data Source Name) para a conexão, incluindo charset UTF-8
define("DSN", "mysql:host=" . SERVIDOR . ";dbname=" . BANCODEDADOS . ";charset=utf8");
?>
