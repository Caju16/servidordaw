<?php
/**
 *  Array de las notas de los alumnos
 *  @author Miguel Carmona
 * 
 */

$alumnos = [
  'Raúl Bermúdez González', 'Carlos Borreguero Redondo', 
  'Álvaro Cañas González', 'Miguel Carmona Cicchetti', 
  'Alejandro Carrasco Castellano', 'Mostafa Cherif Mouaki Almabouada', 
  'Alejandro Coronado Ortega', 'Juan Diego Delgado Morente', 
  'Marlon Jafet Escoto García', 'Ángel Fernández Ariza', 
  'Alejandro Fernández Arrayás', 'Daniel Fernández Balsera', 
  'Jesús Ferrer López', 'Jesús Frías Rojas', 
  'Manuel Galán Navas', 'Víctor García Báez', 
  'Lucía García Díaz', 'Adrián González Martínez', 
  'Jesús López Funes', 'Enrique Mariño Jiménez',
  'Oscar Martín-Castaño Carrillo', 'José María Mayén Pérez',
  'Pablo Mérida Velasco', 'Héctor Mora Sánchez',
  'Luis Pérez Cantarero', 'Carlos Romero Romero',
  'Javier Ruiz Molero', 'Alejandro Vaquero Abad',
  'Luis Miguel Villén Moyano'
];

$notas = [
  8, 9, 7, 6, 10, 5, 
  6, 8, 7, 9, 6, 8, 
  10, 5, 9, 6, 7, 10, 
  5, 8, 9, 7, 8, 6, 
  10, 5, 9, 7, 8, 6, 
  7, 9, 10
];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas de Alumnos</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h1>Notas de Alumnos</h1>

<table>
    <thead>
        <tr>
            <th>Alumno</th>
            <th>Nota</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        foreach ($alumnos as $index => $alumno) {
            echo "<tr>";
            echo "<td>{$alumno}</td>";
            echo "<td>{$notas[$index]}</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
