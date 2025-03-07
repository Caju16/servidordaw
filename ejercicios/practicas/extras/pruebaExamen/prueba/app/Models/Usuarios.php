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
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $resumen_perfil;
    private $foto;
    private $visible;
    private $token;
    private $fecha_creacion_token;
    private $cuenta_activa;

    // Creo los setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setResumenPerfil($resumen_perfil) {
        $this->resumen_perfil = $resumen_perfil;
    }

    public function setFoto($foto) {
        $this->foto = $foto;
    }

    public function setVisible($visible) {
        $this->visible = $visible;
    }

    public function setToken($token) {
        $this->token = $token;
    }

    public function setFechaCreacionToken($fecha_creacion_token) {
        $this->fecha_creacion_token = $fecha_creacion_token;
    }

    public function setCuentaActiva($cuenta_activa) {
        $this->cuenta_activa = $cuenta_activa;
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

    public function login($email='', $password=''){
        $this->query = "SELECT * FROM usuarios WHERE email = :email AND password = :password";
        $this->parametros['email'] = $email;
        $this->parametros['password'] = $password;
        $this->get_results_from_query();
        return $this->rows;
    }

    // Para obtener un usuario por id
    public function get($id = ''){
    }

    public function set() {
        $fecha = new \DateTime();
        $this->query = "INSERT INTO usuarios (nombre, apellidos, email, password, resumen_perfil, visible, token, foto, fecha_creacion_token, cuenta_activa) VALUES (:nombre, :apellidos, :email, :password, :resumen_perfil, :visible, :token, :foto, :fecha_creacion_token, :cuenta_activa)";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['apellidos'] = $this->apellidos;
        $this->parametros['email'] = $this->email;
        $this->parametros['password'] = $this->password;
        $this->parametros['resumen_perfil'] = $this->resumen_perfil;
        $this->parametros['visible'] = $this->visible;
        $this->parametros['token'] = $this->token;
        $this->parametros['foto'] = $this->foto;
        $this->parametros['fecha_creacion_token'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['cuenta_activa'] = $this->cuenta_activa;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function edit(){
    }

    public function delete($id=''){
    }


}