
<?php
        $conn = conectaPDO();
        $stmt = $conn->prepare('SELECT * FROM Nota_fiscal');
        $stmt-> execute();
        echo '<div class="notafiscal"><h1> Tabela Nota_Fiscal</h1>';
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td><strong>Id_nf</strong></td>";
        echo "<td><strong>Valor_nf</strong></td>";
        echo "<td><strong>Uf</strong></td>";
        echo "<td><strong>Id_ped</strong></td>";
        echo "</tr>";
        echo "</div>";

        while($registro = $stmt->fetch()) {
            echo '<div class="notafiscal">';
            echo "<tr>";
            echo "<td>".$registro["id_nf"] . "</td>" .
                 "<td>".$registro["valor_nf"] . "</td>" .
                 "<td>".$registro["uf"] . "</td>" .
                 "<td>".$registro["id_ped"] . "</td>" ;
            echo "</tr>";
            echo "</div>";
        }
        echo "</table>";
        
    ?>