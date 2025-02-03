<?php
namespace App\Models;

class Proyectos extends DBAbstractModel
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

    private $idP;
    private $tituloP;
    private $descripcionP;
    private $logoP;
    private $tecnologiasP;
    private $visibleP;
    private $usuarios_idP;

    public function setIdP($idP){
        $this->idP = $idP;
    }

    public function setTitulosP($tituloP){
        $this->tituloP = $tituloP;
    }

    public function setDescripcionP($descripcionP){
        $this->descripcionP = $descripcionP;
    }

    public function setLogoP($logoP){
        $this->logoP = $logoP;
    }

    public function setTecnologiasP($tecnologiasP){
        $this->tecnologiasP = $tecnologiasP;
    }

    public function setVisibleP($visibleP){
        $this->visibleP = $visibleP;
    }

    public function setUsuarios_idP($usuarios_idP){
        $this->usuarios_idP = $usuarios_idP;
    }

    public function get($id = '') {
        $this->query = "SELECT * FROM proyectos WHERE usuarios_id = :usuarios_id OR id = :id;";
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
        $this->query="INSERT INTO proyectos (titulo, descripcion, logo, tecnologias, visible, usuarios_id)
            VALUES (:titulo, :descripcion, :logo, :tecnologias, :visible, :usuarios_id)";

        $this->parametros['titulo'] = $this->tituloP;
        $this->parametros['descripcion'] = $this->descripcionP;
        $this->parametros['logo'] = $this->logoP;
        $this->parametros['tecnologias'] = $this->tecnologiasP;
        $this->parametros['visible'] = $this->visibleP;
        $this->parametros['usuarios_id'] = $this->usuarios_idP;


        $this->get_results_from_query();
        $this->mensaje = 'Proyecto creado con éxito.';
        return $this->rows;
    }

    public function edit($id = ''){
        $this->query = "UPDATE proyectos SET titulo = :nuevoTitulo, descripcion = :nuevaDescripcion, logo = :nuevoLogo, tecnologias = :nuevaTecnologias, visible = :visible WHERE id = :id AND usuarios_id = :usuarios_id";
        $this->parametros['nuevoTitulo'] = $this->tituloP;
        $this->parametros['nuevaDescripcion'] = $this->descripcionP;
        $this->parametros['nuevoLogo'] = $this->logoP;
        $this->parametros['nuevaTecnologias'] = $this->tecnologiasP;
        $this->parametros['visible'] = $this->visibleP;
        $this->parametros['id'] = $id;
        $this->parametros['usuarios_id'] = $this->usuarios_idP;

        $this->get_results_from_query();

        $this->mensaje = 'Proyecto modificado con éxito.';
        return $this->rows;
    }

    public function delete($id = ''){
        $this->query = "DELETE FROM proyectos WHERE id = :id";
        $this->parametros['id'] = $id;
        $this->get_results_from_query();
        $this->mensaje = 'Proyecto eliminado con éxito.';
        return $this->rows;
    }
}