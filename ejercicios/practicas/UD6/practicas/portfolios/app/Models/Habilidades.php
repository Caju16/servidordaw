<?php
namespace App\Models;

class Habilidades extends DBAbstractModel
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

    private $idS;
    private $habilidadesS;
    private $visibleS;
    private $categorias_skills_categoriaS;
    private $usuarios_idS;

    public function setIdS($idS){
        $this->idS = $idS;
    }

    public function setHabilidadesS($habilidadesS){
        $this->habilidadesS = $habilidadesS;
    }

    public function setVisibleS($visibleS){
        $this->visibleS = $visibleS;
    }

    public function setCategorias_skills_categoriaS($categorias_skills_categoriaS){
        $this->categorias_skills_categoriaS = $categorias_skills_categoriaS;
    }

    public function setUsuarios_idS($usuarios_idS){
        $this->usuarios_idS = $usuarios_idS;
    }

    public function get($id = ''){
        $this->query = "SELECT * FROM skills WHERE usuarios_id = :usuarios_id OR id = :id;";
        $this->parametros['id'] = $id;
        $this->parametros['usuarios_id'] = $id;
        $this->get_results_from_query();
        if (count($this->rows) == 1) {
            foreach ($this->rows[0] as $propiedad=>$valor) {
                $this->$propiedad = $valor;
            }
            $this->mensaje = 'Registro encontrado';
        } else {
            $this->mensaje = 'Registro no encontrado';
        }
        return $this->rows;
    }

    public function getCategoria(){
        $this->query = "SELECT * FROM categorias_skills";
        $this->get_results_from_query();
        return $this->rows;
    }

    public function set()
    {
        $this->query = "INSERT INTO skills (habilidades, visible, categorias_skills_categoria, usuarios_id)
            VALUES (:habilidades, :visible, :categorias_skills_categoria, :usuarios_id)";
        
        $this->parametros['habilidades'] = $this->habilidadesS;
        $this->parametros['visible'] = $this->visibleS;
        $this->parametros['categorias_skills_categoria'] = $this->categorias_skills_categoriaS;
        $this->parametros['usuarios_id'] = $this->usuarios_idS;

        $this->get_results_from_query();
        $this->mensaje = 'Skill creado con éxito.';
        return $this->rows;
    }

    public function edit(){
        $this->query="UPDATE skills SET habilidades = :nuevasHabilidades, visible = :visible, categorias_skills_categoria = :nuevasCategoriasD WHERE id = :id AND usuarios_id = :usuarios_id";
        $this->parametros['nuevasHabilidades'] = $this->habilidadesS;
        $this->parametros['visible'] = $this->visibleS;
        $this->parametros['nuevasCategoriasD'] = $this->categorias_skills_categoriaS;
        $this->parametros['id'] = $this->idS;
        $this->parametros['usuarios_id'] = $this->usuarios_idS;
        
        $this->get_results_from_query();

        $this->mensaje = 'Skill editado con éxito.';
        return $this->rows;
    }

    public function delete($id=''){
        $this->query = "DELETE FROM skills WHERE id = :id AND usuarios_id = :usuarios_id";
        $this->parametros['id'] = $id;
        $this->parametros['usuarios_id'] = $this->usuarios_idS;
        $this->get_results_from_query();
        $this->mensaje = 'Skill eliminado con éxito.';
        return $this->rows;
    }

    public function getUser($id = ''){
        $this->query = "SELECT * FROM skills WHERE id = :id";
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

}