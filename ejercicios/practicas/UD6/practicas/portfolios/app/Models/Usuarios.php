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
    private $categoria_profesional;
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

    public function setCategoriaProfesional($categoria_profesional) {
        $this->categoria_profesional = $categoria_profesional;
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

    // Para obtener un usuario por id
    public function get($id = ''){
        $this->query = "SELECT * FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Usuario encontrade';
        } else {
            $this->mensaje = 'Usuario no encontrade';
        }
        return $this->rows[0] ?? null;
    }

    public function set() {
        $fecha = new \DateTime();
        $this->query = "INSERT INTO usuarios (nombre, apellidos, foto, categoria_profesional, email, resumen_perfil, password, visible, token, fecha_creacion_token, cuenta_activa) VALUES (:nombre, :apellidos, :foto, :categoria_profesional, :email, :resumen_perfil, :password, :visible, :token, :fecha_creacion_token, :cuenta_activa)";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['apellidos'] = $this->apellidos;
        $this->parametros['foto'] = $this->foto;
        $this->parametros['categoria_profesional'] = $this->categoria_profesional;
        $this->parametros['email'] = $this->email;
        $this->parametros['resumen_perfil'] = $this->resumen_perfil;
        $this->parametros['password'] = $this->password;
        $this->parametros['visible'] = $this->visible;
        $this->parametros['cuenta_activa'] = $this->cuenta_activa;
        $this->parametros['fecha_creacion_token'] = date( 'Y-m-d H:i:s', $fecha->getTimestamp());
        $this->parametros['token'] = $this->token;

        $this->get_results_from_query();
        $this->mensaje = 'Usuario añadido';
        return $this->rows;
    }

    public function edit(){
        $this->query = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email, password = :password, categoria_profesional = :categoria_profesional, resumen_perfil = :resumen_perfil, foto = :foto, visible = :visible WHERE id = :id";
        $this->parametros['nombre'] = $this->nombre;
        $this->parametros['apellidos'] = $this->apellidos;
        $this->parametros['email'] = $this->email;
        $this->parametros['password'] = $this->password;
        $this->parametros['categoria_profesional'] = $this->categoria_profesional;
        $this->parametros['resumen_perfil'] = $this->resumen_perfil;
        $this->parametros['foto'] = $this->foto;
        $this->parametros['visible'] = $this->visible;
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        $this->mensaje = 'Usuario modificado';
        return $this->rows;
    }

    public function delete($id=''){
        $this->query = "DELETE FROM usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->parametros['usuarios_id'] = $id;
        $this->get_results_from_query();
        // var_dump(get_results_from_query());die();

        $this->mensaje = 'Usuario eliminado';
        return $this->rows;
    }

    public function getUserByName($nombre = ''){
        $this->query = "SELECT * FROM usuarios WHERE nombre LIKE '%$nombre%'";
        $this->parametros['nombre'] = '%'.$nombre.'%';
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            $this->mensaje = 'Usuario encontrado';
        } else {
            $this->mensaje = 'Usuario no encontrado';
        }
        return $this->rows;
    }

    public function isEmailValid($email = ''){
        $this->query = "SELECT email FROM usuarios WHERE id != :id";
        $this->parametros['id'] = $this->id;
        $this->get_results_from_query();
        if(count($this->rows) > 0){
            foreach ($this->rows as $propiedad=>$valor) {
                if($valor['email'] == $email){
                    return false;
                }
            }
        }
        if(count($this->rows) == 0){
            return true;
        }
        return $this->rows;
    }

    public function emailExists($email = ''){
        $this->query = "SELECT id FROM usuarios WHERE email = :email";
        $this->parametros['email'] = $email;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function login($email = '', $password = '') {
        $this->query= "SELECT * FROM usuarios WHERE email = :email AND password = :password";
        $this->parametros['email'] = $email;
        $this->parametros['password'] = $password;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            $this->mensaje = 'Usuario encontrado';
            $this->rows[0]['perfil'] = 'user';
            return $this->rows[0];
        } else {
            $this->mensaje = 'Usuario no encontrado';
            return null;
        }
        return $this->rows[0] ?? null;
    }

    public function verificarToken($token= '')
    {
        $this->query = "SELECT * FROM usuarios WHERE token = :token";
        $this->parametros['token'] = $token;
        $this->get_results_from_query();
        if(count($this->rows) == 1){
           // Comprobar si el token ha caducado
            $this->fecha_creacion_token = $this->rows[0]['fecha_creacion_token'];
            $fecha_actual = date('Y-m-d H:i:s');
            $diferencia = strtotime($fecha_actual) - strtotime($this->fecha_creacion_token);
            // var_dump($this->fecha_creacion_token);die();
            if ($diferencia < 86400) {
                $this->query = "UPDATE usuarios SET token = NULL, fecha_creacion_token = NULL, visible = 1 , cuenta_activa = 1 WHERE token = :token";
                $this->parametros['token'] = $token;
                $this->get_results_from_query();
                $this->mensaje = 'Usuario verificado';
            } else {
                $this->mensaje = 'El token ha caducado';
            }
        } else {
            $this->mensaje = 'Token no encontrado';
        }
    }
    

}