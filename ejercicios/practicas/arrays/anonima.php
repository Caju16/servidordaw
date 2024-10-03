<?php

    // Ejemplo de uso de las funciones anónimas

    $nums = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);

    // Obtener un array con los paises


    // Opción 1

    // echo "Opción 1<br>";
    // $cuadrado = array();
    // foreach ($aPaises as $pais) {
    //     $nombrePaises[] = $pais['pais'];
    // }
    // print_r ($nombrePaises);

    // Opción 2. con funciones anónimas
    echo "<br>Opción 2</br>";
    $cuadrado = array_map(function ($res){
        return $res * $res;
    }, $nums);

    print_r($cuadrado);

?>