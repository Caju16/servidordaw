<?php

        /**
         *
         *  OBTENER EDAD A PARTIR DE FECHA DE NACIMIENTO
         *  @author Miguel Carmona
         * 
        */


    // CAMBIANDO EL MÉTODO EN EL QUE SE INTRODUCE LA FECHA (DÍA, MES, AÑO)

    // $fecha = "16/08/2000";
    // $fecha_nacimiento_convert = DateTime::createFromFormat('d/m/Y', $fecha);
    // $fecha_actual = new DateTime();
    // echo "Fecha de nacimiento: ", $fecha, "<br>";
    // $diferencia = $fecha_actual->diff($fecha_nacimiento_convert);
    // $edad = $diferencia->y;
    // echo "Tiene ", $edad, " año/s";
    

    // MÉTODO TRADICIONAL (AÑO, MES, DÍA)

    $cumpleanos = new DateTime("2000-11-9");
    $hoy = new DateTime();
    $annos = $hoy->diff($cumpleanos);
    echo $annos->y;


?>