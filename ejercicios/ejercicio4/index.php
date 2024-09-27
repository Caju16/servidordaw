<?php 

    // DECLARAMOS LAS VARIABLES

    $num1 = 20;
    $num2 = 10;
    $num3 = 10;

    // COMPARACIÓN DE NÚMEROS:

    // SI EL NUM1 ES MÁS PEQUEÑO QUE NUM2 Y 3, ENTRA

    if ($num1 <= $num2 && $num1 <= $num3) {
        if ($num2 <= $num3) {
            echo "$num1, $num2, $num3";
        } else {
            echo "$num1, $num3, $num2";
        }
    } 

    // SI EL NUM2 ES MÁS PEQUEÑO O IGUAL QUE NUM1 Y QUE NUM3, ENTRA

    elseif ($num2 <= $num1 && $num2 <= $num3) {
        if ($num1 <= $num3) {
            echo "$num2, $num1, $num3";
        } else {
            echo "$num2, $num3, $num1";
        }
    } 

    // SI NO SE CUMPLE NINGUNO, ENTRA AQUÍ

    else {
        if ($num1 <= $num2) {
            echo "$num3, $num1, $num2";
        } else {
            echo "$num3, $num2, $num1";
        }
    }

    // Definir la estación
    $estacion = "primavera"; // Puede ser "verano", "otoño", "invierno", "primavera"

    // Selección de imagen según la estación
    $imagen = "";
    if ($estacion == "verano") {
        $imagen = "verano.jpeg";
    } elseif ($estacion == "otoño") {
        $imagen = "otonio.jpg";
    } elseif ($estacion == "invierno") {
        $imagen = "invierno.jpeg";
    } elseif ($estacion == "primavera") {
        $imagen = "primavera.jpg";
    } 

    echo "<img src='$imagen' alt='Imagen de $estacion' width=500px/>";

    $hora_texto = "16:30";

    $hora = DateTime::createFromFormat('H:i', $hora_texto);

    $hora_amanecer = DateTime::createFromFormat('H:i', '07:00');
    $hora_medianoche = DateTime::createFromFormat('H:i', '00:00');
    $hora_medio_dia = DateTime::createFromFormat('H:i', '12:00');
    $hora_noche = DateTime::createFromFormat('H:i', '20:00');


    $color_fondo = "";


    if ($hora >= $hora_amanecer && $hora < $hora_medio_dia) {
        $color_fondo = "#d9ad6c";
    } elseif ($hora >= $hora_medio_dia && $hora < $hora_noche) {
        $color_fondo = "#6b4813"; 
    } else {
        $color_fondo = "#3d4570"; 
    }


    echo "<body style='background-color: $color_fondo;'>";
?>