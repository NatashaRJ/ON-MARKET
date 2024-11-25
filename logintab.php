<?php
        $conn = conectaPDO();
        $stmt = $conn->prepare('SELECT * FROM login');

        // Verifica se a execução foi bem-sucedida
        if (!$stmt->execute()) {
            echo "Erro ao executar a consulta: " . implode(", ", $stmt->errorInfo());
        }
        echo '<div class="login"><h1> Tabela Login</h1>';
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td><strong>Id_log</strong></td>";
        echo "<td><strong>Usuário</strong></td>";
        echo "<td><strong>Senha</strong></td>";
        echo "<td><strong>Tipo</strong></td>";
        echo "</tr>";
        echo "</div>";
        while($registro = $stmt->fetch()) {
            echo '<div class="login">';
            echo "<tr>";
            echo "<td>".$registro["id_log"] . "</td>" .
                 "<td>".$registro["usuario"] . "</td>" .
                 "<td>".$registro["senha"] . "</td>" .
                 "<td>".$registro["tipo"] . "</td>" ;
            echo "</tr>";
            echo "</div>";
        }

        echo "</table>";
        require 'produtos.php';
    ?>