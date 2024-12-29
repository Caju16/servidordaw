<?php 

/**
 * @author Miguel Carmona Cicchetti
 * 
 */

 // requerimos clase persona
 require_once "Persona.php";
 require_once "Alumno.php";

 // creamos objeto
 $persona = new Persona("Miguel", "Carmona", "Cicchetti");
 $alumno1 = new Alumno();


 echo $alumno1->saluda();

 // Método que devuelve el nombre entero
 $persona->saludo();

 echo "<br/>";

 echo $persona->nombre();

?>