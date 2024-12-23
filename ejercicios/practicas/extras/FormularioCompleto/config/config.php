<?php
/**
 * 
 * @author Miguel
 * 
 * 
 */

 $aGenero = array('hombre','mujer','otro');

 $aVehiculos = array('bicicleta','coche','patinete');

 $aColores = array(
        array('codigo' => '1', 'color' => 'rojo'),
        array('codigo' => '2', 'color' => 'verde'),
        array('codigo' => '3', 'color' => 'azul'),
    );


 $aCoches = array('BMW','Audi','Volvo','Seat');

 $aIdiomas = array("B1", "B2", "C1");

 $urlValidas = array("https://www.google.com/?hl=es", "https://www.youtube.com/", "https://dash.infinityfree.com/accounts");

 $errores = array(
    "nombre" => "El nombre es obligatorio",
    "email" => "El correo electrónico introducido no es válido",
    "emailVacio" => "El correo electrónico no puede estar vacío",
    "genero" => "El género es obligatorio",
    "url" => "URL no válida",
    "urlVacia" => "URL Vacía",
    "coches" => "No has seleccionado coches",
    "vehiculos" => "Es obligatorio seleccionar un vehículo",
    "color" => "Selecciona un color",

);
?>