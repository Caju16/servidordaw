<?php
namespace App\Models;

class Inscripciones extends DBAbstractModel
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

    // Para obtener un usuario por id
    public function get($sh_data = array()){
    
        // var_dump($sh_data); die();

        foreach ($sh_data as $campo=>$valor) {
            $$campo = $valor;
        }
    
        if(isset($id)){
            $this->query = "SELECT * FROM Inscripciones WHERE id_usuario = :id_usuario";

            // Cargamos los parametros
            $this->parametros['id_usuario'] = $id;

        }

        // Ejecutamos la consulta
        $this->getResultFromQuery();

        if(count($this->rows) == 1){
            foreach ($this->rows[0] as $propiedad=>$valor){
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Instalaciones encontrado';
        } else {
            $this->mensaje = 'Instalaciones no encontrado';
        }
        return $this->rows ?? null;
    }

    public function set($sh_data = array()){
        if (!is_array($sh_data)) {
            return null;
        }

        foreach ($sh_data as $campo=>$valor) {
            $$campo = $valor;
        }

        $this->query = "INSERT INTO Inscripciones (nombre_solicitante, id_usuario, telefono, email, id_actividad, fecha_inscripcion, estado ) VALUES (:nombre_solicitante, :id_usuario, :telefono, :email, :id_actividad, :fecha_inscripcion, :estado)";
        $this->parametros['nombre_solicitante'] = $nombre_solicitante;
        $this->parametros['id_usuario'] = $id_usuario;
        $this->parametros['telefono'] = $telefono;
        $this->parametros['email'] = $email;
        $this->parametros['id_actividad'] = $id_actividad;
        $this->parametros['fecha_inscripcion'] = $fecha_inscripcion;
        $this->parametros['estado'] = $estado;

        
        $this->getResultFromQuery();
        $this->mensaje = 'Inscripcion realizada';
    }

    public function edit(){}

    public function getById($id = ''){
        $this->query = "SELECT * FROM Inscripciones WHERE id_usuario = :id_usuario";
        $this->parametros['id_usuario'] = $id;
        $this->getResultFromQuery();
        $this->mensaje = 'Reserva encontrada';
        return $this->rows;
    }

    public function getPlazas($id = ''){
        $this->query = "SELECT plazas FROM Actividades WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->getResultFromQuery();
        $this->mensaje = 'Plazas encontradas';
        return $this->rows;
    }

    public function getInscripcionesCount($id_actividad = ''){
        $this->query = "SELECT COUNT(*) as count FROM Inscripciones WHERE id_actividad = :id_actividad";
        $this->parametros['id_actividad'] = $id_actividad;
        $this->getResultFromQuery();
        return $this->rows[0]['count'];
    }

    public function delete($id = ''){
        $this->query = "DELETE FROM Inscripciones WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->getResultFromQuery();
        $this->mensaje = 'Reserva eliminada';
    }
    

}

?>