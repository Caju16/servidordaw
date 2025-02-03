<?php
namespace App\Models;

class Usuario extends DBAbstractModel
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
        $this->query = "SELECT * FROM contactos";
        $this->getResultFromQuery();
        return $this->rows;
    }

    // Para obtener un usuario por id
    public function get($id = ''){}

    public function set($dataCont=array()) {}

    public function edit($id = '', $dataCont=array()){}

    public function delete($id = ''){}
    
    public function login($usuario = '', $password = ''){
        if($usuario != '' && $password != ''){
            $this->query= "SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password";

            $this->parametros['usuario'] = $usuario;
            $this->parametros['password'] = $password;

            $this->getResultFromQuery();
        }
        if(count($this->rows) == 1){
            $this->mensaje = 'Usuario encontrado';
        } else {
            $this->mensaje = 'Usuario no encontrado';
        }
        return $this->rows[0] ?? null;
    }
    

}

?>