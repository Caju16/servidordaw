<?php
if (isset($_COOKIE['contadorVisitas'])) {
    $contador = $_COOKIE['contadorVisitas'] + 1;
} else {
    $contador = 1;
}

setcookie('contadorVisitas', $contador, time() + 3600);


?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de Visitas</title>
    <style>
        body {
            background-color: #1c1c1c;
            color: white;
            text-align: center;
        }
    </style>
</head>
<body>
    <p><strong>Número de visitas:</strong> <?php echo $contador; ?></p>
</body>
</html>
