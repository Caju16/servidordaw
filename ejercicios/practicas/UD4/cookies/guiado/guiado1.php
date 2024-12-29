<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 

        // Crear una cookie de duracion limitada
    

        // Crear cookie
        setcookie("cookie1", "1", time() + 60);

        echo "Inicio <br/>";
        
        if(isset($_COOKIE["cookie1"])){
            echo $_COOKIE["cookie1"];
        }
        echo "<br>";

        echo "Fin";

    ?>
</body>
</html>