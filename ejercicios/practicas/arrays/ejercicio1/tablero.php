<!-- 
 *
 *  Tablero de barcos
 *  @author Miguel Carmona
 * 
 -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero de Barcos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<?php
    $filas = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];
    $columnas = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
    
    echo "<table>";
    
    echo "<tr><th></th>";
    for ($i = 0; $i < count($columnas); $i++) {
        echo "<th>" . $columnas[$i] . "</th>";
    }
    echo "</tr>";
    
    for ($i = 0; $i < count($filas); $i++) {
        echo "<tr><th>" . $filas[$i] . "</th>";
        for ($j = 0; $j < count($columnas); $j++) {
            echo "<td></td>";
        }
        echo "</tr>";
    }
    
    echo "</table>";
?>

</body>
</html>
