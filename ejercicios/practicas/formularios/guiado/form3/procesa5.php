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



    foreach($_POST as $clave => $valor){
        
        if ($clave == "email" && !filter_var($valor, FILTER_VALIDATE_EMAIL)){
            echo "El formato es el incorrecto ";
        }
            
            
        echo $valor;
        echo "<br/>";
    }



?>