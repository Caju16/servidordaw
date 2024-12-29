<?php

/**
 * 
 * @author Miguel
 * Validación de un formulario
 * 
 * 
 */

 // INCLUIR EL ARCHIVO DE CONFIGURACIÓN CON LOS ARRAY
 include("./config/config.php");

 // incluimos archivo que contiene las funciones del proyecto
 include("./lib/functions.php");

 // INICIALIZACIÓN DE VARIABLES

 $confirmado1 = $confirmado2 = $confirmado3 = $confirmado4 = $nombre = $email = $genero = $vehiculos = $colores = $coches =  $comentarios = $url = '';
 $coloresError = $nombreError = $emailError = $generoError = $vehiculosError = $cochesError = $comentariosError = $urlError = '';

 $cochesSeleccionados = array();
 $vehiculosSeleccionados = array();
 $coloresSeleccionados = array();
 $valorCoches = array();
 $valorVehiculos = array();

 $procesaForm = false;
 $e_Validacion = false;

 if(isset($_POST["enviar"])){
    $procesaForm = true;

    //Validamos el nombre
    $nombre=clearData($_POST['nombre']);

    if(empty($nombre)){
        $e_Validacion=true;
        $nombreError="El nombre es obligatorio";
    }

    $email=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $e_Validacion=true;
        $emailError= "El email no es valido";
    }

    if(empty($_POST['genero'])){
        $e_Validacion=true;
        $generoError= "El genero es obligatorio";
    }
    else{
        $genero=$_POST['genero'];
    }

    // Como no tiene validacion
    $url = filter_var($_POST['url'], FILTER_SANITIZE_URL);


    if(isset($_POST['coches'])){
        $valorCoches = $_POST['coches'];
    } else {
        $e_Validacion=true;
        $cochesError= "Se tiene que rellenar mínimo uno";
    }

    if(isset($_POST['vehiculos'])){
        $valorVehiculos = $_POST['vehiculos'];
    } else {
        $e_Validacion = true;
        $vehiculosError = "Se tiene que rellenar un vehículo mínimo";
    }

    if(isset($_POST['colores'])){
        $colores = $_POST['colores'];
    } else {
        $e_Validacion = true;
        $coloresError = "Se tiene que rellenar un color mínimo";
    }

 }

 if($e_Validacion){
    $procesaForm = false;
}

// var_dump($url);

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{
            color:red;
        }
    </style>
</head>
<body>
    <h1>Formulario</h1>
    <p class="error">Los campos con * son obligatorios</p>
    <form action="" method="post">

        Nombre:<input type="text" name="nombre" placeholder="nombre" value="<?php echo "" .$nombre; ?>">
        <span class="error">*<?php echo "". $nombreError;?></span>
        <br/>
        Email:<input type="email" name="email" placeholder="email" value="<?php echo "". $email; ?>">
        <span class="error">*<?php echo "". $emailError;?></span>
        <br/>
        Url:<input type="text" name="url" placeholder="url" id="">
        <br/>
        Comentarios:<textarea name="Comentarios" placeholder="comentarios" rows="" cols=""></textarea>
        <br/><br/>

        <?php
            foreach($agenero as $valor){
                $confirmado1 = $valor == $genero ? "checked":"";
                echo "<input type='radio' name='genero' value='$valor' $confirmado1 />$valor" ;
            }

        ?> <span class="error">*<?php echo "". $generoError;?></span>
        <br/><br/>

        <?php
            foreach($acoches as $valor){
                if(in_array($valor, $valorCoches)){
                    $confirmado2 = 'checked';
                } else {
                    $confirmado2 = '';
                }
                echo "<input type='checkbox' name='coches[]' value='$valor' $confirmado2 />$valor";
            }
        ?> <span class="error">*<?php echo "". $cochesError;?></span>

        <br/><br/>

        <?php 
            foreach($avehiculos as $vehiculo){
                if(in_array($vehiculo, $valorVehiculos)){
                    $confirmado3 = 'checked';
                } else {
                    $confirmado3 = '';
                }
                echo "<input type='checkbox' name='vehiculos[]' value='$vehiculo' $confirmado3/>$vehiculo";
            }
        ?> <span class="error">*<?php echo "". $vehiculosError;?></span>

        <br/><br/>

        <select name="colores" multiple>
            <?php
                foreach ($aopciones as $color => $valor1){
                    // if($colores = $valor1['codigo']){
                    //     $confirmado4 = 'selected';
                    // } else {
                    //     $confirmado4 = '';
                    // }
                    echo "<option value='{$valor1['codigo']}' $confirmado4> {$valor1['color']}</option>";
                }
            ?>
        </select><span class="error">*<?php echo "". $coloresError;?></span>
        
        <br/><br/>
            <?php echo $valor1['codigo']?>
        <input type="submit" name="enviar" value="Enviar">

    </form>



</body>
</html>