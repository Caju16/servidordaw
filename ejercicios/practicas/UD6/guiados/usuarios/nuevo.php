<?php

include("connect.php");

if(isset($_POST['enviar'])){
    $db = conectaDB();


    $nombre = clearData($_POST['nombre']);
    $peso = clearData($_POST['peso']);
    $raza = clearData($_POST['raza']);


    $sql = "INSERT INTO perros(nombre, peso, raza) values(:nombre, :peso, :raza)";

    $consulta = $db->prepare($sql);
    $aParametros = array(":nombre"=>$nombre, ":peso"=>$peso, ":raza"=>$raza);
    $consulta->execute($aParametros);
    $resultado=$consulta->fetchAll();

    header("location:index.php");
}






?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Nueva mascota</h1>

    <form action="" method="post">

        Nombre: <input type="text" name="nombre" id="nombre">
        Peso: <input type="text" name="peso" id="peso">
        Raza: <input type="text" name="raza" id="raza">

        <input type="submit" value="enviar" id="enviar" name="enviar">

    </form>


<?php



?>

</body>
</html>
