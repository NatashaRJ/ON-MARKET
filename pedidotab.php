<?php
        $conn = conectaPDO();
        $stmt = $conn->prepare('SELECT * FROM Pedido');
        $stmt-> execute();
        echo '<div class="pedido"><h1> Tabela Pedido</h1>';
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td><strong>Id_ped</strong></td>";
        echo "<td><strong>N°_do_pedido</strong></td>";
        echo "<td><strong>Data_do_pedido</strong></td>";
        echo "<td><strong>Status</strong></td>";
        echo "<td><strong>Id_cad</strong></td>";
        echo "</tr>";
        echo "</div>";

        while($registro = $stmt->fetch()) {
            echo '<div class="pedido">';
            echo "<tr>";
            echo "<td>".$registro["id_ped"] . "</td>" .
                 "<td>".$registro["n°_do_pedido"] . "</td>" .
                 "<td>".$registro["data_do_pedido"] . "</td>" .
                 "<td>".$registro["status"] . "</td>" .
                 "<td>".$registro["id_cad"] . "</td>" ;
            echo "</tr>";
            echo "</div>";
        }
        echo "</table>";
        require_once "compras.php";

    ?>