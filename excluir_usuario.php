<?php
session_start();

// Verifica se o usuário está autenticado e é do tipo master
if (!isset($_SESSION['usuario']) || $_SESSION['nivel_acesso'] !== 'master') {
    header("Location: master.php");
    exit();
}

require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_cad'])) {
    $id_cad = $_POST['id_cad'];
    $conn = conectaPDO();

    // Exclui o usuário pelo ID
    $stmt = $conn->prepare("DELETE FROM cadastro WHERE id_cad = :id_cad");
    $stmt->bindParam(':id_cad', $id_cad);

    if ($stmt->execute()) {
        header("Location: gerenciar_usuarios.php"); // Redireciona após a exclusão
        exit();
    } else {
        echo "Erro ao excluir usuário.";
    }
} else {
    echo "ID do usuário não fornecido.";
}
?>
