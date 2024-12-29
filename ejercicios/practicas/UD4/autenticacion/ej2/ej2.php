<?php
/**
 * Adición: Secciones en función del tipo de login, admin o usuario normal.
 * @autho Jesús Ferrer López
 * @date 08/12/2024
 */

 require_once "./config/conf.php";
 $auth = false; // Variable que determina si el usuario está logeado.
 $usuario = "";
 $password = "";
 $error = "";
 
 session_start();
 if (isset($_SESSION["usuario"])) {
     $auth = true;
 }

 if (isset($_POST["enviar"])) {
    $usuario = clearData($_POST["usuario"]);
    $password = clearData($_POST["password"]);

    // Comprobamos que el usuario exista
    foreach ($users as $valor => $user) {
        if ($usuario === $user[0] && $password === $user[1]) {
            $auth = true;
            $_SESSION["usuario"] = $usuario;
            $_SESSION["tipo"] = $user[2];
            break;
        }
    }

    // Si la autenticación es incorrecta, ponemos un error.
    if (!$auth) {
        $error = "Credenciales incorrectas";
    }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ej1 autentificacion</title>
</head>
<body>
    <h1>Ejercicio 2 de autentificación</h1>
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
            echo "<h2>Bienvenido " . $_SESSION["usuario"] . "</h2>";
            // Si el usuario logeado es admin, le mostramos la sección de administrador.
            if ($_SESSION["tipo"] === "admin") {
                echo "<h3>Zona de ADMINISTRACIÓN</h3>";
                echo "<p>Esta sección solo está disponible para el administrador.</p>";
                echo "<a href='./vista/admin.php'>Vista de admin</a>";
            } 
            
            // Si el usuario logeado es un usuario normal, le mostramos la sección de usuario.
            if ($_SESSION["tipo"] === "user" || $_SESSION["tipo"] === "admin") {
                echo "<h3>Zona de USUARIO</h3>";
                echo "<p>Esta sección solo está disponible para los usuarios y el admin.</p>";
                echo "<a href='./vista/usuario.php'>Vista de usuario</a>";
            }
        }
    ?>
    <h3>Zona pública</h3>
    <p>Todo el mundo puede ver esta zona, incluso si no se han logeado.</p>
    <?php
        if ($auth) {
            echo "<a href='./config/cerrarSesion.php'>Cerrar sesión</a>";
        }
    ?>
</body>
</html>