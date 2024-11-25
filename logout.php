<?php
session_start();
session_destroy(); // Destrói a sessão
header("Location: index.html"); 
header("Location: index.html"); // Redireciona para a página de login
exit();
?>
