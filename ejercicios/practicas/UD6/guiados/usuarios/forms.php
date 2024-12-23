<?php

// Insertar datos

// $nombre = "Firulais";

// $sql = "insert into perros(nombre) values('". $nombre ."')";

// if($db->query($sql)) {
//     echo "ok";
// } else {
//     echo "no";
// }












// SELECCION DE TABLA

// $sql = "SELECT * FROM perros";
// $consulta = $db->prepare($sql);
// $consulta->execute();
// $resultado = $consulta->fetchAll();

// foreach ($resultado as $valor) {
//     echo $valor['nombre'] . "<br/>";
// }













// PRIMER EJEMPLO DE FORMULARIO



// $campo = $_POST['busqueda'] ?? 'S';
// $sql = "SELECT * FROM perros WHERE nombre LIKE '". $campo ."%'";


// // echo $sql;

// $consulta = $db->prepare($sql);
// $consulta->execute();
// $resultado=$consulta->fetchAll();

// echo "listado de perros <br/>";

// if(!$resultado){
//     echo "Error en la consulta";
// }
// else {
//     foreach ($resultado as $valor){
//         echo $valor['nombre']."<br/>";
//     }
// }










// SEGUNDO EJEMPLO



// $campo = $_POST['busqueda'] ?? 'C%';
// $peso = $_POST['peso'] ?? 3;
// $sql = "SELECT * FROM perros WHERE nombre LIKE ? AND peso > ?";

// $consulta = $db->prepare($sql);
// $consulta->execute(array($campo, $peso));
// $resultado=$consulta->fetchAll();
// $numeroRegistros = $consulta-> rowCount();

// echo "listado de perros <br/>";

// if(!$resultado){
//     echo "Error en la consulta";
// }
// else {
//     foreach ($resultado as $valor){
//         echo $valor['nombre'] . " ";
//         echo $valor['peso']."<br/>";
//     }
// }
















// TERCER INTENTO


// $campo = $_POST['busqueda'] ?? 'C%';
// $peso = $_POST['peso'] ?? 3;
// $sql = "SELECT * FROM perros WHERE nombre LIKE :nombre AND peso > :peso";

// $consulta = $db->prepare($sql);
// $aParametros = array(":nombre"=>$campo, ":peso"=>$peso);
// $consulta->execute($aParametros);
// $resultado=$consulta->fetchAll();
// $numeroRegistros = $consulta-> rowCount();

// echo "listado de perros <br/>";

// if(!$resultado){
//     echo "Error en la consulta";
// }
// else {
//     foreach ($resultado as $valor){
//         echo $valor['nombre'] . " ";
//         echo $valor['peso']."<br/>";

//     }
// }




?>