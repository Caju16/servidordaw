<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 

        $datos = array("nombre", "apellidos", "email");

        echo "<form action='procesa3.php' method='post'>";

        foreach ($datosPersonales as $dato) {
            echo "<input type='text' name='$dato' placeholder='$dato' value=''/>";
        }

        echo "<input type='submit' name='enviar' value='Send' />";
        echo "</form>";

    ?>
    
</body>
</html>