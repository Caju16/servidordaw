<?php

include('connect.php');
$db = conectaDB();


$valorId = $_GET['id'];

$sql = "DELETE FROM perros WHERE id= :valorId";

$consulta = $db->prepare($sql);
$aParametros = array(":valorId"=>$valorId);
$consulta->execute($aParametros);
$resultado=$consulta->fetchAll();



if(!$resultado){
    echo "Se ha borrado el perro correctamente";
    echo '<a href="index.php">Volver</a>'; 
}
else {
    echo "Error en la consulta";
}




?>