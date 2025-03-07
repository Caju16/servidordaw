<?php

namespace App\Controllers;

use App\Models\Usuarios;

class DefaultController extends BaseController
{
    public function IndexAction()
    {
        $data = [];
        $data['usuario'] = $data['password'] = '';
        $data['msjErrorUser'] = $data['msjErrorPassword'] = $data['msjErrorCaptcha'] = '';
        $data['captcha'] = '';
        $lProcesaFormulario = false;
        // var_dump($_SESSION);
        $captcha = ['Coche', 'Peaton', 'Semaforo'];

        $usuarios = Usuarios::getInstancia();


        if(!isset($_SESSION['captcha'])) {
            $data['captcha'] = $captcha[rand(0, 2)];
            $_SESSION['captcha'] = $data['captcha'];
        }


        // var_dump($_SESSION['captcha']);

        if(isset($_POST['enviar'])) {
            $data['usuario'] = $_POST['usuario'];
            $data['password'] = $_POST['password'];
            $_POST['captcha'] = $_POST['captcha'] ?? '';
            $lProcesaFormulario = true;

            // var_dump($_POST); die();

            if($data['usuario'] == '') {
                $lProcesaFormulario = false;
                $data['msjErrorUser'] = "Debes rellenar el usuario";
            }

            if($data['password'] == '') {
                $lProcesaFormulario = false;
                $data['msjErrorPassword'] = "Debes rellenar la contraseña";
            }

            if($_POST['captcha'] != $_SESSION['captcha']) {
                $lProcesaFormulario = false;
                $data['msjErrorCaptcha'] = "Captcha incorrecto";
            }
        }

        if($lProcesaFormulario){
            if(isset($_POST['enviar'])){
                $usuario = $usuarios->login($data['usuario'], $data['password']);

                if($usuario) {
                    $_SESSION['user'] = $usuario;
                    $perfil = $usuarios->getPerfil($_SESSION['user'][0]['id']);
                    $_SESSION['perfil'] = $perfil[0]['perfil'];

                    header('Location: /listado');
                    echo "Usuario logueado";
                } else {
                    $data['msjErrorPassword'] = "Usuario o contraseña incorrectos";
                    $this->renderHTML('../app/views/index_view.php', $data);
                }
            }
        } else {
            $this->renderHTML('../app/views/index_view.php', $data);
        }
    }

    public function LogoutAction()
    {
        session_destroy();
        // echo "Sesión cerrada";
        header('Location: /');
    }
}
?>