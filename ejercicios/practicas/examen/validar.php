<?php

/**
 * 
 * Archivo para comprobar errores
 * @Date: 19/11/2024
 * @Author: Miguel Carmona Cicchetti
 * 
 */

// var_dump($_POST);
// die();

include("config/conf.php");

echo "<h1>Comprobación de examen</h1>";


// var_dump($_POST);

echo "<p>Tus respuestas: </p>";

foreach($_POST as $indice => $valor){

    if ($valor != "Enviar"){
        echo $valor . "<br/>";
    }

    
}

echo "<p>Las respuestas eran: </p>";

foreach($aExamen as $indice2 => $valor2){
    var_dump($valor2['Respuestas']);
    // foreach($valor2 as $indice3 => $valor3){
    //     echo $valor3['Respuestas'];
    // }
}


echo '<a href="javascript:history.back()">Volver</a>';


?>