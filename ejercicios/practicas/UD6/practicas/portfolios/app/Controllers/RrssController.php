<?php

namespace App\Controllers;
use App\Models\Usuarios;
use App\Models\Redes;


class RrssController extends BaseController{


    public function createRRSSAction()
    {

        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        $usuario = Usuarios::getInstancia();
        $redes = Redes::getInstancia();

        $procesaForm = false;

        $data['usuario'] = $usuario->get($_SESSION['usuario']['id']);
        $data['redes_socialescol'] = $data['url'] = '';
        $data['msjErrorRrssName'] = $data['msjErrorUrl'] = '';


        if(!empty($_POST)){

            $procesaForm = true;

            $data['redes_socialescol'] = filter_input(INPUT_POST, 'redes_socialescol', FILTER_SANITIZE_STRING);
            $data['url'] = filter_input(INPUT_POST, 'url', FILTER_SANITIZE_URL);

            $rrssName = $_POST['redes_socialescol'];
            $url = $_POST['url'];
            $usuarioId = $_SESSION['usuario']['id'];

            if(empty($rrssName)){
                $data['msjErrorRrssName'] = 'El nombre de la url es obligatorio';
                $procesaForm = false;
            }

            if(empty($url)){
                $data['msjErrorUrl'] = 'La url es obligatoria';
                $procesaForm = false;
            }


        }

        if($procesaForm){

            $redes->setRedes_socialescolR($rrssName);
            $redes->setUrlR($url);
            $redes->setUsuarios_idR($usuarioId);
            $redes->set();

            header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
            exit;
        } else {
            $this->renderHTML('../app/views/create_rrss_view.php', $data);
        }
    }

    public function editRRSSAction()
    {

        // $usuario = Usuarios::getInstancia();
        $redes = Redes::getInstancia();

        $procesaForm = false;

        $rrss = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        $user = $redes->getUser($rrss);

        if(empty($_SESSION['usuario']) || $_SESSION['usuario']['id'] != $user[0]['usuarios_id']){
            header("Location: /");
            exit;
        }

        $data['nuedasRedes_socialescol'] = $data['nuevaUrl'] = $data['rrss'] = '';
        $data['msjErrorRrssName'] = $data['msjErrorUrl'] = '';

        $data['rrss'] = $redes->get($rrss);

        if(!empty($_POST)){
            $procesaForm = true;

            $data['nuedasRedes_socialescol'] = filter_input(INPUT_POST, 'nuedasRedes_socialescol', FILTER_SANITIZE_STRING);
            $data['nuevaUrl'] = filter_input(INPUT_POST, 'nuevaUrl', FILTER_SANITIZE_URL);
            $data['usuarioId'] = filter_input(INPUT_POST, 'usuarioId', FILTER_SANITIZE_STRING);

            $rrssName = $_POST['nuedasRedes_socialescol'];
            $url = $_POST['nuevaUrl'];
            $usuarioId = $_SESSION['usuario']['id'];
            $id = $rrss;

            if(empty($rrssName)){
                $rrssName = $data['rrss'][0]['redes_socialescol'];
            } else if(strlen($rrssName) > 64){
                $data['msjErrorRrssName'] = 'El nombre de la url no puede tener más de 64 caracteres';
                $procesaForm = false;
            }

            if(empty($url)){
                $url = $data['rrss'][0]['url'];
            } else if(strlen($url) > 256){
                $data['msjErrorUrl'] = 'La url no puede tener más de 256 caracteres';
                $procesaForm = false;
            }

        }

        if($procesaForm){
            $redes->setIdR($id);
            $redes->setRedes_socialescolR($rrssName);
            $redes->setUrlR($url);
            $redes->setUsuarios_idR($usuarioId);
            $redes->edit();

            header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
            exit;
        } else {
            $this->renderHTML('../app/views/edit_rrss_view.php', $data);
        }
    }

    public function deleteRRSSAction()
    {
        $redes = Redes::getInstancia();

        $usuario = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        $user = $redes->getUser($usuario);

        if(empty($_SESSION['usuario']) || $_SESSION['usuario']['id'] != $user[0]['usuarios_id']){
            header("Location: /");
            exit;
        }

        $redes->setUsuarios_idR($_SESSION['usuario']['id']);
        $redes->delete($usuario);

        header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
        exit;
    }


}



?>