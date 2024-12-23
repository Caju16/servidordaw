<?php
/** 
 * Ejemplo de uso de sesiones utilizando un array para manejo
 * de una agenda de contactos
 * 
 * @author Miguel Carmona
 * 
 * 
 * 
*/

// INICIAMOS SESIÓN

session_start();

// SI NO EXISTE LA VARIABLE DE SESIÓN, LA CREAMOS COMO ARRAY VACÍO

if(!isset($_SESSION["contacts"])) {
    $_SESSION["contacts"] = array();
}

if(isset($_POST["enviar"])){
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $tfno = $_POST["tfno"];
    

    if($nombre == '' || $email == '' || $tfno == ''){
        echo "Existen campos vacíos";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "formato de correo inválido";
        } else{
            // AÑADIMOS UN NUEVO ELEMENTO AL ARRAY. VER ARRAY_PUSH
            $_SESSION["contacts"][] = array(
                "nombre" => $nombre,
                "email" => $email,
                "tfno" => $tfno
            );
        }
    }


    
    
}

$data = $_SESSION["contacts"];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Agenda</h1>
    <h2>Nuevo Contacto</h2>
    <form action="" method="post">
        Nombre: <input type="text" name="nombre" id="nombre">
        Email: <input type="text" name="email" id="email">
        Telefono: <input type="text" name="tfno" id="tfno">
        <input type="submit" value="enviar" name="enviar">
    </form>
    <h2>Lista de Contactos</h2>
    <?php
        foreach($data as $clave => $valor){
            echo $valor["nombre"] . " - " . $valor["email"] . " - " . $valor["tfno"];
            echo "<br/>";
        }
    ?>

    <br/>
    <a href="cierre.php">Cerrar sesión</a>
</body>
</html>