<?php
namespace App\Models;

class Instalaciones extends DBAbstractModel
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
            $this->query = "SELECT * FROM Instalaciones WHERE id_centro = :id_centro";

            // Cargamos los parametros
            $this->parametros['id_centro'] = $id;

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

    public function getByFilter($sh_data = array()) {
        if (!is_array($sh_data)) {
            return null;
        }

        // var_dump($sh_data); die();
    
        $this->query = "SELECT nombre, descripcion, capacidad_maxima FROM Instalaciones";
        $this->parametros = [];
        $conditions = [];
    
        if (!empty($sh_data['nombre'])) {
            $conditions[] = "nombre LIKE :nombre";
            $this->parametros['nombre'] = '%' . $sh_data['nombre'] . '%';
        }
    
        if (!empty($sh_data['descripcion'])) {
            $conditions[] = "descripcion LIKE :descripcion";
            $this->parametros['descripcion'] = '%' . $sh_data['descripcion'] . '%';
        }
    
        if (!empty($sh_data['capacidad_maxima'])) {
            $conditions[] = "capacidad_maxima = :capacidad_maxima";
            $this->parametros['capacidad_maxima'] = $sh_data['capacidad_maxima'];
        }
    
        // Si hay condiciones, las añadimos a la consulta con AND
        if (!empty($conditions)) {
            $this->query .= " WHERE " . implode(" AND ", $conditions);
        }

        $this->getResultFromQuery();

        if(count($this->rows) > 0){
            $this->mensaje = 'Instalaciones encontradas';
        } else {
            $this->mensaje = 'Instalaciones no encontradas';
        }
        return $this->rows ?? null;
    }
    

    public function set(){}
    public function edit(){}
    public function delete(){}
    

}

?>