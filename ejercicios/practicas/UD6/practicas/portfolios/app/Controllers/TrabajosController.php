<?php

namespace App\Controllers;
use App\Models\Usuarios;
use App\Models\Trabajos;

class TrabajosController extends BaseController
{
    public function createWorkAction()
    {

        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        $usuario = Usuarios::getInstancia();
        $trabajos = Trabajos::getInstancia();

        $procesaForm = false;

        $data['usuario'] = $usuario->get($_SESSION['usuario']['id']);
        $data['titulo'] = $data['descripcion'] = $data['fecha_inicio'] = $data['fecha_final'] = $data['logros'] = $data['visible'] = '';
        $data['msjErrorTitulo'] = $data['msjErrorDescripcion'] = $data['msjErrorFechaInicio'] = $data['msjErrorFechaFinal'] = $data['msjErrorLogros'] = '';

        if(!empty($_POST)){

            $procesaForm = true;

            $data['titulo'] = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
            $data['descripcion'] = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
            $data['fecha_inicio'] = filter_input(INPUT_POST, 'fecha_inicio', FILTER_SANITIZE_STRING);
            $data['fecha_final'] = filter_input(INPUT_POST, 'fecha_final', FILTER_SANITIZE_STRING);
            $data['logros'] = filter_input(INPUT_POST, 'logros', FILTER_SANITIZE_STRING);
            $data['visible'] = filter_input(INPUT_POST, 'visible', FILTER_SANITIZE_STRING);
            $data['usuarioId'] = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $fechaInicio = $_POST['fecha_inicio'];
            $fechaFinal = $_POST['fecha_final'] ?? null;
            $logrosInput = $_POST['logros'];
            $visible = $_POST['visible'];
            $usuarioId = $_SESSION['usuario']['id'];

            if(empty($titulo)){
                $data['msjErrorTitulo'] = 'El título es obligatorio';
                $procesaForm = false;
            }

            if(strlen($titulo) > 128){
                $data['msjErrorTitulo'] = 'El título no puede tener más de 128 caracteres';
                $procesaForm = false;
            }

            if(empty($descripcion)){
                $data['msjErrorDescripcion'] = 'La descripción es obligatoria';
                $procesaForm = false;
            }

            if(strlen($descripcion) > 256){
                $data['msjErrorDescripcion'] = 'La descripción no puede tener más de 256 caracteres';
                $procesaForm = false;
            }

            if(empty($fechaInicio)){
                $data['msjErrorFechaInicio'] = 'La fecha de inicio es obligatoria';
                $procesaForm = false;
            }

            if(empty($fechaFinal)){
                $data['msjErrorFechaFinal'] = 'La fecha final es obligatoria';
                $procesaForm = false;
            }
            else if($fechaInicio > $fechaFinal){
                $data['msjErrorFechaFinal'] = 'La fecha final debe ser mayor que la fecha de inicio';
                $procesaForm = false;
            }

            if(empty($logrosInput)){
                $data['msjErrorLogros'] = 'Los logros son obligatorios';
                $procesaForm = false;
            }
            else if (!preg_match('/^[^,]+(,[^,]+)*$/', $logrosInput)) {
                $data['msjErrorLogros'] = 'Error: Los logros deben estar separados por comas. Ejemplo: "Logro1, Logro2, Logro3".';
                $procesaForm = false;
            }

            if(strlen($logrosInput) > 512){
                $data['msjErrorLogros'] = 'Los logros no pueden tener más de 512 caracteres';
                $procesaForm = false;
            }


        }


        if($procesaForm){

            $logros = implode(',', array_map('trim', explode(',', $logrosInput)));

            $trabajos->setTitulosT($titulo);
            $trabajos->setDescripcionT($descripcion);
            $trabajos->setFechaInicioT($fechaInicio);
            $trabajos->setFechaFinalT($fechaFinal);
            $trabajos->setLogrosT($logros);
            $trabajos->setVisibleT($visible);
            $trabajos->setUsuarios_idT($usuarioId);
            $trabajos->set();

            header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
            exit;
        } else {
            $this->renderHTML('../app/views/create_work_view.php', $data);
        }



    }

