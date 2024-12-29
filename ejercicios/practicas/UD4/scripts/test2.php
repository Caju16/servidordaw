<?php
/**
 * 
 * Test 1 para comprobar e manejo de fichero de texto
 *  @author Miguel
 * 
 */
include "./conf/config.php";

// Declarar variables
$aUsuario = [];
$desglose = [];
$alumno="";
// $nombreUsuario="";

// Abrir fichero
$file = fopen("RegMisAlu.csv", "r");

//Despreciamos linea cabecera
for ($i=0; $i < LINE_CABECERA; $i++) {
    fgets($file);
}

// Recorremos el fichero mostrando los alumnos hasta feof
while (!feof($file)) {
    $nombreUsuario="";
    // cargamos la linea del fichero
    $alumno = fgets($file);
    // reemplazamos los caracteres especiales
    $alumno_st=str_replace($caracteresBusqueda, $caracteresReemplaza, $alumno);
    // Lo pasamos a minuscula
    $alumno_min=strtolower($alumno_st);

    $desglose=explode(" ", $alumno_min);
    
    $nombreUsuario = substr($desglose[0], 1, 2).substr($desglose[1], 0, 2).substr($desglose[2], 0, 2);
    
    $nuevoUsuario = $nombreUsuario;
    $contadorAlumno = 1;
    
    while (in_array($nuevoUsuario, $aUsuario)){
        $nuevoUsuario = $nombreUsuario. $contadorAlumno;
        $contadorAlumno++;
    }

    array_push($aUsuario, $nuevoUsuario);

    echo $nuevoUsuario."<br/>";

}

fclose($file);

?>