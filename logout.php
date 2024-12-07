<?php
session_unset();  // Limpa todas as variáveis de sessão
session_destroy(); // Destroi a sessão
session_start();   // Inicia uma nova sessão

header("Location: login.php"); // Redireciona para o login
exit();
?>
