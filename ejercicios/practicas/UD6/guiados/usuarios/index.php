<?php
include ("./connect.php");

session_start();

$db = conectaDB();


$datos = $_POST['datos'] ?? 'G';
$valBusqueda = $datos;

// CONSULTA DE PERROS

$sqlPerros = "SELECT * FROM perros WHERE nombre LIKE :nombre OR raza LIKE :raza";
$consulta = $db->prepare($sqlPerros);
$aParametros = array(":nombre"=>$datos."%", ":raza"=> $datos."%");
$consulta->execute($aParametros);
$resultado=$consulta->fetchAll();


// CONSULTA DE USUARIOS

$sqlUsuario = "SELECT * FROM usuario";
$consultaUsuario = $db->prepare($sqlUsuario);
$consultaUsuario->execute();
$resultadoUsuario=$consultaUsuario->fetchAll();
$numeroRegistros = $consulta-> rowCount();


// INICIALIZO VARIABLES Y ESTADO DEL FORMULARIO

$nombreUsuario = $password = "";
$autenticado = false;

// COMPROBAMOS QUE SE HA PULSADO EN EL BOTON DE INICIAR SESION

if (isset($_POST['sesion'])){

    // INICIALIZAR VARIABLES DE POST

    $nombreUsuario = clearData($_POST['usuario']);
    $password = clearData($_POST['pass']);

    // CONSULTA DE LOS USUARIOS

    $sqlBuscar = "SELECT * FROM usuario WHERE nombre = :nombre AND pass = :pass";
    $consultaBuscar = $db->prepare($sqlBuscar);
    $aParametrosBuscar = array(":nombre"=>$nombreUsuario, ":pass"=>$password);
    $consultaBuscar->execute($aParametrosBuscar);
    $resultadoBuscar = $consultaBuscar->rowCount();

    // SI NO ENCUENTRA USUARIOS, NO ENTRA

    if($resultadoBuscar == 0){
        echo "Usuario o contraseña incorrecto";
    } else {  
        // ESTABLECEMOS LAS VARIABLES PARA LA SESION

        $_SESSION['loggeado'] = true;
        $_SESSION['nombreUser'] = $nombreUsuario;
        $_SESSION['admin'] = false;

        // COMPROBAR SI EL USUARIO ES ADMINISTRADOR

        if ($nombreUsuario == "admin" && $password == "1234"){
            $_SESSION['admin'] = true;
        } 

        $autenticado = true;
    }
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

    <!-- SE COMPRUEBA SI HAY UN USUARIO LOGGEADO
        SI LO HAY, CARGA LA VISTA -->
    <?php 
        if (isset($_SESSION['loggeado'])){


        include('view/form_view.php');



    } else { ?>

    <!-- SI NO, MUESTRA EL FORMULARIO DE LOGIN -->

    <form action="" method="post">

                <input type="text" name="usuario" placeholder="Usuario">
                <input type="password" name="pass" placeholder="Contraseña">

                <input type="submit" value="Iniciar sesión" name="sesion">
                
    </form>

    <?php }?>

 
</body>
</html>

