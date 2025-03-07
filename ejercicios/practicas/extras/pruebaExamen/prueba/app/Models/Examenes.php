<?php
namespace App\Models;

class Examenes extends DBAbstractModel
{
    private static $instancia;

    // Patron singleton, no puedo tener dos objetos de la clase mascotas
    public static function getInstancia()
    {
        if (!isset(self::$instancia)) {
            $miClase = __CLASS__;
            self::$instancia = new $miClase;
        }
        return self::$instancia;
    }

    public function __clone()
    {
        trigger_error('La clonación no es permitida!.', E_USER_ERROR);
    }



    // Para obtener todos los usuarios
    public function getAll(){
        $this->query = "SELECT * FROM examenes";
        $this->get_results_from_query();
        return $this->rows;
    }

    // Para obtener un examen por id
    public function get($id = ''){
        $this->query = "SELECT * FROM examenes WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set() {
    }

    public function edit(){
    }

    public function delete($id=''){
    }



}