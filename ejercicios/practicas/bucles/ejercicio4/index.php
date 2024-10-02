<?php
// Array de colores con sus valores hexadecimales
$colores = [
    'Rojo' => '#FF0000',
    'Verde' => '#00FF00',
    'Azul' => '#0000FF',
    'Amarillo' => '#FFFF00',
    'Cian' => '#00FFFF',
    'Magenta' => '#FF00FF',
    'Negro' => '#000000',
    'Blanco' => '#FFFFFF',
    'Naranja' => '#FFA500',
    'Rosa' => '#FFC0CB'
];

echo "<table border='1' cellpadding='10'>";
echo "<tr><th>Color</th><th>Valor Hexadecimal</th></tr>";

foreach ($colores as $color => $hex) {
    echo "<tr>";
    
    echo "<td style='background-color: $hex;'><a href='javascript:void(0);' onclick='abrirColor(\"$hex\")' style='color: black; text-decoration: none;'>" . $color . "</a></td>";
    
    echo "<td><a href='javascript:void(0);' onclick='abrirColor(\"$hex\")'>" . $hex . "</a></td>";
    
    echo "</tr>";
}

echo "</table>";
?>

<script>
function abrirColor(color) {
    var nuevaVentana = window.open('', '', 'width=400,height=200');
    nuevaVentana.document.write('<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>' + color + '</title><style>body { background-color: ' + color + '; margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; font-family: Arial, sans-serif; color: white; }</style></head><body><h1>' + color + '</h1></body></html>');
    nuevaVentana.document.close(); 
}
</script>
