<?php

setcookie('ultimaVisita', time(), time() + 3600); 


if (isset($_COOKIE['ultimaVisita'])) {

    $ultimaVisitaTimestamp = $_COOKIE['ultimaVisita'];

    $tiempoTranscurrido = time() - $ultimaVisitaTimestamp;

    echo "Ultima visita hace: " . $tiempoTranscurrido , " segundos";

} else {
    $tiempoTranscurrido = 0;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador de Visitas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1c1c1c;
            color: white;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>
<body>
</body>
</html>
