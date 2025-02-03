<?php
namespace App\Models;

class Trabajos extends DBAbstractModel
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

    private $idT;
    private $tituloT;
    private $descripcionT;
    private $fecha_inicioT;
    private $fecha_finalT;
    private $logrosT;
    private $visibleT;
    private $usuarios_idT;


    public function setIdT($idT){
        $this->idT = $idT;
    }

    public function setTitulosT($tituloT){
        $this->tituloT = $tituloT;
    }

    public function setDescripcionT($descripcionT){
        $this->descripcionT = $descripcionT;
    }

    public function setFechaInicioT($fecha_inicioT){
        $this->fecha_inicioT = $fecha_inicioT;
    }

    public function setFechaFinalT($fecha_finalT){
        $this->fecha_finalT = $fecha_finalT;
    }

    public function setLogrosT($logrosT){
        $this->logrosT = $logrosT;
    }

    public function setVisibleT($visibleT){
        $this->visibleT = $visibleT;
    }

    public function setUsuarios_idT($usuarios_idT){
        $this->usuarios_idT = $usuarios_idT;
    }

    public function get($id = ''){
        $this->query = "SELECT * FROM trabajos WHERE usuarios_id = :usuarios_id OR id = :id;";
        $this->parametros['usuarios_id'] = $id;
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Registro encontrado';
        } else {
            $this->mensaje = 'Registro no encontrada';
        }
        return $this->rows;
    }

    public function set()
    {
        $this->query = "INSERT INTO trabajos (titulo, descripcion, fecha_inicio, fecha_final, logros, visible, usuarios_id)
            VALUES (:titulo, :descripcion, :fecha_inicio, :fecha_final, :logros, :visible, :usuarios_id)";


        $this->parametros['titulo'] = $this->tituloT;
        $this->parametros['descripcion'] = $this->descripcionT;
        $this->parametros['fecha_inicio'] = $this->fecha_inicioT;
        $this->parametros['fecha_final'] = $this->fecha_finalT;
        $this->parametros['logros'] = $this->logrosT;
        $this->parametros['visible'] = $this->visibleT;
        $this->parametros['usuarios_id'] = $this->usuarios_idT;

        $this->get_results_from_query();
        $this->mensaje = 'Trabajo creado con éxito.';
        return $this->rows;
    }

    public function edit($id = ''){
        $this->query = "UPDATE trabajos SET titulo = :nuevoTitulo, descripcion = :nuevaDescripcion, fecha_inicio = :nueva_fecha_inicio, fecha_final = :nueva_fecha_final, logros = :nuevosLogros, visible = :visible WHERE id = :id AND usuarios_id = :usuarios_id";

        $this->parametros['nuevoTitulo'] = $this->tituloT;
        $this->parametros['nuevaDescripcion'] = $this->descripcionT;
        $this->parametros['nueva_fecha_inicio'] = $this->fecha_inicioT;
        $this->parametros['nueva_fecha_final'] = $this->fecha_finalT;
        $this->parametros['nuevosLogros'] = $this->logrosT;
        $this->parametros['visible'] = $this->visibleT;
        $this->parametros['id'] = $id;
        $this->parametros['usuarios_id'] = $this->usuarios_idT;
        
        $this->get_results_from_query();
        $this->mensaje = 'Trabajo editado con éxito.';
        return $this->rows;
    }

    public function delete($id = ''){
        $this->query = "DELETE FROM trabajos WHERE id = :id AND usuarios_id = :usuarios_id";
        $this->parametros['id'] = $id;
        $this->parametros['usuarios_id'] = $this->usuarios_idT;
        $this->get_results_from_query();
        $this->mensaje = 'Trabajo eliminado con éxito.';
        return $this->rows;
    }

}