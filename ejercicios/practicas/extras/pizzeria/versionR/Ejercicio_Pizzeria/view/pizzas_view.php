<form method="POST" action="">
    <?php
    if ($login){
        $type = "";
    } else{
        $type = "style='display: none;'";
    }
    foreach ($productos as $clave => $valor) {
        if ($clave == $vista) {
            foreach ($valor as $nombre => $contenido) {
                echo "<div>
                    <img width='200px' src='img/" . $contenido['imagen'] . "'>
                    <p>" . $contenido['nombre'] . "</p>
                    <p><b>Precios</b></p>
                    <p style='display: inline-block;'>Individual: " . $contenido['precio']['individual'] . "</p>
                    <button $type type='submit' name='pizza' value='". $contenido["nombre"] ."-" . $contenido['precio']['individual'] . "-individual' style='display: inline-block;'>+</button><br/>
                    <p style='display: inline-block;'>Mediana: " . $contenido['precio']['media'] . "</p>
                    <button $type type='submit' name='pizza' value='". $contenido["nombre"] ."-" . $contenido['precio']['media'] . "-media' style='display: inline-block;'>+</button><br/>
                    <p style='display: inline-block;'>Grande: " . $contenido['precio']['familiar'] . "</p>
                    <button $type type='submit' name='pizza' value='". $contenido["nombre"] ."-" . $contenido['precio']['familiar'] . "-familiar' style='display: inline-block;'>+</button><br/>
                </div>";
            }
        }
    }
    ?>
</form>
