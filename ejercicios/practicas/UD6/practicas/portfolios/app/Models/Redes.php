<?php
namespace App\Models;

class Redes extends DBAbstractModel
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

    private $idR;
    private $redes_socialescolR;
    private $urlR;
    private $usuarios_idR;

    public function setIdR($idR){
        $this->idR = $idR;
    }

    public function setRedes_socialescolR($redes_socialescolR){
        $this->redes_socialescolR = $redes_socialescolR;
    }

    public function setUrlR($urlR){
        $this->urlR = $urlR;
    }

    public function setUsuarios_idR($usuarios_idR){
        $this->usuarios_idR = $usuarios_idR;
    }

    public function get($id = '') {
        $this->query = "SELECT * FROM redes_sociales WHERE usuarios_id = :usuarios_id OR id = :id;";
        $this->parametros['usuarios_id'] = $id;
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Usuario encontrada';
        } else {
            $this->mensaje = 'Usuario no encontrada';
        }
        return $this->rows;
    }

    public function set(){
        $this->query = "INSERT INTO redes_sociales (redes_socialescol, url, usuarios_id)
            VALUES (:redes_socialescol, :url, :usuarios_id)";
        $this->parametros['redes_socialescol'] = $this->redes_socialescolR; 
        $this->parametros['url'] = $this->urlR;
        $this->parametros['usuarios_id'] = $this->usuarios_idR;
        $this->get_results_from_query();
        $this->mensaje = 'Red social creada con éxito.';
        return $this->rows;
    }

    public function edit($id=''){
        $this->query = "UPDATE redes_sociales SET redes_socialescol = :redes_socialescol, url = :url WHERE id = :id AND usuarios_id = :usuarios_id";
        $this->parametros['redes_socialescol'] = $this->redes_socialescolR;
        $this->parametros['url'] = $this->urlR;
        $this->parametros['id'] = $id;
        $this->parametros['usuarios_id'] = $this->usuarios_idR;
        $this->get_results_from_query();
        $this->mensaje = 'Red social actualizada con éxito.';
        return $this->rows;
    }

    public function delete($id=''){
        $this->query = "DELETE FROM redes_sociales WHERE id = :id AND usuarios_id = :usuarios_id";
        $this->parametros['id'] = $id;
        $this->parametros['usuarios_id'] = $this->usuarios_idR;
        $this->get_results_from_query();
        $this->mensaje = 'Red social eliminada con éxito.';
        return $this->rows;
    }

}