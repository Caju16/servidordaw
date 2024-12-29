<?php
/**
 * Examen de práctica de u4 pizzeria
 * @author Jesús Ferrer López
 * @date 08/12/2024
 */

 require_once "./config/config.php";
 define("PRODUCTOS", $productos);
$pagina = "Pizzas";
$recomendaciones = [];

session_start();

// Si no existe la variable de sesión carrito, la creamos.
if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}

if (isset($_POST["pizzas"])) {
    $pagina = "Pizzas";
} else if (isset($_POST["bebidas"])) {
    $pagina = "Bebidas";
} else if (isset($_POST["postre"])) {
    $pagina = "Postre";
} else if (isset($_POST["carrito"])) {
    $pagina = "Carrito";
}

if (isset($_POST["producto"])) {
    $producto = json_decode($_POST["producto"], true);

    // Añadimos el producto al carrito.
    array_push($_SESSION["carrito"], $producto);

    // Vamos a crear un array de tres elementos con los 3 últimos elementos del carrito.
    if (count($_SESSION["carrito"]) >= 3) {
        $recomendaciones = array_slice($_SESSION["carrito"], -3, 3);
    } else {
        $recomendaciones = $_SESSION["carrito"];
    }
}

// Si se ha tramitado el pedido, creamos ticket y comanda.
if (isset($_POST["tramitar_pedido"])) {
    // Generamos el ticket
    $ticket = "tickets/ticket_" . date("Ymd_His") . ".txt";
    $contenido = "Ticket de compra\n\n";
    $total = 0;
    foreach ($_SESSION["carrito"] as $producto) {
        $contenido .= $producto["nombre"] . "-";
        $contenido .= $producto["precio"];
        if (isset($producto["tamaño"])) {
            $contenido .= "-" . $producto["tamaño"];
        }
        $contenido .= "\n";
        $total += $producto["precio"];
    }
    $contenido .= "\nTotal:" . $total . "€\n";

    file_put_contents($ticket, $contenido);

    // echo "<a href='$ticket' download>Descargar Ticket</a>";

    //Generamos la comanda con solo los productos de pizza
    $comanda = "comandas/comanda_" . date("Ymd_His") . "_pendiente.txt";
    $contenido = "Comanda de pizzas\n\n";
    foreach ($_SESSION["carrito"] as $producto) {
        if (isset($producto["tamaño"])) {
            $contenido .= $producto["nombre"] . "-" . $producto["tamaño"] . "\n";
        }
    }

    file_put_contents($comanda, $contenido);

    // Vaciar el carrito después de tramitar el pedido
    $_SESSION["carrito"] = [];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .productos {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .producto {
            border: 1px solid #ccc;
            padding: 10px;
            width: 200px;
            text-align: center;
        }
        .producto img {
            max-width: 100%;
            height: auto;
        }
        .producto h2 {
            font-size: 1.2em;
            margin: 10px 0;
        }
        .producto p {
            margin: 5px 0;
        }
        .producto button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .producto button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>FaMia</h1>
    <form method="POST" action="">
        <input type="submit" name="pizzas" value="pizzas">
        <input type="submit" name="bebidas" value="bebidas">
        <input type="submit" name="postre" value="postre">
        <input type="submit" name="carrito" value="carrito">
    </form>
    <?php
        // Mostramos los productos en función de la página seleccionada.
        if ($pagina === "Pizzas") {
            echo "<div class='productos'>";
            foreach (PRODUCTOS["pizzas"] as $pizza) {
            echo "<div class='producto'>";
            echo "<h2>" . $pizza["nombre"] . "</h2>";
            echo "<img src='./img/" . $pizza["imagen"] . "' alt='" . $pizza["nombre"] . "'>";
            echo "<form method='POST' action=''>";
            echo "<p>Individual: " . $pizza["precio"]["individual"] . "€ <button type='submit' name='producto' value='" . json_encode(["nombre" => $pizza["nombre"], "precio" => $pizza["precio"]["individual"], "tamaño" => "Individual", "imagen" => "./img/" . $pizza["imagen"]]) . "'>+</button></p>";
            echo "<p>Media: " . $pizza["precio"]["media"] . "€ <button type='submit' name='producto' value='" . json_encode(["nombre" => $pizza["nombre"], "precio" => $pizza["precio"]["media"], "tamaño" => "Media", "imagen" => "./img/" . $pizza["imagen"]]) . "'>+</button></p>";
            echo "<p>Familiar: " . $pizza["precio"]["familiar"] . "€ <button type='submit' name='producto' value='" . json_encode(["nombre" => $pizza["nombre"], "precio" => $pizza["precio"]["familiar"], "tamaño" => "Familiar", "imagen" => "./img/" . $pizza["imagen"]]) . "'>+</button></p>";
            echo "</form>";
            echo "</div>";
            }
            echo "</div>";
        } else if ($pagina === "Bebidas") {
            echo "<div class='productos'>";
            foreach (PRODUCTOS["bebidas"] as $bebida) {
            echo "<div class='producto'>";
            echo "<h2>" . $bebida["nombre"] . "</h2>";
            echo "<img src='./img/" . $bebida["imagen"] . "' alt='" . $bebida["nombre"] . "'>";
            echo "<form method='POST' action=''>";
            echo "<p>" . $bebida["precio"] . "€ <button type='submit' name='producto' value='" . json_encode(["nombre" => $bebida["nombre"], "precio" => $bebida["precio"], "imagen" => "./img/" . $bebida["imagen"]]) . "'>+</button></p>";
            echo "</form>";
            echo "</div>";
            }
            echo "</div>";
        } else if ($pagina === "Postre") {
            echo "<div class='productos'>";
            foreach (PRODUCTOS["postres"] as $postre) {
            echo "<div class='producto'>";
            echo "<h2>" . $postre["nombre"] . "</h2>";
            echo "<img src='./img/" . $postre["imagen"] . "' alt='" . $postre["nombre"] . "'>";
            echo "<form method='POST' action=''>";
            echo "<p>" . $postre["precio"] . "€ <button type='submit' name='producto' value='" . json_encode(["nombre" => $postre["nombre"], "precio" => $postre["precio"], "imagen" => "./img/" . $postre["imagen"]]) . "'>+</button></p>";
            echo "</form>";
            echo "</div>";
            }
            echo "</div>";
        }

        // Mostramos la sección de recomendaciones si estamos en las páginas de productos.
        if ($pagina === "Pizzas" || $pagina === "Bebidas" || $pagina === "Postre") {
            echo "<h2>Recomendaciones</h2>";
            echo "<div class='productos'>"; 
            foreach ($recomendaciones as $recomendacion) {
            echo "<div class='producto'>";
            echo "<h2>" . $recomendacion["nombre"] . "</h2>";
            echo "<img src='" . $recomendacion["imagen"] . "' alt='" . $recomendacion["nombre"] . "'>";
            echo "<p>" . $recomendacion["precio"] . "€</p>";
            if (isset($recomendacion["tamaño"])) {
                echo "<p>" . $recomendacion["tamaño"] . "</p>";
            }
            echo "<form method='POST' action=''>";
            echo "<button type='submit' name='producto' value='" . json_encode($recomendacion) . "'>Añadir al carrito</button>";
            echo "</form>";
            echo "</div>";
            }
            echo "</div>";
        }

        // Mostramos el carrito
        if ($pagina === "Carrito") {
            echo "<h2>Carrito</h2>";
            echo "<table border='1'>";
            echo "<tr><th>Nombre</th><th>Precio</th><th>Tamaño</th></tr>";
            $total = 0;
            foreach ($_SESSION["carrito"] as $producto) {
            echo "<tr>";
            echo "<td>" . $producto["nombre"] . "</td>";
            echo "<td>" . $producto["precio"] . "€</td>";
            // Si el tamaño no existe, le ponemos N/A.
            echo "<td>" . (isset($producto["tamaño"]) ? $producto["tamaño"] : "N/A") . "</td>";
            echo "</tr>";
            $total += $producto["precio"];
            }
            echo "<tr><td colspan='2'>Total</td><td>" . $total . "€</td></tr>";
            echo "</table>";
        }
        if ($pagina === "Carrito" && !empty($_SESSION["carrito"])) {
            echo "<form method='POST' action=''>";
            echo "<button type='submit' name='tramitar_pedido'>Tramitar Pedido</button>";
            echo "</form>";
        }

        


    ?>
    <a href="./config/cierre.php">Cerrar sesión</a>
</body>
</html>