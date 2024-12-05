<?php 

    /*
    * @author: Miguel Carmona
    *
    *
    */

    // CONTROL DE ACCESO AL FORMULARIO

    if (!isset($_POST["enviar"])){
        header("location:form.php");
    }


    echo "datos del formulario: <br/> ";

    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El formato del correo es incorrecto. <br/>";
    } else {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        
        echo "Nombre: $nombre <br/>";
        echo "Apellidos: $apellidos <br/>";
        echo "Email: $email <br/>";
    }





?>