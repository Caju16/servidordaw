<?php


/**
 * 
 * @author Miguel
 * 
 */


class Contador{

    private $contador; // Variable privada
    private static $instancia = 0;  // Variable de clase


    /**
     * 
     * Creacion del constructor
     * @param mixed $cont
     */

    public function __construct($cont = 0){
        $this->contador = $cont;
        self::$instancia ++;
    }

    /**
     * 
     * Creacion de contar para aumentar la variable contador
     * @param static
     */

    public function contar(){
        $this->contador++;
        return $this;
    }

    /**
     * 
     * Devolucion del numero de instancias creadas
     * @return mixed
     */
    public static function nInstancias(){
        return self::$instancia;
    }

    /**
     * 
     * Creacion de una cadena con el metodo __toString
     * @return string
     */

    public function __toString() {
        return (string) $this->contador;
    }
}

?>