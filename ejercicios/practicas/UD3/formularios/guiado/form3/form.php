<?php

    /*
    * @author: Miguel Carmona
    * Formulario con control de errores sobre el email
    *
    */


    $lProcesaFormulario = false;
    $errorEmail = "";

    if(isset($_POST['enviar'])){
        $lProcesaFormulario = true;
    }

    if($lProcesaFormulario){
        // RECOGER DATOS
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $email = $_POST['email'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $lProcesaFormulario = false;
            $errorEmail = "El email no tiene un formato válido.";
        }

        // MOSTRAR
        echo "Nombre: $nombre";
        echo "Apellidos: $apellidos";
        echo "Email: $email";

    } else {
        echo $errorEmail . "<br/>";
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




    <form action="procesa5.php" method="post" novalidate>

        <input type="text" name="nombre" placeholder="nombre" id=""><br/>
        <input type="text" name="apellidos" placeholder="apellidos" id=""><br/>
        <input type="text" name="email" placeholder="email" id=""><br/>
        <input type="submit" name="enviar" value="enviar">


    </form>
    
</body>
</html>

