<?php

    $fecha = "16/08/2000";

    $fecha_nacimiento_convert = DateTime::createFromFormat('d/m/Y', $fecha);

    $fecha_actual = new DateTime();

    echo "Fecha de nacimiento: ", $fecha, "<br>";

    $diferencia = $fecha_actual->diff($fecha_nacimiento_convert);

    $edad = $diferencia->y;

    echo "Tiene ", $edad, " año/s";
?>