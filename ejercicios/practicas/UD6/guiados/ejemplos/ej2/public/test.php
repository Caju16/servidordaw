<?php

require_once "../app/config/config.php";
require_once "../app/Models/Mascotas.php";

// Creamos mascotas sin utilizar el patrón de diseño
$mascota1 = new Mascotas();
$mascota2 = new Mascotas();

// Se han creado dos objetos


// Creamos mascotas utilizando el patron de diseño

$mascota3 = Mascotas::getInstancia();
$mascota4 = Mascotas::getInstancia();

// Se ha creado un solo objeto

$mascota = Mascotas::getInstancia();

// $mascota->setNombre("Firulai");
// $mascota->setPeso(400);
// $mascota->setRaza("San Bernardo");

$mascota -> get(9);

$mascota->setNombre("Firula");

$mascota -> edit();

// $mascota->delete(7);

var_dump($mascota);

// $mascota->set();

$rs = $mascota -> get(24);

foreach($rs as $fila => $valor){
    echo $fila . " = " . $valor . "<br>";
}

echo $mascota->getMensaje();

?>