<?php

namespace App\Controllers;
use App\Models\Usuarios;
use App\Models\Habilidades;

class SkillsController extends BaseController{

    public function createSkillAction()
    {

        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        $usuario = Usuarios::getInstancia();
        $habilidad = Habilidades::getInstancia();

        $procesaForm = false;

        $data['categorias'] = $habilidad -> getCategoria();

        $data['usuario'] = $usuario->get($_SESSION['usuario']['id']);
        $data['habilidades'] = $data['visible'] = $data['categoriasD'] ='';
        $data['msjErrorHabilidades'] = $data['msjErrorCategoriasD'] = '';


        if(!empty($_POST)){

            $procesaForm = true;

            $data['habilidades'] = filter_input(INPUT_POST, 'habilidades', FILTER_SANITIZE_STRING);
            $data['visible'] = filter_input(INPUT_POST, 'visible', FILTER_SANITIZE_STRING);
            $data['categoriasD'] = filter_input(INPUT_POST, 'categoriasD', FILTER_SANITIZE_STRING);
            $data['usuarioId'] = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

            $habilidades = $_POST['habilidades'];
            $visible = $_POST['visible'];
            $categoriasD = $_POST['categoriasD'];
            $usuarioId = $_SESSION['usuario']['id'];

            if(empty($habilidades)){
                $data['msjErrorHabilidades'] = 'Las habilidades son obligatorias';
                $procesaForm = false;
            }

            if(empty($categoriasD)){
                $data['msjErrorCategoriasD'] = 'La categoría es obligatoria';
                $procesaForm = false;
            }


        }

        if($procesaForm){

            $habilidad->setHabilidadesS($habilidades);
            $habilidad->setVisibleS($visible);
            $habilidad->setCategorias_skills_categoriaS($categoriasD);
            $habilidad->setUsuarios_idS($usuarioId);
            $habilidad->set();


            header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
            exit;
        } else {
            $this->renderHTML('../app/views/create_skill_view.php', $data);
        }
    }

    public function editSkillAction()
    {

        $usuario = Usuarios::getInstancia();
        $habilidad = Habilidades::getInstancia();

        $procesaForm = false;

        $habilidadId = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        $user = $habilidad->getUser($habilidadId);

        if(empty($_SESSION['usuario']) || $_SESSION['usuario']['id'] != $user[0]['usuarios_id']){
            header("Location: /");
            exit;
        }

        $data['usuario'] = $usuario->get($_SESSION['usuario']['id']);
        $data['habilidad'] = $habilidad->get($habilidadId);
        $data['categorias'] = $habilidad -> getCategoria();

        $data['nuevasHabilidades'] = $data['visible'] = $data['nuevasCategoriasD'] = '';
        $data['msjErrorHabilidades'] = $data['msjErrorCategoriasD'] = '';

        if(!empty($_POST)){

            $procesaForm = true;

            $data['nuevasHabilidades'] = filter_input(INPUT_POST, 'nuevasHabilidades', FILTER_SANITIZE_STRING);
            $data['visible'] = filter_input(INPUT_POST, 'visible', FILTER_SANITIZE_STRING);
            $data['nuevasCategoriasD'] = filter_input(INPUT_POST, 'nuevasCategoriasD', FILTER_SANITIZE_STRING);
            $data['usuarioId'] = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

            $habilidades = $_POST['nuevasHabilidades'];
            $visible = $_POST['visible'];
            $categoriasD = $_POST['nuevasCategoriasD'];
            $usuarioId = $_SESSION['usuario']['id'];

            if(empty($habilidades)){
                $data['nuevasHabilidades'] = $data['habilidad'][0]['habilidades'];
            } else if(strlen($habilidades) > 256){
                $data['msjErrorHabilidades'] = 'Las habilidades no pueden tener más de 256 caracteres';
                $procesaForm = false;
            }

            if(empty($categoriasD)){
                $data['nuevasCategoriasD'] = $data['habilidad'][0]['categorias_skills_categoria'];
            }


        }

        if($procesaForm){
            $habilidad->setIdS($habilidadId);
            $habilidad->setHabilidadesS($habilidades);
            $habilidad->setVisibleS($visible);
            $habilidad->setCategorias_skills_categoriaS($categoriasD);
            $habilidad->setUsuarios_idS($usuarioId);
            $habilidad->edit();


            header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
            exit;
        } else {
            $this->renderHTML('../app/views/edit_skill_view.php', $data);
        }
    }

    public function deleteSkillAction()
    {

        $habilidad = Habilidades::getInstancia();

        $usuario = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        $user = $habilidad->getUser($usuario);

        if(empty($_SESSION['usuario']) || $_SESSION['usuario']['id'] != $user[0]['usuarios_id']){
            header("Location: /");
            exit;
        }

        $habilidad->setUsuarios_idS($_SESSION['usuario']['id']);
        $habilidad->delete($usuario);

        header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
        exit;
    }
}


?>