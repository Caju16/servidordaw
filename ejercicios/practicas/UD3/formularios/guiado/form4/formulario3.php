<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php 

    /**
     * @Author Miguel Carmona
     * Mostrar formulario con foreach
     */

        $datos = array("nombre", "apellidos", "email");

        echo "<form action='procesa3.php' method='post'>";

        foreach ($datos as $dato) {
            echo "<input type='text' name='$dato' placeholder='$dato' value=''/>";
        }

        echo "<input type='submit' name='enviar' value='Send' />";
        echo "</form>";

    ?>
    
</body>
</html>