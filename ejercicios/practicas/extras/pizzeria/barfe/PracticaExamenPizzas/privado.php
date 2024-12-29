<?php
/**
 * Página que pide login con formulario y permite gestionar comandas.
 */

session_start();

require_once "./config/config.php";
$auth = false; // Variable que determina si el usuario está logeado.

$usuario = "";
$error = "";

if (isset($_POST["enviar"])) {
    $usuario = clearData($_POST["usuario"]);
    $password = clearData($_POST["password"]);

    // Comprobamos que el usuario exista
    foreach ($admins as $valor => $user) {
        if ($usuario === $user[0] && $password === $user[1]) {
            $auth = true;
            $_SESSION["usuario"] = $usuario;
            break;
        }

        // Si la autenticación es incorrecta, ponemos un error.
        if (!$auth) {
            $error = "Credenciales incorrectas";
        }
    }

    // Si la autenticación es incorrecta, ponemos un error.
    if (!$auth) {
        $error = "Credenciales incorrectas";
    }
}

if (isset($_SESSION["usuario"])) {
    $auth = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        if (!$auth) {
    ?>
    <form method="POST" action="">
        <label>Usuario</label>
        <input type="text" name="usuario">
        <label>Contraseña</label>
        <input type="text" name="password">
        <input type="submit" name="enviar">
        <?php echo $error; ?>
    </form>
    <?php
        } else {
    ?>
        <h1>Comandas</h1>    
    <?php
        $comandas = glob('./comandas/*.txt');
        $comandasPendientes = [];
        $comandasElaboradas = [];

        foreach ($comandas as $comanda) {
            if (strpos($comanda, 'pendiente') !== false) {
                $comandasPendientes[] = $comanda;
            } elseif (strpos($comanda, 'elaborada') !== false) {
                $comandasElaboradas[] = $comanda;
            }
        }

        if (isset($_POST['elaborar'])) {
            $comandaPendiente = $_POST['comanda'];
            $comandaElaborada = str_replace('pendiente', 'elaborada', $comandaPendiente);
            rename($comandaPendiente, $comandaElaborada);
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

        echo "<h2>Comandas Pendientes</h2>";
        echo "<ul>";
        foreach ($comandasPendientes as $comanda) {
            echo "<li>" . basename($comanda) . " <form method='POST' style='display:inline;'><input type='hidden' name='comanda' value='$comanda'><input type='submit' name='elaborar' value='Marcar como elaborada'></form></li>";
        }
        echo "</ul>";

        echo "<h2>Comandas Elaboradas</h2>";
        echo "<ul>";
        foreach ($comandasElaboradas as $comanda) {
            echo "<li>" . basename($comanda) . "</li>";
        }
        echo "</ul>";
    }
    ?>
</body>
</html>