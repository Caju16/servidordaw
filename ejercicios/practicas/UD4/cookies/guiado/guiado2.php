<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 

        // Borrar la cookie
            

        if(isset($_COOKIE["cookie1"])){
            setcookie("cookie1", "1", time() - 60);
            echo "Borrada";
        }



    ?>
</body>
</html>