    public function editWorkAction()
    {


        $usuario = Usuarios::getInstancia();
        $trabajos = Trabajos::getInstancia();

        $procesaForm = false;


        $trabajo = explode('/', string: $_SERVER['REQUEST_URI'])[4];


        $user = $trabajos->getUser($trabajo);

        if(empty($_SESSION['usuario']) || $_SESSION['usuario']['id'] != $user[0]['usuarios_id']){
            header("Location: /");
            exit;
        }

        $data['nuevoTitulo'] = $data['nuevaDescripcion'] = $data['nueva_fecha_inicio'] = $data['nueva_fecha_final'] = $data['nuevosLogros'] = $data['visible'] = $data['trabajo'] = '';
        $data['msjErrorTitulo'] = $data['msjErrorDescripcion'] = $data['msjErrorFechaInicio'] = $data['msjErrorFechaFinal'] = $data['msjErrorLogros'] = '';

        $data['usuario'] = $usuario->get($_SESSION['usuario']['id']);
        $data['trabajo'] = $trabajos->get($trabajo);

        if(!empty($_POST)){
            $procesaForm = true;

            $data['nuevoTitulo'] = filter_input(INPUT_POST, 'nuevoTitulo', FILTER_SANITIZE_STRING);
            $data['nuevaDescripcion'] = filter_input(INPUT_POST, 'nuevaDescripcion', FILTER_SANITIZE_STRING);
            $data['nueva_fecha_inicio'] = filter_input(INPUT_POST, 'nueva_fecha_inicio', FILTER_SANITIZE_STRING);
            $data['nueva_fecha_final'] = filter_input(INPUT_POST, 'nueva_fecha_final', FILTER_SANITIZE_STRING);
            $data['nuevosLogros'] = filter_input(INPUT_POST, 'nuevosLogros', FILTER_SANITIZE_STRING);
            $data['visible'] = filter_input(INPUT_POST, 'visible', FILTER_SANITIZE_STRING);
            $data['usuarioId'] = filter_input(INPUT_POST, 'usuarioId', FILTER_SANITIZE_STRING);

            $titulo = $_POST['nuevoTitulo'];
            $descripcion = $_POST['nuevaDescripcion'];
            $fechaInicio = $_POST['nueva_fecha_inicio'];
            $fechaFinal = $_POST['nueva_fecha_final'] ?? null;
            $logrosInput = $_POST['nuevosLogros'];
            $visible = $_POST['visible'];
            $usuarioId = $_SESSION['usuario']['id'];
            $id = $trabajo;

            if(empty($titulo)){
                $titulo = $data['trabajo'][0]['titulo'];
            }

            if(strlen($titulo) > 128){
                $data['msjErrorTitulo'] = 'El título no puede tener más de 128 caracteres';
                $procesaForm = false;
            }

            if(empty($descripcion)){
                $descripcion = $data['trabajo'][0]['descripcion'];
            }

            if(strlen($descripcion) > 256){
                $data['msjErrorDescripcion'] = 'La descripción no puede tener más de 256 caracteres';
                $procesaForm = false;
            }

            if(empty($fechaInicio)){
                $fechaInicio = $data['trabajo'][0]['fecha_inicio'];
            }

            if(empty($fechaFinal)){
                $fechaFinal = $data['trabajo'][0]['fecha_final'];
            }
            else if($fechaInicio > $fechaFinal){
                $data['msjErrorFechaFinal'] = 'La fecha final debe ser mayor que la fecha de inicio';
                $procesaForm = false;
            }

            if(empty($logrosInput)){
                $logrosInput = $data['trabajo'][0]['logros'];
            }
            else if (!preg_match('/^[^,]+(,[^,]+)*$/', $logrosInput)) {
                $data['msjErrorLogros'] = 'Error: Los logros deben estar separados por comas. Ejemplo: "Logro1, Logro2, Logro3".';
                $procesaForm = false;
            }

            if(strlen($logrosInput) > 512){
                $data['msjErrorLogros'] = 'Los logros no pueden tener más de 512 caracteres';
                $procesaForm = false;
            }
        }

        if($procesaForm){
            $logros = implode(',', array_map('trim', explode(',', $logrosInput)));

            $trabajos->setIdT($id);
            $trabajos->setTitulosT($titulo);
            $trabajos->setDescripcionT($descripcion);
            $trabajos->setFechaInicioT($fechaInicio);
            $trabajos->setFechaFinalT($fechaFinal);
            $trabajos->setLogrosT($logros);
            $trabajos->setVisibleT($visible);
            $trabajos->setUsuarios_idT($usuarioId);
            $trabajos->edit($id);

            header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
            exit;
        } else {
            $this->renderHTML('../app/views/edit_work_view.php', $data);
        }
    }

    public function deleteWorkAction()
    {
        $trabajos = Trabajos::getInstancia();

        $usuario = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        $user = $trabajos->getUser($usuario);

        if(empty($_SESSION['usuario']) || $_SESSION['usuario']['id'] != $user[0]['usuarios_id']){
            header("Location: /");
            exit;
        }

        $trabajos->setUsuarios_idT($_SESSION['usuario']['id']);
        $trabajos->delete($usuario);

        header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
        exit;
    }
}

?>