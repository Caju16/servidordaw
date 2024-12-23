<?php

$datos = [
    "usuario" => "",
    "pass" => "",
];

if (isset($_POST['enviar'])) {

    
    $datos['usuario'] = $_POST['usuario'];
    $datos['pass'] = $_POST['pass'];


    setcookie('CookieUsuario', $datos['usuario'], time() + 3600);
    setcookie('CookiePass', $datos['pass'], time() + 3600);


    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_COOKIE['CookieUsuario']) && isset($_COOKIE['CookiePass'])){
        $datos['usuario'] = $_COOKIE['CookieUsuario'];
        $datos['pass'] = $_COOKIE['CookiePass'];
}

if (isset($_POST['limpiar'])) {

    if (isset($_COOKIE['CookieUsuario']) && isset($_COOKIE['CookiePass'])){
        setcookie('CookieUsuario', '', time() - 3600);
        setcookie('CookiePass', '', time() - 3600);

        unset($_COOKIE['usuario']);
        unset($_COOKIE['pass']);
    }




    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario con Cookies</title>
    <style>
        body {
            background: #1c1c1c;
            color: white;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($datos['usuario']); ?>">

        <label for="pass">Contraseña:</label>
        <input type="text" id="pass" name="pass" value="<?php echo htmlspecialchars($datos['pass']); ?>">

        <input type="submit" value="Enviar" name="enviar">
        <input type="submit" value="Limpiar Cookies" name="limpiar">
    </form>
</body>
</html>
