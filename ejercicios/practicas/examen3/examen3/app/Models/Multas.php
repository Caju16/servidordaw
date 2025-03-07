<?php
namespace App\Models;

class Multas extends DBAbstractModel
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
    private $id_agente;
    private $id_conductor;
    private $matricula;
    private $id_tipo_sanciones;
    private $descripcion;
    private $fecha;
    private $importe;
    private $descuento;
    private $estado;

    public function setId($id) {
        $this->id = $id;
    }

    public function setIdAgente($id_agente) {
        $this->id_agente = $id_agente;
    }

    public function setIdConductor($id_conductor) {
        $this->id_conductor = $id_conductor;
    }

    public function setMatricula($matricula) {
        $this->matricula = $matricula;
    }

    public function setIdTipoSanciones($id_tipo_sanciones) {
        $this->id_tipo_sanciones = $id_tipo_sanciones;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setImporte($importe) {
        $this->importe = $importe;
    }

    public function setDescuento($descuento) {
        $this->descuento = $descuento;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }   

    public function getMensaje(){
        return $this->mensaje;
    }

    public function getAll(){
        $this->query = "SELECT * FROM multas";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function get($id = ''){
        $this->query = "SELECT * FROM multas WHERE id_conductor = :id_conductor";
        $this->parametros['id_conductor'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

   public function getMulta($id = ''){
        $this->query = "SELECT * FROM multas WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function getPorAgente($id = ''){
        $this->query = "SELECT * FROM multas WHERE id_agente = :id_agente";
        $this->parametros['id_agente'] = $id;
        $this->get_results_from_query();
        return $this->rows;
    }

    public function pagarMulta($id = ''){
        $this->query = "UPDATE multas SET estado = 'Pagada' WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
    }

    public function set() {
        $this->query = "INSERT INTO multas (id_agente, id_conductor, matricula, id_tipo_sanciones, descripcion, fecha, importe, descuento, estado) VALUES (:id_agente, :id_conductor, :matricula, :id_tipo_sanciones, :descripcion, :fecha, :importe, :descuento, :estado)";
        $this->parametros['id_agente'] = $this->id_agente;
        $this->parametros['id_conductor'] = $this->id_conductor;
        $this->parametros['matricula'] = $this->matricula;
        $this->parametros['id_tipo_sanciones'] = $this->id_tipo_sanciones;
        $this->parametros['descripcion'] = $this->descripcion;
        $this->parametros['fecha'] = $this->fecha;
        $this->parametros['importe'] = $this->importe;
        $this->parametros['descuento'] = $this->descuento;
        $this->parametros['estado'] = $this->estado;
        $this->get_results_from_query();
    }

    public function edit(){
    }

    public function delete($id=''){
    }


}