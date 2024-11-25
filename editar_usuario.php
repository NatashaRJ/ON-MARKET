<?php
session_start();

// Verifica se o usuário está autenticado e é do tipo master
if (!isset($_SESSION['usuario']) || $_SESSION['nivel_acesso'] !== 'master') {
    header("Location: master.php");
    exit();
}

require 'conexao.php';

$conn = conectaPDO();

// Verifica se o ID do usuário foi passado pela URL
if (isset($_GET['id_cad'])) {
    $id_cad = $_GET['id_cad'];

    // Recupera os dados do usuário
    $stmt = $conn->prepare("SELECT * FROM cadastro WHERE id_cad = :id_cad");
    $stmt->bindParam(':id_cad', $id_cad);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário foi encontrado
    if (!$usuario) {
        die("Usuário não encontrado.");
    }
} else {
    // Redireciona caso não tenha um ID válido
    header("Location: gerenciar_usuarios.php");
    exit();
}

// Processa o formulário de edição
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario_input = $_POST['usuario'];
    $nivel_acesso = $_POST['nivel_acesso']; // Nível de acesso

    // Atualiza os dados do usuário
    $stmt = $conn->prepare("UPDATE cadastro SET login = :usuario, nivel_acesso = :nivel_acesso WHERE id_cad = :id_cad");
    $stmt->bindParam(':usuario', $usuario_input);
    $stmt->bindParam(':nivel_acesso', $nivel_acesso);
    $stmt->bindParam(':id_cad', $id_cad);
    
    if ($stmt->execute()) {
        header("Location: gerenciar_usuarios.php");
        exit();
    } else {
        echo "Erro ao atualizar usuário.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/editar.css">
    <title>Editar Usuário</title>
</head>
<body>
    <h1>Editar Usuário</h1>
    <form method="POST" action="editar_usuario.php?id_cad=<?php echo htmlspecialchars($id_cad); ?>">
        <label>Usuário:</label>
        <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuario['login']); ?>" required><br><br>

        <label>Nível de Acesso:</label>
        <select name="nivel_acesso" required>
            <option value="comum" <?php echo ($usuario['nivel_acesso'] === 'comum') ? 'selected' : ''; ?>>Usuário</option>
            <option value="master" <?php echo ($usuario['nivel_acesso'] === 'master') ? 'selected' : ''; ?>>Master</option>
        </select>
        <br><br>
        <button type="submit">Salvar</button>
    </form>
</body>
</html>
