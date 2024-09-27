<?php
$mes = date('n');
$año = date('Y');

$primerDia = mktime(0, 0, 0, $mes, 1, $año);
$díasEnMes = date('t', $primerDia);
$nombreMes = date('F', $primerDia);

$indicePrimerDia = date('w', $primerDia);

$festivos = [
    '1-1',  
    '25-12' 
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
    
    $esFestivo = in_array($fecha, $festivos);
    
    if ($esHoy) {
        $backgroundColor = 'green';
        $textColor = 'white';
    } elseif ($esFestivo || (($día + $indicePrimerDia) % 7 == 0)) {
        $backgroundColor = 'red';
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
