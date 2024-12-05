<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    
    /*
    *
    * Contador
    *
    */

    if(!isset($_COOKIE["contador"])){
        // Creamos la cookie
        setcookie("contador", "0", time() + 10);
    } else {
        $valor = $_COOKIE["contador"] + 1;
        setcookie("contador", $valor, time() + 10);
    }
    

    // Mostramos la cookie
    echo $_COOKIE["contador"];


    ?>
</body>
</html>