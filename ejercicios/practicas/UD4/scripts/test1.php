<?php
/**
 * 
 * Test 1 para comprobar e manejo de fichero de texto
 *  @author Miguel
 * 
 */
include "./conf/config.php";


// Abrir fichero
$file = fopen("RegMisAlu.csv", "r");
$alumno="";

//Despreciamos linea cabecera
for ($i=0; $i < LINE_CABECERA; $i++) {
    fgets($file);
}

// Recorremos el fichero mostrando los alumnos hasta feof
while (!feof($file)) {
    // cargamos la linea del fichero
    $alumno = fgets($file);
    // reemplazamos los caracteres especiales
    $alumno_st=str_replace($caracteresBusqueda,$caracteresReemplaza, $alumno);
    // Lo pasamos a minuscula
    $alumno_min=strtolower($alumno_st);

    echo $alumno_min."<br/>";
}

fclose($file);

?>