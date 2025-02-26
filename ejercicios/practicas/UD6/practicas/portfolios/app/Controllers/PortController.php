<?php

namespace App\Controllers;
use App\Models\Usuarios;
use App\Models\Trabajos;
use App\Models\Habilidades;
use App\Models\Redes;
use App\Models\Proyectos;

class PortController extends BaseController
{
    public function ListAction()
    {
        // Obtener instancias de los modelos

        $usuario = Usuarios::getInstancia();
        $trabajos = Trabajos::getInstancia();
        $habilidades = Habilidades::getInstancia();
        $redes = Redes::getInstancia();
        $proyectos = Proyectos::getInstancia();

        // Extraer el ID del usuario de la URL
        $data['id'] =  explode('/', string: $_SERVER['REQUEST_URI'])[3];

        $encontrado = false;

         // Obtener todos los usuarios disponibles
        $data['usuariosDisponibles'] = $usuario->getAll();

        // Obtener los datos del usuario para el ID dado
        $data['user'] = $usuario->get($data['id']);

        // Redirigir a la página principal si el usuario no es visible y el usuario de la sesión no es el mismo que el solicitado
        if(!$data['user']['visible'] && $_SESSION['usuario']['id'] != $data['id']){
            header('Location: /');
            exit;
        }

        // Verificar si el ID del usuario existe en los usuarios disponibles
        foreach($data['usuariosDisponibles'] as $key => $value){
            if($value['id'] == $data['id']){
                $encontrado = true;
            }
        }

        // Redirigir a la página principal si el ID del usuario no se encuentra
        if(!$encontrado){
            header('Location: /');
            exit;
        }

        // Obtener datos adicionales del usuario
        $data['usuario'] = $usuario->get($data['id']);
        $data['trabajos'] = $trabajos->get($data['id']);
        $data['habilidades'] = $habilidades->get($data['id']);
        $data['redes'] = $redes->get($data['id']);
        $data['proyectos'] = $proyectos->get($data['id']);
        
        // Renderizar la vista con los datos recopilados

        $this->renderHTML('../app/views/list_view.php', $data);
    }

}
?>