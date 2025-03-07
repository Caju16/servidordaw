<?php
namespace App\Models;

class Usuarios extends DBAbstractModel
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
    private $usuario;
    private $password;
    private $nombre;
    private $perfil;

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPerfil($perfil) {
        $this->perfil = $perfil;
    }

    public function getMensaje(){
        return $this->mensaje;
    }

    // Para obtener todos los usuarios
    public function getAll(){
        $this->query = "SELECT * FROM usuarios";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function login($usuario='', $password=''){
        $this->query = "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";
        $this->parametros['usuario'] = $usuario;
        $this->parametros['password'] = $password;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getPerfil($id=''){
        $this->query = "SELECT perfil FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    // Para obtener un usuario por id
    public function get($id = ''){
        $this->query = "SELECT * FROM usuarios WHERE id = :id";
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