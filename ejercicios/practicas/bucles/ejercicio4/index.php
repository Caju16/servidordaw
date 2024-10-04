<!DOCTYPE html>
<html>
<head>
    <title>Tabla de Colores</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 0 auto;
        }
        td {
            padding: 20px;
            text-align: center;
            border: 1px solid black;
            width: 16.66%; 
            box-sizing: border-box;
        }
        .color-box {
            width: 100%;
            height: 50px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
        <?php

        // DOCUMENTACIÓN
        const INCREMENTO = 15;

        echo "<h1>Enunciado: <br></h1>";

        echo "<p>
                    Mostrar paleta de colores. Utilizar una tabla que muestre el color y el valor
                    hexadecimal que le corresponde. Cada celda será un enlace a una página que
                    mostrará un fondo de pantalla con el color seleccionado. ¿Puedes hacerlo con los
                  

                    conocimientos que tienes?
              </p><br>";

        $counter = 0; // Contador para saber cuántas celdas hay por fila
        for ($r = 0; $r <= 255; $r += INCREMENTO) {
            for ($g = 0; $g <= 255; $g += INCREMENTO) {
                for ($b = 0; $b <= 255; $b += INCREMENTO) {

                    $hex = sprintf("#%02x%02x%02x", $r, $g, $b);
                    
                    // Mostrar cada celda como un enlace
                    echo "<td>";
                    echo "<a href='javascript:void(0);' onclick='abrirColor(\"$hex\")' style='color: black; text-decoration: none;'>" . $color . "</a>";  // Enlace a una nueva página
                    echo "<div><a href='javascript:void(0);' onclick='abrirColor(\"$hex\")'>" . $hex . "</a></div>";  // Mostrar el código hexadecimal
                    echo "<div class='color-box' style='background-color:$hex'></div>";  // Color de fondo
                    echo "</a>";
                    echo "</td>";
                    
                    // Control para cerrar y abrir una nueva fila cada 6 celdas
                    $counter++;
                    if ($counter % 6 == 0) {
                        echo "</tr><tr>";
                    }
                }
            }
        }
        ?>
        </tr>
    </table>

    <script>
        function abrirColor(color) {
            var nuevaVentana = window.open('', '', 'width=400,height=200');
            nuevaVentana.document.write('<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><title>' + color + '</title><style>body { background-color: ' + color + '; margin: 0; height: 100vh; display: flex; justify-content: center; align-items: center; font-family: Arial, sans-serif; color: white; }</style></head><body><h1>' + color + '</h1></body></html>');
            nuevaVentana.document.close(); 
        }
    </script>


</body>
</html>