<!-- 
 *
 *  Calendario con bucles mejorado
 *  @author Miguel Carmona
 * 
 -->

 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario</title>
</head>
<body>
    <h1>Enunciado: </h1>
    <p>Dado el mes y año almacenados en variables, escribir un programa que muestre el
        calendario mensual correspondiente. Marcar el día actual en verde y los festivos
        en diferentes colores según su tipo (nacionales, comunidad, locales).</p>
    <?php
        $mes = date('n');
        $año = date('Y');

        $primerDia = mktime(0, 0, 0, $mes, 1, $año);
        $díasEnMes = date('t', $primerDia);
        $nombreMes = date('F', $primerDia);

        $indicePrimerDia = date('w', $primerDia);

        $festivosNacionales = [
            '1-1', // Año Nuevo
            '6-1'  // Reyes
        ];
        $festivosComunidad = [
            '28-2' // Día de Andalucía
        ];
        $festivosLocales = [
            '15-8', // Asunción
        ];

        echo "<h2>Calendario de $nombreMes $año</h2>";
        echo "<table border='1' cellpadding='10'>";
        echo "<tr>
                <th>Lunes</th>
                <th>Martes</th>
                <th>Miércoles</th>
                <th>Jueves</th>
                <th>Viernes</th>
                <th>Sábado</th>
                <th>Domingo</th>
            </tr>";

        echo "<tr>";
        $indicePrimerDia = ($indicePrimerDia + 6) % 7; 

        for ($i = 0; $i < $indicePrimerDia; $i++) {
            echo "<td></td>";
        }

        for ($día = 1; $día <= $díasEnMes; $día++) {
            $fecha = "$día-$mes";

            $esHoy = ($día == date('j')) && ($mes == date('n')) && ($año == date('Y'));
            $esFestivoNacional = in_array($fecha, $festivosNacionales);
            $esFestivoComunidad = in_array($fecha, $festivosComunidad);
            $esFestivoLocal = in_array($fecha, $festivosLocales);
            
            if ($esHoy) {
                $backgroundColor = 'green';
                $textColor = 'white';
            } elseif ($esFestivoNacional) {
                $backgroundColor = 'orange'; // Color para festivos nacionales
                $textColor = 'white';
            } elseif ($esFestivoComunidad) {
                $backgroundColor = 'blue'; // Color para festivos de comunidad
                $textColor = 'white';
            } elseif ($esFestivoLocal) {
                $backgroundColor = 'purple'; // Color para festivos locales
                $textColor = 'white';
            } elseif (($día + $indicePrimerDia) % 7 == 0) {
                $backgroundColor = 'red'; // Color para domingos
                $textColor = 'white';
            } else {
                $backgroundColor = 'white';
                $textColor = 'black';
            }

            echo "<td style='background-color: $backgroundColor; color: $textColor;'>$día</td>";

            if (($día + $indicePrimerDia) % 7 == 0) {
                echo "</tr><tr>";
            }
        }

        if (($díasEnMes + $indicePrimerDia) % 7 != 0) {
            for ($i = ($díasEnMes + $indicePrimerDia) % 7; $i < 7; $i++) {
                echo "<td></td>";
            }
        }

        echo "</tr>";
        echo "</table>";
    ?>
</body>
</html>
