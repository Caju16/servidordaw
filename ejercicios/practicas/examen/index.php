<?php

/**
 * 
 * Creación del formulario
 * 
 * @Author: Miguel Carmona
 * @Date: 19/11/2024
 * 
 * 
 */

 include("config/conf.php");


/** Inicializamos variables */

$IdExamen = 0;

$nombreExamen = "";

/**
 * 
 * Establecemos el número aleatorio
 * @var mixed
 */
$IdExamen = rand($aExamen[0]["idExamen"], $aExamen[1]["idExamen"]);


/**
 * 
 * Accedemos a distintas partes del array
 * 
 */

$nombreExamen = $aExamen[$IdExamen]["aNombre"];
$PreguntasExamen = $aExamen[$IdExamen]["Preguntas"];

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Carmona</title>
</head>
<body>
    <h1>Prueba de examen</h1>


    <form action="validar.php" method="post">

        <?php
            echo "<h1>$nombreExamen</h1>";

            /**
             * 
             * Recorremos el array de las preguntas
             * 
             * 
             */
        
            foreach($PreguntasExamen as $indice => $valor){
                echo "<p>". $valor["Pregunta"] . "</p><br/>";


                /**
                 * 
                 * 
                 * Mostramos las preguntas según el tipo de la pregunta
                 * 
                 */

                if($valor["Tipo"] == 0){
                    foreach ($valor["Respuestas"] as $indiceCheck => $valorCheck){
                        echo "<input type='checkbox' name='".  $valor["idPregunta"]  ."' value=$valorCheck />$valorCheck<br/>";
                    }
                }
                
                if($valor["Tipo"] == 1){
                    foreach ($valor["Respuestas"] as $indiceRadio => $valorRadio){
                        echo "<input type='radio' name='".  $valor["idPregunta"]  ."' value=$valorRadio />$valorRadio<br/>";
                    }
                }

                if($valor["Tipo"] == 2){
                    echo "<input type='text' name=".  $valor["idPregunta"]  ."'/>";
                }
            }
        ?>

        <br/><br/>
        <input type="submit" value="Enviar" name="enviar">

    </form>
</body>
</html>