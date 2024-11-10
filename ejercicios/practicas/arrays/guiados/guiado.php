<?php

    // Ejemplo de uso de las funciones anónimas

    $aPaises = array(
        array('id' => 'es', 'pais' => 'España', 'capital' => 'Madrid'),
        array('id' => 'it', 'pais' => 'Italia', 'capital' => 'Roma'),
        array('id' => 'fr', 'pais' => 'Francia', 'capital' => 'Paris'),
    );

    // Obtener un array con los paises


    // Opción 1

    echo "Opción 1<br>";
    $nombrePaises = array();
    foreach ($aPaises as $pais) {
        $nombrePaises[] = $pais['pais'];
    }
    print_r ($nombrePaises);

    // Opción 2. con funciones anónimas
    echo "<br>Opción 2</br>";
    $nombrePaises = array_map(function ($pais){
        return $pais['pais'];
    }, $aPaises);

    print_r($nombrePaises);

?>