<?php

/**
 * 
 * Formulario Completo
 * @author Miguel Carmona
 * @date 18-11-2024
 */

 // Incluimos archivo de configuración con los arrays y el archivo con las funciones

 include("./config/config.php");
 include("./lib/functions.php");

 // Inicialización de las vairables
 $nombre = $email = $url = $comentarios = $idioma = "";
 $nombreE = $emailE = $generoE = $comentariosE = $urlE = $cochesE = $vehiculosE = $idiomaE = $coloresE = "";
//  $genero = $aGenero[0];
 $confirmado1 = $confirmado2 = $confirmado3 =  $seleccionado1 = $seleccionado2 = "";

 /* Creo las variables que serán arrays proximamente */
 $coche = array();
 $vehiculos = array();
 $colores = array();
 $genero = array();


 // Inicializar variables booleanas para procesar el formulario
 $lProcesaFormulario = false;
 $errorValidacion = false;
 $comprobar = false;


 // Comprobar que el formulario se ha enviado
 if(isset($_POST['enviar'])){
    // procesa a true y empieza a leer variables y comprobar errores
    $lProcesaFormulario = true;
    $nombre = clearData($_POST['nombre']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $comentarios = clearData($_POST['comentarios']);
    $url = clearData($_POST['url']);

    if(empty($url)){
        $urlE = "La url es obligatoria";
        $errorValidacion = true;
    } else {
        $url = $_POST['url'];
    }

    foreach ($urlValidas as $indice => $valor){
        if($comprobar != true){
            $comprobar = $url == $valor;
        }
    }

    if(!$comprobar){
        $urlE = "La url no es del grupo";
        $errorValidacion = true;
    }

    // validar genero
    if( isset ($_POST['genero'])){
        $genero = $_POST['genero'];
    } else {
        $generoE = $errores['genero'];
        $errorValidacion = true;
    }

    // Validamos el idioma
    if (isset($_POST['idioma'])){
        $idioma = $_POST['idioma'];
    } else{
        $idiomaE = "El campo de idioma no puede estar vacio";
        $errorValidacion = true;
    }

    // Validamos el vehiculos
    if (isset($_POST['vehiculos'])){
        $vehiculos = $_POST['vehiculos'];
    } else{
        $vehiculosE = "El campo de vehiculos no puede estar vacio";
        $errorValidacion = true;
    }

    // validar colores
    if( isset ($_POST['colores'])){
        $colores = $_POST['colores'];
    } else {
        $coloresE = "El campo de colores no puede estar vacio";
        $errorValidacion = true;
    }

    // validar coches
    if(isset($_POST['coches'])){
        $coche = $_POST['coches'];
    } else {
        $cochesE = "El campo de coches no puede estar vacio";
        $errorValidacion = true;
    }

    // validar nombre
    if(empty($nombre)){
        $nombreE = "El campo de nombre no puede estar vacio";
        $errorValidacion = true;
    }

    // validar email
    if(empty($email)){
        $emailE = "El campo de email no puede estar vacio";
        $errorValidacion = true;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $emailE = "El formato del email no es valido";
        $errorValidacion = true;
    }
    
    // validar comentarios
    if(empty($comentarios)){
        $comentariosE = "El campo de comentarios no puede estar vacio";
        $errorValidacion = true;
    }
 }

 // Si hemos tenido algun error al validar no mostratemos los datos y le devolvemos al formulario
 if($errorValidacion){
    $lProcesaFormulario = false;
 }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
    <style>
        body{
            background: #1c1c1c;
            color: white;
        }
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <h1>Validación de datos</h1>

    <?php 

        if($lProcesaFormulario){
            echo "Nombre: $nombre </br>";
            echo "Email: $email </br>";
            echo "Url: $url </br>";
            echo "Comentarios: $comentarios </br>";
            echo "Genero: $genero </br>";
            echo "Vehiculos:";
            foreach ($coche as $clave => $valor){
                echo "$valor ";
            }
            echo "</br>Colores:";
            foreach ($colores as $clave => $valor){
                echo "$valor ";
            }
            echo '<a href="javascript:history.back()">Volver</a>';
        } else {
    ?>

    <p class="error">* Campos requeridos</p>
    <form action="" method="post">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo $nombre ?>"><span class="error"><?php echo "* " . $nombreE ?></span><br/>

        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $email ?>"><span class="error"><?php echo "* " . $emailE ?></span><br/>

        <label>Url:</label>
        <input type="text" name="url" value="<?php echo $url ?>"><span class="error"><?php echo "* " . $urlE ?></span><br/>

        <label>Comentarios: </label>
        <textarea name="comentarios"><?php echo $comentarios ?></textarea><span class="error"><?php echo "* " . $comentariosE ?></span><br/>

        <fieldset>
            <legend>Género <span class="error"><?php  echo "*" ?></span></legend>
            <?php
                // Recorrer el array de generos del config.php
                foreach ($aGenero as $clave => $valor){
                    $confirmado1 = $valor == $genero?"checked":"";
                    echo "<input type='radio' name='genero' value='$valor' $confirmado1/>$valor";
                }
            ?>
        </fieldset><span class="error"><?php echo " " . $generoE ?></span><br/>

        <label>Vehículos:</label><br/>
            <?php
                // Recorrer el array de vehiculos del config.php
                foreach($aVehiculos as $clave => $valor){
                    $confirmado2 = in_array($valor, $vehiculos)?"checked":"";
                    echo "<input type='checkbox' name='vehiculos[]' value='$valor' $confirmado2 /> $valor";
                }
            ?>
            <span class="error"><?php echo "* " . $vehiculosE ?></span>
        <br/>
        <label>Coches:</label><br/>
        <?php
            // Recorrer el array de coches del config.php
            foreach($aCoches as $clave => $valor){
                $confirmado3 = in_array($valor, $coche)?"checked":"";
                echo "<input type='checkbox' name='coches[]' value='$valor' $confirmado3 /> $valor";
            }
        ?><span class="error"><?php echo "* " . $cochesE ?></span><br/><br/>
        <label>Nivel ingles:</label>
        <select name="idioma">
            <?php
                // Recorrer array de idiomas del config.php
                foreach($aIdiomas as $clave => $valor){
                    $seleccionado1 = $idioma == $valor?"selected":"";
                    echo "<option value='$valor' $seleccionado1 /> $valor";
                }
            ?>
        </select><span class="error"><?php echo "* " . $idiomaE ?></span><br/>

        <label>Colores:</label><br/>
        <select name="colores[]" multiple>
            <?php
                // Recorremos el array de colores del config.php
                foreach ($aColores as $clave => $valor){
                    foreach ($valor as $color => $valor2) {
                        if ($color != "codigo"){
                            $seleccionado2 = in_array($valor2, $colores)?"selected":"";
                            echo "<option value='$valor2' $seleccionado2> $valor2</option>";
                        }
                    }
                }

            ?>
        </select> <span class="error"><?php echo "* " . $coloresE ?></span><br/>

        <input type="submit" name="enviar" value="Enviar">
        <input type="reset" name="reset" value="Reset">
    </form>
    <?php
        }
    ?>
</body>
</html>