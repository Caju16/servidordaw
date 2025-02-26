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

    // Para obtener todos los usuarios
    public function getAll(){
        $this->query = "SELECT * FROM Usuarios";
        $this->getResultFromQuery();
        return $this->rows;
    }

    // Para obtener un usuario por id
    public function get($sh_data = array()){
        foreach ($sh_data as $campo=>$valor) {
            $$campo = $valor;
        }

        // var_dump($email); die();
    
        if(isset($id)){
            $this->query = "SELECT * FROM Usuarios WHERE id = :id";

            // Cargamos los parametros
            $this->parametros['id'] = $id;

        } elseif (isset($email)){
            $this->query = "SELECT * FROM Usuarios WHERE email = :email";

            // Cargamos los parametros
            $this->parametros['email'] = $email;

        } else {
            return null;
        }

        // Ejecutamos la consulta
        $this->getResultFromQuery();

        if(count($this->rows) == 1){
            foreach ($this->rows[0] as $propiedad=>$valor){
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Usuario encontrado';
        } else {
            $this->mensaje = 'Usuario no encontrado';
        }
        return $this->rows[0] ?? null;
    }

    public function set($dataCont=array()) {
        foreach ($dataCont as $campo=>$valor) {
            $$campo = $valor;
        }

        $this->query = "INSERT INTO Usuarios(nombre, email, password) VALUES (:nombre, :email, :password)";
        $this->parametros['nombre'] = $nombre;
        $this->parametros['email'] = $email;
        $this->parametros['password'] = $password;

        $this->getResultFromQuery();
        // $this->execute_single_query();
        $this->mensaje = 'Usuario agregado';

        return $this->mensaje;
    }

    public function edit($dataCont=array()){

        foreach ($dataCont as $campo=>$valor) {
            $$campo = $valor;
        }

        // var_dump($dataCont); die();

        $this->query = "UPDATE Usuarios SET nombre = :nombre, email = :email, password = :password WHERE id = :id";
        $this->parametros['nombre'] = $nombre;
        $this->parametros['email'] = $email;
        $this->parametros['password'] = $password;

        
        $this->parametros['id'] = $id;

        $this->getResultFromQuery();
        // $this->execute_single_query();
        $this->mensaje = 'Contacto modificado';

    }

    public function delete($dataCont=array()){
        foreach ($dataCont as $campo=>$valor) {
            $$campo = $valor;
        }
        $this->query = "DELETE FROM Usuarios WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->getResultFromQuery();

        $this->mensaje = 'Usuario eliminado';
        
    }
    
    public function login($email = '', $password = ''){
        if($email != '' && $password != ''){
            $this->query= "SELECT * FROM Usuarios WHERE email = :email AND password = :password";

            $this->parametros['email'] = $email;
            $this->parametros['password'] = $password;

            $this->getResultFromQuery();
        }
        if(count($this->rows) == 1){
            foreach ($this->rows[0] as $propiedad => $valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = "Usuario encontrado";
        } else {
            $this->mensaje = 'Usuario no encontrado';
        }
        return $this->rows[0] ?? null;
    }
    

}

?>