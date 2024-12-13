<form method="POST" action="">
<?php
// Compruebo que este autenticado para mostrarle los botones de añadfir al carrito
    if ($login){
        $type = "";
    } else{
        $type = "style='display: none;'";
    }
    foreach ($productos as $clave => $valor) {
        if ($clave == $vista) {
            foreach ($valor as $nombre => $contenido) {
                echo "<div>
                    <img width='100px' src='img/" . $contenido['imagen'] . "'>
                    <p>" . $contenido['nombre'] . "</p>
                    <p style='display: inline-block; margin-right: 5px;'><b>Precio: " . $contenido['precio'] . "</b></p>
                    <button $type type='submit' name='bebida' value='". $contenido["nombre"]. "-" .$contenido['precio'] ."' style='display: inline-block;'>+</button>
                </div>";
            }
        }
    }
?>
</form>