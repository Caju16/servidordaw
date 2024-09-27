<?php 

    // $fechaActual = getdate();
    
    $m = 2;
    $mes = "Inicio";
    $dias = 0;
    $anio = 2001;

    switch ($m){
        case 1:
            $mes = "Enero";
            $dias = 31;
            break;
        case 2:
            $mes = "Febrero";
            if (($anio % 4 == 0 && $anio % 100 != 0) || ($anio % 400 == 0)) {
                $dias = 29; 
            } else {
                $dias = 28; 
            }
            break;
        case 3:
            $mes = "Marzo";
            $dias = 31;
            break;
        case 4:
            $mes = "Abril";
            $dias = 30;
            break;
        case 5:
            $mes = "Mayo";
            $dias = 31;
            break;
        case 6:
            $mes = "Junio";
            $dias = 30;
            break;
        case 7:
            $mes = "Julio";
            $dias = 31;
            break;
        case 8:
            $mes = "Agosto";
            $dias = 31;
            break;
        case 9:
            $mes = "Septiembre";
            $dias = 30;
            break;
        case 10:
            $mes = "Octubre";
            $dias = 31;
            break;
        case 11:
            $mes = "Noviembre";
            $dias = 30;
            break;
        case 12:
            $mes = "Diciembre";
            $dias = 31;
            break;
    }

    echo 'El mes ', $mes, ' (',$m,') , tiene ', $dias, ' días'; 



?>