<?php

    /**
     *  Días de la semana
     *  @author Miguel Carmona
     * 
     */


     // Definir array los días de la semana
     $diasSemana = array("Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo");
     
    // Calculamos el tamaño del array

     $numeroDias = count($diasSemana);

    // Recorremos el array

     for ($i = 0; $i < $numeroDias; $i++){
        echo $diasSemana[$i], " ";
     }

?>