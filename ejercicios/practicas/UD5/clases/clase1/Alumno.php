<?php
/**
 * 
 * Documentacion de la clase alumno
 * 
 * 
 */

 require_once 'Persona.php';

 class Alumno extends Persona
 {
    private $_nie;
    public function saluda(){
        echo parent::saluda();
        echo "Soy un alumno";
    }
 }

?>