<?php

include('datos/config.php');
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['enviar'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $_SESSION['usuario'] = $usuario;
    $_SESSION['password'] = $password;
}


if(isset($_POST['agregarCarrito'])){
    $producto = $_POST['producto'];
    $precio = $_POST['precio'];


    if (isset($_SESSION['carrito'][$producto])){
        $_SESSION['carrito'][$producto]['cantidad']++;
        $_SESSION['carrito'][$producto]['precioTotal'] += $precio;
    } else {
        $_SESSION['carrito'][$producto] = [
            'cantidad' => 1,
            'precioUnitario' => $precio,
            'precioTotal' => $precio,
        ];
    }
}

$usuarioSesion = $_SESSION['usuario'] ?? null;
$passwordSesion = $_SESSION['password'] ?? null;

$esAdmin = ($usuarioSesion === 'admin' && $passwordSesion === '12345');

if(isset($_POST['enviar']) && $esAdmin){

    $aPendientes = $aElaborados = "";
    $directorio = "comandas/";
    $mensaje = "";
    function completarComanda($archivo) {
        $directorio = "comandas/";
        // Generar el nuevo nombre del archivo (cambiar "pendiente" por "completada")
        $nuevoNombre = str_replace("pendiente", "completada", $archivo);
        // Renombrar el archivo
        if (rename($directorio . $archivo, $directorio . $nuevoNombre)) {
            echo "Comanda completada con éxito.";
        } else {
            echo "Hubo un error al completar la comanda.";
        }
    }

    if (isset($_GET['completar'])) {
        $comanda = $_GET['completar']; // Obtener el archivo a completar
        $directorio = "comandas/";
        $nuevoNombre = str_replace("pendiente", "completada", $comanda); // Generar nuevo nombre.
    
        // Intentar renombrar el archivo.
        if (rename($directorio . $comanda, $directorio . $nuevoNombre)) {
            $mensaje = "El archivo <strong>$comanda</strong> fue renombrado a <strong>$nuevoNombre</strong> correctamente.";
        } else {
            $mensaje = "Hubo un error al renombrar el archivo <strong>$comanda</strong>.";
        }
    }
    $archivos = scandir($directorio);
    
    $archivos_txt = array_filter($archivos, function($archivo) {
        return pathinfo($archivo, PATHINFO_EXTENSION) == 'txt';
    });

    if (!empty($archivos_txt)) {
        foreach ($archivos_txt as $archivo) {
            $valor = explode("_", $archivo);
            if ($valor[3] == "pendiente.txt") {
                $aPendientes .= "<li><a href='?completar=" . $archivo . "'>" . $archivo . "</a></li>";
            } else {
                $aElaborados .= "<li>" . $archivo . "</li>";
            }
        }
    } else {
        echo "No se encontraron archivos .txt en la carpeta.";
    }
?>

<!DOCTYPE html>
<html lang="es">
<style>
        body{
            background: #1c1c1c;
            color: white;
        }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Zona privada</h1>
    
    <h2>Bienvenido <?php echo htmlspecialchars($_SESSION['usuario'] ?? ""); ?></h2>

    <!-- Mostrar mensaje de renombrado -->
    <?php if ($mensaje): ?>
        <div class="mensaje <?php echo strpos($mensaje, 'error') === false ? 'exito' : 'error'; ?>">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <h3>Gestión de comandas</h3>

    <h3>Comandas pendientes</h3>
    <ul>
        <?php echo $aPendientes; ?>
    </ul>

    <h3>Comandas elaboradas</h3>
    <ul>
        <?php echo $aElaborados; ?>
    </ul>

    <a href="datos/cerrar.php">Cerrar sesión</a>
</body>
</html>

<?php
} else {
?>

<!DOCTYPE html>
<html lang="es">
    <style>
        body{
            background: #1c1c1c;
            color: white;
        }
    </style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="" method="post">

        <input type="text" name="usuario" placeholder="usuario">
        <input type="text" name="password" placeholder="password">

        <input type="submit" value="Enviar" name="enviar"><br/><br/>

        <select name="categoria" onchange="this.form.submit()">

            <option value ="" disabled selected>-- Selecciona una categoría --</option>
            

            <option value="pizzas"
                <?php 
                    if(isset($_POST['categoria']) && $_POST['categoria'] == 'pizzas'){
                        echo 'selected';
                    }
                ?>>Pizzas</option>
            <option value="bebidas"
                <?php 
                    if(isset($_POST['categoria']) && $_POST['categoria'] == 'bebidas'){
                        echo 'selected';
                    }
                ?>>bebidas</option>
            <option value="postres"
            <?php 
                if(isset($_POST['categoria']) && $_POST['categoria'] == 'postres'){
                    echo 'selected';
                }
            ?>>postres</option>

        </select> 

        <?php if($usuarioSesion){ ?>
            
        <input type="submit" value="Carrito" name="carrito">
        <a href="datos/cerrar.php">Cerrar sesión</a>

        <?php } ?>

    </form><br/>
    
    <br/>
<?php

// var_dump($_SESSION);

if(isset($_POST['categoria'])){
    $categoria = $_POST['categoria'];

    echo "<h2>$categoria</h2>";

    foreach($productos[$categoria] as $key => $valor){

        $nombre = $valor['nombre'];
        $imagen = $valor['imagen'];
        $precio = $valor['precio'];


        foreach($valor as $key2 => $valor2){
            if ($key2 == "nombre") {
                echo "<b>$key2: </b> $valor2<br/>";
            }

            if ($key2 == "imagen") {
                echo "<img src='datos/img/$valor2' alt='$valor2' style='width:150px;height:auto;'> <br/>";
            }

            if($key2 == "precio") {
                if (is_array($valor2)){
                    foreach ($valor2 as $key3 => $valor3){
                        echo "<b>$key3: </b> $valor3 ";



                        if ($usuarioSesion) {
                            foreach ($precio as $unidad => $valor4);

                            echo "<form action='' method='post'>
                                    <input type='hidden' name='producto' value='$nombre'>
                                    <input type='hidden' name='precio' value='$valor4'>
                                    <button type='submit' name='agregarCarrito'>Añadir al carrito</button>
                                  </form><br/>";

                        }

                        
                    }
                } else {
                    echo "<b>Precio: </b> $valor2 <br/>";
                    if ($usuarioSesion) {
                        echo "<form action='' method='post'>
                                <input type='hidden' name='producto' value='$nombre'>
                                <input type='hidden' name='precio' value='$precio'>
                                <button type='submit' name='agregarCarrito'>Añadir al carrito</button>
                              </form><br/>";
                    }
                }
            }
        }

        echo "<br/>";
    }
}



?>

<?php if (isset($_POST['carrito'])){ ?>
        <h2>Carrito de compras</h2>
        <?php if (empty($_SESSION['carrito'])): ?>
            <p>El carrito está vacío.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Precio Total</th>
                </tr>
                <?php
                $totalCarrito = 0;
                foreach ($_SESSION['carrito'] as $producto => $datos): 
                    $totalCarrito += $datos['precioTotal'];
                ?>
                    <tr>
                        <td><?php echo clearData($producto); ?></td>
                        <td><?php echo $datos['cantidad']; ?></td>
                        <td><?php echo $datos['precioUnitario']; ?> €</td>
                        <td><?php echo $datos['precioTotal']; ?> €</td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p><strong>Total a pagar:</strong> <?php echo $totalCarrito; ?> €</p>
            <form action="" method="post">
                <button type="submit" name="finalizar_compra">Finalizar compra</button>
            </form>
        <?php endif; ?>
<?php } 

    if (isset($_POST['finalizar_compra'])) {
        $fechaHora = date('Y-m-d_H-i-s');
        $ticketFile = "ticket/ticket_$fechaHora.txt";
        $comandaFile = "comandas/comanda_$fechaHora"."_pendiente.txt";

        $ticketContent = "Ticket de compra\n";
        $ticketContent .= "-----------------\n";
        $totalCarrito = 0;

        foreach ($_SESSION['carrito'] as $producto => $datos) {
            $ticketContent .= "Producto: $producto\n";
            $ticketContent .= "Cantidad: {$datos['cantidad']}\n";
            $ticketContent .= "Precio Unitario: " . number_format($datos['precioUnitario'], 2) . " €\n";
            $ticketContent .= "Subtotal: " . number_format($datos['precioTotal'], 2) . " €\n";
            $ticketContent .= "-----------------\n";
            $totalCarrito += $datos['precioTotal'];
        }
        $ticketContent .= "Total: " . number_format($totalCarrito, 2) . " €\n";

        file_put_contents($ticketFile, $ticketContent);

        $comandaContent = "Comanda pendiente\n";
        $comandaContent .= "-----------------\n";


        foreach ($_SESSION['carrito'] as $producto => $datos) {     
            
            foreach($productos['pizzas'] as $clave => $valor){
                if ($producto == $valor['nombre']) {
                    $comandaContent .= "Producto: $producto\n";
                    $comandaContent .= "Cantidad: {$datos['cantidad']}\n";
                    $comandaContent .= "-----------------\n";
                } 
            }
            

        }
        

        file_put_contents($comandaFile, $comandaContent);

        $_SESSION['carrito'] = [];
        echo "<p>¡Pedido finalizado! Puedes descargar tus archivos:</p>";
        echo "<a href='$ticketFile' download>Descargar ticket</a><br/>";
        // echo "<a href='$comandaFile' download>Descargar comanda</a>";
    }


?>
    
</body>
</html>

<?php
    }
?>