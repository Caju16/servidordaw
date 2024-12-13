<?php
session_start();
include "lib/function.php";
include "config/config.php";

if(isset($_POST['pedir'])){
    $_SESSION["tramitar"]["total"] = $_POST['total'];
    $_SESSION["tramitar"]["escritura"] = $_POST['content'];
    header("location: tramitar_pedido.php");
}

if (!isset($_SESSION['usuario'])){
    $_SESSION['usuario'] = "Invitado";
    $_SESSION['login'] = false;
    $_SESSION['mostrar'] = "pizzas";
    $_SESSION['carrito'] = [];
    $_SESSION["tramitar"] = [];
}

if (isset($_POST['enviar'])){
    $usuario = clearData($_POST['user']);
    $contrasenia = clearData($_POST['password']);

    if($usuario == "raul" && $contrasenia == "bermudez"){
        $_SESSION['usuario'] = "Administrador";
        $_SESSION['login'] = true;
    }else  if ($usuario == "" || $contrasenia == ""){
        echo "Error al iniciar sesion";
    }else {
        $_SESSION['usuario'] = $usuario. " ";
        $_SESSION['login'] = true;
    }
}

// Comprobamos que boton ha puulsado
if (isset($_POST["pizzas"])){
    $_SESSION['mostrar'] = "pizzas"; 
}
if (isset($_POST["bebidas"])){
    $_SESSION['mostrar'] = "bebidas"; 
}
if (isset($_POST["postres"])){
    $_SESSION['mostrar'] = "postres"; 
}
if (isset($_POST["carrito"])){
    $_SESSION['mostrar'] = "carrito"; 
}

$user = $_SESSION['usuario'];
$login = $_SESSION['login'];
$vista = $_SESSION['mostrar'];
$aCarrito = $_SESSION['carrito'];


// Aquí va todo el código de manejo de sesión y productos, tal como lo tienes

// Función para actualizar los productos recientes
function agregarProductoReciente($producto) {
    // Asegúrate de que la variable de sesión para productos recientes exista
    if (!isset($_SESSION['productos_recientes'])) {
        $_SESSION['productos_recientes'] = [];
    }
    
    // Agregar el producto al principio del array
    array_unshift($_SESSION['productos_recientes'], $producto);
    
    // Mantener solo los 3 productos más recientes
    if (count($_SESSION['productos_recientes']) > 3) {
        array_pop($_SESSION['productos_recientes']);
    }
}

// Comprobación de los botones y adición al carrito
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pizza'])) {
        $valor_pulsado = $_POST['pizza'];
        $value = explode("-", $valor_pulsado);
        $producto = ["nombre" => $value[0], "precio" => $value[1], "tamaño" => $value[2]];
        
        if (isset($_SESSION['carrito']['pi-' . $value[0] . ''. $value[2] . ''])) {
            $_SESSION['carrito']['pi-' . $value[0] . '' . $value[2] . '']['cantidad'] += 1;
        } else {
            $_SESSION['carrito']['pi-' . $value[0] . '' . $value[2] . ''] = array("cantidad" => 1, "nombre" => $value[0], "precio" => $value[1], "tamaño" => $value[2]);
        }
        
        // Agregar el producto a la lista de productos recientes
        agregarProductoReciente($producto);
    }

    if (isset($_POST['bebida'])) {
        $valor_pulsado = $_POST['bebida'];
        $value = explode("-", $valor_pulsado);
        $producto = ["nombre" => $value[0], "precio" => $value[1]];
        
        if (isset($_SESSION['carrito']['be-' . $valor_pulsado])) {
            $_SESSION['carrito']['be-' . $valor_pulsado]['cantidad'] += 1;
        } else {
            $_SESSION['carrito']['be-' . $valor_pulsado] = array("cantidad" => 1, "nombre" => $value[0], "precio" => $value[1]);
        }
        
        // Agregar el producto a la lista de productos recientes
        agregarProductoReciente($producto);
    }

    if (isset($_POST['postre'])) {
        $valor_pulsado = $_POST['postre'];
        $value = explode("-", $valor_pulsado);
        $producto = ["nombre" => $value[0], "precio" => $value[1]];
        
        if (isset($_SESSION['carrito']['po-' . $valor_pulsado])) {
            $_SESSION['carrito']['po-' . $valor_pulsado]['cantidad'] += 1;
        } else {
            $_SESSION['carrito']['po-' . $valor_pulsado] = array("cantidad" => 1, "nombre" => $value[0], "precio" => $value[1]);
        }
        
        // Agregar el producto a la lista de productos recientes
        agregarProductoReciente($producto);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizzeria FaMia</title>
</head>
<body>
    <h1>Bienvenido a la pizzeria FaMia. Estas autenticado como <?php echo $user?></h1>
    
    <?php if (!$login): ?>
    <h2>LOGIN</h2>
    <form action="" method="POST">
        <label>Usuario</label>
        <input type="text" name="user"><br/>
        <label>Contraseña</label>
        <input type="text" name="password"><br/>
        <button name="enviar" type="submit">Enviar</button>
    </form>
    <?php else: ?>
    <a href="cerrarSesion.php">Cerrar sesión</a>
    <?php endif; ?>

    <form action="" method="post">
        <input type="submit" name="pizzas" value="Pizzas">
        <input type="submit" name="bebidas" value="Bebidas">
        <input type="submit" name="postres" value="Postres">
        <?php
            if ($login){
                include("view/carrito_view.php");
            }
        ?>
    </form>

    <?php
        if ($vista == "pizzas"){
            include "view/pizzas_view.php";
        } else if ($vista == "bebidas"){
            include "view/bebidas_view.php";
        } else if ($vista == "postres"){
            include "view/postres_view.php";
        } else {
            include "view/carritov2_view.php";
        }
    ?>

    <!-- Apartado de recomendaciones (últimos 3 productos pedidos) -->
    <h2>Recomendaciones</h2>
    <ul>
        <?php
        if (isset($_SESSION['productos_recientes'])) {
            foreach ($_SESSION['productos_recientes'] as $producto) {
                echo "<li>" . $producto['nombre'] . " - " . $producto['precio'] . "€</li>";
            }
        } else {
            echo "<li>No hay productos recientes.</li>";
        }
        ?>
    </ul>
</body>
</html>
