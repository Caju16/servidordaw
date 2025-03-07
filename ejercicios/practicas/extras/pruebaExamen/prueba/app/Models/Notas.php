<?php
namespace App\Models;

class Notas extends DBAbstractModel
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

    private $id;
    private $id_usuario;
    private $id_examen;
    private $nota;
    private $fecha_creacion;

    // Creo los setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setIdExamen($id_examen) {
        $this->id_examen = $id_examen;
    }

    public function setNota($nota) {
        $this->nota = $nota;
    }

    public function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    // Para obtener todos los usuarios
    public function getAll(){
        $this->query = "SELECT * FROM notas";
        $this->get_results_from_query();
        return $this->rows;
    }

    // Para obtener un usuario por id
    public function get($id = ''){
    }

    public function set(){}

    public function edit(){
    }

    public function setNotas($data) {
        $this->query = "INSERT INTO notas (id_usuario, id_examen, nota, fecha_realizacion) 
                        VALUES (:id_usuario, :id_examen, :nota, :fecha_realizacion)";

        $this->parametros['id_usuario'] = $data['id_usuario'];
        $this->parametros['id_examen'] = $data['id_examen'];
        $this->parametros['nota'] = $data['nota'];
        $this->parametros['fecha_realizacion'] = $data['fecha_realizacion'];

        $this->get_results_from_query();
    }

    public function delete($id=''){
    }

    public function getNota($id_usuario = ''){
        $this->query = "SELECT nota FROM notas WHERE id_usuario = :id_usuario";
        $this->parametros['id_usuario'] = $id_usuario;
        $this->get_results_from_query();
        return $this->rows;
    }


}