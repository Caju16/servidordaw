<?php


if (isset($_POST['crear'])){

    if(!isset($_COOKIE['miCookie'])){
        setcookie('miCookie', "Esta es una cookie de prueba", time() + 10);
        echo "Se ha creado la cookie";
    } else {
        echo "La cookie ya está creada";
    }

}


if (isset($_POST['comprobar'])){
    if(isset($_COOKIE['miCookie'])){
        echo "Información de la cookie: " . $_COOKIE['miCookie'];
    } else {
        echo "No hay cookie creada";
    }
}

if (isset($_POST['destruir'])){
    if(isset($_COOKIE['miCookie'])){
        setcookie('miCookie', "", time() - 10);
        echo "Cookie borrada";
    } else {
        echo "No se puede borrar la cookie, no existe";
    }
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <button type="submit" name="crear">Crear cookie</button>
        <button type="submit" name="comprobar">Comprobar estado</button>
        <button type="submit" name="destruir">Destruir cookie</button>
    </form>
</body>
</html>