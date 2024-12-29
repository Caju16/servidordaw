<?php

define("LINE_CABECERA", 1);
define("A_INICIO", 2010);
define("A_FINAL",2030);

// DIRECTORIO PARA LA SUBIDA DE LOS ARCHIVOS Y TAMAÑO MAXIMO

define("DIRUPLOAD","upload/");
define("MAXSIZE",200000);

// EXTENSION PERMITIDA

$allowedExts = array("csv");
$allowedFormat = array("text/csv");

$caracteresBusqueda = array("Á","á","É","é","Í","í","Ó","ó","Ü","ü","Ú","ú","ñ","Ñ",",","\"");
$caracteresReemplaza = array("A","a","E","e","I","i","O","o","U","u","U","u","n","N","","");

$grupos = array("1 DAW", "2 DAW", "1 ASIR", "2 ASIR");
$formatos = array("Linux", "MySQL");

?>