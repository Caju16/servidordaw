<?php
    echo "<h3>Informacion del carrito</h3>";
    $contpizza = 0;
    $contbebidas = 0;
    $contpostre = 0;
    $total = 0;
    $contenido = "";
    if (count($aCarrito) == 0){
        echo "El carrito se encuentra vacio";
    } else{
        foreach ($aCarrito as $clave => $valor){
            $key = explode("-", $clave);
            if ($key[0] == "pi"){
                if ($contpizza == 0){
                    $contenido .= "Pizzas:\n";
                    echo "Pizzas:<br/>";
                    $contpizza = 1;
                    $contbebidas = 0;
                    $contpostre = 0;
                }
                $contenido .= $valor['cantidad'] . " ---- " . $valor['nombre'] . " ----- Tamaño: " . $valor["tamaño"] . " <b>Precio:</b> " . $valor["precio"] * $valor['cantidad']  . "\n";
                echo $valor['cantidad'] . " ---- " . $valor['nombre'] . " ----- Tamaño: " . $valor["tamaño"] . " <b>Precio:</b> " . $valor["precio"] * $valor['cantidad']  . "<br/>";
                $total += $valor["precio"] * $valor['cantidad'];
            } else if ($key[0] == "be"){
                if ($contbebidas == 0){
                    $contenido .= "Bebidas:\n";
                    echo "Bebidas:<br/>";
                    $contbebidas = 1;
                    $contpostre = 0;
                    $contpizza = 0;
                }
                $contenido .= $valor['cantidad'] . " ---- " . $valor['nombre'] . " ----- <b>Precio:</b> " . $valor["precio"] * $valor['cantidad']  . "\n";
                echo $valor['cantidad'] . " ---- " . $valor['nombre'] . " ----- <b>Precio:</b> " . $valor["precio"] * $valor['cantidad']  . "<br/>";
                $total += $valor["precio"] * $valor['cantidad'];
            } else if ($key[0] == "po"){
                if ($contpostre == 0){
                    $contenido .= "Postres:\n";
                    echo "Postres:<br/>";
                    $contpostre = 1;
                    $contpizza = 0;
                    $contbebidas = 0;
                }
                $contenido .= $valor['cantidad'] . " ---- " . $valor['nombre'] . " ----- <b>Precio:</b> " . $valor["precio"] * $valor['cantidad']  . "\n";
                echo $valor['cantidad'] . " ---- " . $valor['nombre'] . " ----- <b>Precio:</b> " . $valor["precio"] * $valor['cantidad']  . "<br/>";
                $total += $valor["precio"] * $valor['cantidad'];
            }
        }
        $contenido .= "Total a pagar:\n";
        echo "Total a pagar:<br/>";
        $contenido .= "Total del pedido: " . $total . "\n";
        echo "Total del pedido: " . $total . "<br/>";
        echo "<form action='' method='post'>";
        echo "<button type='submit' name='pedir'>Tramitar pedido</button>";
        echo "<input type='hidden' name='total' value='$total'>";
        echo "<input type='hidden' name='content' value='$contenido'>";
        echo "</form>";
    }