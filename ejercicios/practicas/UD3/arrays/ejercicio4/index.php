<?php
/**
 *  Array mostrar menús disponibles
 *  @author Miguel Carmona
 * 
 */
$primeros = [
    ["nombre" => "Ensalada César", "precio" => 5.50, "foto" => "https://imag.bonviveur.com/ensalada-cesar-casera.jpg"],
    ["nombre" => "Sopa de Tomate", "precio" => 4.75, "foto" => "https://t1.uc.ltmcdn.com/es/posts/3/0/9/como_hacer_sopa_de_tomate_casera_25903_orig.jpg"],
    ["nombre" => "Gazpacho", "precio" => 5.00, "foto" => "https://i.blogs.es/e64620/gazpacho/450_1000.jpg"]
];

$segundos = [
    ["nombre" => "Solomillo de cerdo", "precio" => 12.00, "foto" => "https://imag.bonviveur.com/solomillo-de-cerdo-al-whisky.jpg"],
    ["nombre" => "Pechuga de pollo", "precio" => 10.50, "foto" => "https://i.blogs.es/debf2d/pechuga/450_1000.jpg"],
    ["nombre" => "Merluza a la plancha", "precio" => 14.00, "foto" => "https://recetasdecocina.elmundo.es/wp-content/uploads/2023/07/merluza-a-la-plancha-receta.jpg"],
    ["nombre" => "Risotto de setas", "precio" => 11.50, "foto" => "https://www.arrozsos.es/wp-content/uploads/2022/10/Risotto-de-gambas-y-calamares-750x750.jpg"],
    ["nombre" => "Hamburguesa vegetariana", "precio" => 9.00, "foto" => "https://www.pequerecetas.com/wp-content/uploads/2009/04/hamburguesa-de-garbanzos-casera-receta.jpg"]
];

$postres = [
    ["nombre" => "Tarta de queso", "precio" => 4.00, "foto" => "https://imag.bonviveur.com/tarta-de-queso-la-vina.jpg"],
    ["nombre" => "Helado de vainilla", "precio" => 3.50, "foto" => "https://www.recetasnestle.com.do/sites/default/files/srh_recipes/62099096785a3c939a1a1eefb06bf358.jpg"],
    ["nombre" => "Flan de huevo", "precio" => 3.25, "foto" => "https://s1.abcstatics.com/abc/sevilla/media/gurmesevilla/2016/06/flan-de-huevo-casero.jpg"]
];

$descuento = 0.20;

echo "<h1>Menús Disponibles</h1>";

foreach ($primeros as $primero) {
    foreach ($segundos as $segundo) {
        foreach ($postres as $postre) {
            $precioTotal = $primero['precio'] + $segundo['precio'] + $postre['precio'];
            $precioConDescuento = $precioTotal * (1 - $descuento);

            echo "<div style='border: 1px solid #000; padding: 10px; margin-bottom: 10px;'>";
            echo "<h3>Menú:</h3>";
            echo "<p><strong>Primer plato:</strong> {$primero['nombre']} ({$primero['precio']} €)</p>";
            echo "<img src='{$primero['foto']}' alt='{$primero['nombre']}' width='100'><br>";
            echo "<p><strong>Segundo plato:</strong> {$segundo['nombre']} ({$segundo['precio']} €)</p>";
            echo "<img src='{$segundo['foto']}' alt='{$segundo['nombre']}' width='100'><br>";
            echo "<p><strong>Postre:</strong> {$postre['nombre']} ({$postre['precio']} €)</p>";
            echo "<img src='{$postre['foto']}' alt='{$postre['nombre']}' width='100'><br>";
            echo "<p><strong>Precio total (con 20% de descuento):</strong> " . number_format($precioConDescuento, 2) . " €</p>";
            echo "</div>";
        }
    }
}



?>