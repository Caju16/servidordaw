<?php

    /*
    * @author: Miguel Carmona
    *
    *
    */


    $lProcesaFormulario = false;


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
        }

        // MOSTRAR
        echo "Nombre: $nombre";
        echo "Apellidos: $apellidos";
        echo "Email: $email";

    } else {


    // ARRAY INDEXADO QUE CONTIENE LOS GRUPOS
    // $arrayGrupos = array("1º DAW","2º DAW", "1º ASIR", "2º ASIR"); 


?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 

        if($lProcesaFormulario){
            // RECOGER DATOS
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
        } else {
            
        }
    
    
    ?>



    <form action="" method="post" novalidate>

        <input type="text" name="nombre" id=""><br/>
        <input type="text" name="apellidos" id=""><br/>
        <input type="text" name="email" id=""><br/>

        <!-- <select name="grupos" id="">
            <?php 
                // foreach($arrayGrupos as $key => $valor){  

                //     echo '<option value="'. $valor .'">'.$valor.'</option>';
                    
                // }
            
            ?>
        </select><br/> -->

        <input type="submit" name="enviar" value="enviar">


    </form>
    
</body>
</html>
<?php
    }
?>


