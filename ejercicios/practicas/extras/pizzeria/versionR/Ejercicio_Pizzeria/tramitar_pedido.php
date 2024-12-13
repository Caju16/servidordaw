<?php
    session_start();
    if (isset($_POST['volver'])){
        header("location: index.php");
    }
    $aCarrito = $_SESSION['carrito'];
    $contenido = "";
    // Defino el nombre del archivo de ticket
    $ticket_name = "ticket_" . date('Y-m-d H:i:s') . ".txt";
    $file = fopen("tickets/" . $ticket_name, "w"); // Abro el fichero con el nombre generado
    fwrite($file, $_SESSION['tramitar']['escritura']);
    fclose($file);

    $file2 = fopen("comandas/comanda_" . date('Y-m-d H:i:s') . "_pendiente.txt", "w");
    foreach ($aCarrito as $clave => $valor){
        $key = explode("-", $clave);
        if ($key[0] == "pi"){
            $contenido .= $valor['cantidad'] . " ---- " . $valor['nombre'] . " ----- Tamaño: " . $valor["tamaño"] . "\n";
        }
    }
    fwrite($file2, $contenido);
    fclose($file2);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h2>El total del pedido ha sido <?php echo $_SESSION['tramitar']['total']?></h2>
        <a href="descargar_ticket.php?archivo=<?php echo $ticket_name; ?>">Pulse aquí para descargar su ticket</a>

        <form action="" method="post">
            <button type="submit" name="volver">Volver a inicio</button>
        </form>
    </body>
</html>
