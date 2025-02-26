<?php

namespace App\Controllers;
use App\Models\Usuarios;
use App\Models\Proyectos;

class ProyectosController extends BaseController{

    // Método para crear un proyecto

    public function createProjectAction()
    {

        // Verificar si el usuario está logueado

        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }
        
        // Obtener instancias de los modelos

        $usuario = Usuarios::getInstancia();
        $proyectos = Proyectos::getInstancia();

        $procesaForm = false;

        $data['usuario'] = $usuario->get($_SESSION['usuario']['id']);

        $data['titulo'] = $data['descripcion'] = $data['logo'] = $data['tecnologias'] = $data['visible'] = '';
        $data['msjErrorTitulo'] = $data['msjErrorDescripcion'] = $data['msjErrorLogo'] = $data['msjErrorTecnologias'] = '';


        // Verificar si se ha enviado el formulario

        if(!empty($_POST)){

            $procesaForm = true;

            $data['titulo'] = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
            $data['descripcion'] = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
            $data['tecnologias'] = filter_input(INPUT_POST, 'tecnologias', FILTER_SANITIZE_STRING);
            $data['visible'] = filter_input(INPUT_POST, 'visible', FILTER_SANITIZE_STRING);
            $data['usuarioId'] = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

            $titulo = $_POST['titulo'];
            $descripcion = $_POST['descripcion'];
            $tecnologias = $_POST['tecnologias'];
            $visible = $_POST['visible'];
            $usuarioId = $_SESSION['usuario']['id'];
            $logo = $_FILES['logo'];

            if (isset($logo) && $logo['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $logo['tmp_name'];
                $fileName = $logo['name'];
                $fileSize = $logo['size'];
                $fileType = $logo['type'];

                // Validar el tipo de archivo
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($fileType, $allowedMimeTypes)) {
                    $data['msjErrorLogo'] = 'El archivo debe ser una imagen (JPG, PNG, GIF).';
                    $procesaForm = false;
                } else {
                    // Generar un nombre único para la imagen
                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                    $newFileName =  "Logo_". $data['usuario']['nombre']."_".$data['usuario']['apellidos'] ."_". uniqid('user_') . '.' . $fileExtension;

                    // Ruta donde se almacenará la imagen
                    $uploadFileDir = 'uploads/';
                    $dest_path = $uploadFileDir . $newFileName;

                    // Mover el archivo al directorio de destino
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $data['logo'] = $dest_path;
                    } else {
                        $data['msjErrorLogo'] = 'Hubo un problema al subir la imagen.';
                        $procesaForm = false;
                    }
                }
            } else if (isset($logo) && $logo['error'] !== UPLOAD_ERR_NO_FILE) {
                $data['msjErrorLogo'] = 'Hubo un error al subir la imagen.';
                $procesaForm = false;
            } else if (empty($data['logo'])) {
                $data['msjErrorLogo'] = 'La imagen es obligatoria.';
                $procesaForm = false;
            }

            if(empty($titulo)){
                $data['msjErrorTitulo'] = 'El título es obligatorio';
                $procesaForm = false;
            } else if(strlen($titulo) > 128){
                $data['msjErrorTitulo'] = 'El título no puede tener más de 128 caracteres';
                $procesaForm = false;
            }

            if(empty($descripcion)){
                $data['msjErrorDescripcion'] = 'La descripción es obligatoria';
                $procesaForm = false;
            } else if(strlen($descripcion) > 256){
                $data['msjErrorDescripcion'] = 'La descripción no puede tener más de 256 caracteres';
                $procesaForm = false;
            }

            if(empty($tecnologias)){
                $data['msjErrorTecnologias'] = 'Las tecnologías son obligatorias';
                $procesaForm = false;
            } else if (!preg_match('/^[^,]+(,[^,]+)*$/', $tecnologias)) {
                $data['msjErrorTecnologias'] = 'Error: Las tecnologías deben estar separadas por comas. Ejemplo: "Tec1, Tec2, Tec3...".';
                $procesaForm = false;
            } else if(strlen($tecnologias) > 256){
                $data['msjErrorTecnologias'] = 'Las tecnologías no pueden tener más de 256 caracteres';
                $procesaForm = false;
            }


        }

        // Si el formulario se ha procesado correctamente, se guardan los datos en la base de datos

        if($procesaForm){

            $tecs = implode(',', array_map('trim', explode(',', $tecnologias)));

            $proyectos->setTitulosP($titulo);
            $proyectos->setDescripcionP($descripcion);
            $proyectos->setLogoP($data['logo']);
            $proyectos->setTecnologiasP($tecs);
            $proyectos->setVisibleP($visible);
            $proyectos->setUsuarios_idP($usuarioId);
            $proyectos->set();


            header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
            exit;
        } else {
            $this->renderHTML('../app/views/create_project_view.php', $data);
        }
    }

    // Método para editar un proyecto

    public function editProjectAction()
    {
        // Verificar si el usuario está logueado

        $proyectos = Proyectos::getInstancia();
        $usuario = Usuarios::getInstancia();

        // Extraer el ID del proyecto de la URL

        $proyecto = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        // Obtener el usuario del proyecto

        $user = $proyectos->getUser($proyecto);

        // Redirigir a la página principal si el usuario no es visible y el usuario de la sesión no es el mismo que el solicitado

        if(empty($_SESSION['usuario']) || $_SESSION['usuario']['id'] != $user[0]['usuarios_id']){
            header("Location: /");
            exit;
        }

        $data['proyecto'] = $proyectos->get($proyecto);
        $data['usuario'] = $usuario->get($_SESSION['usuario']['id']);

        $data['nuevoTitulo'] = $data['nuevaDescripcion'] = $data['nuevoLogo'] = $data['nuevaTecnologias'] = $data['visible'] = '';
        $data['msjErrorTitulo'] = $data['msjErrorDescripcion'] = $data['msjErrorTecnologias'] = $data['msjErrorLogo'] = '';

        $procesaForm = false;

        // Verificar si se ha enviado el formulario

        if(!empty($_POST)){

            $procesaForm = true;

            $data['nuevoTitulo'] = filter_input(INPUT_POST, 'nuevoTitulo', FILTER_SANITIZE_STRING);
            $data['nuevaDescripcion'] = filter_input(INPUT_POST, 'nuevaDescripcion', FILTER_SANITIZE_STRING);
            $data['nuevaTecnologias'] = filter_input(INPUT_POST, 'nuevaTecnologias', FILTER_SANITIZE_STRING);
            $data['visible'] = filter_input(INPUT_POST, 'visible', FILTER_SANITIZE_STRING);
            $data['usuarioId'] = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

            $titulo = $_POST['nuevoTitulo'];
            $descripcion = $_POST['nuevaDescripcion'];
            $tecnologias = $_POST['nuevaTecnologias'];
            $visible = $_POST['visible'];
            $usuarioId = $_SESSION['usuario']['id'];
            $logo = $_FILES['nuevoLogo'];

            if (isset($logo) && $logo['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $logo['tmp_name'];
                $fileName = $logo['name'];
                $fileSize = $logo['size'];
                $fileType = $logo['type'];

                // Validar el tipo de archivo
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($fileType, $allowedMimeTypes)) {
                    $data['msjErrorLogo'] = 'El archivo debe ser una imagen (JPG, PNG, GIF).';
                    $procesaForm = false;
                } else {
                    // Generar un nombre único para la imagen
                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                    $newFileName =  "Logo_". $data['usuario']['nombre']."_".$data['usuario']['apellidos'] ."_". uniqid('user_') . '.' . $fileExtension;

                    // Ruta donde se almacenará la imagen
                    $uploadFileDir = 'uploads/';
                    $dest_path = $uploadFileDir . $newFileName;

                    // Mover el archivo al directorio de destino
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $data['nuevoLogo'] = $dest_path;
                    } else {
                        $data['msjErrorLogo'] = 'Hubo un problema al subir la imagen.';
                        $procesaForm = false;
                    }
                }
            } else if (isset($logo) && $logo['error'] !== UPLOAD_ERR_NO_FILE) {
                $data['msjErrorLogo'] = 'Hubo un error al subir la imagen.';
                $procesaForm = false;
            } else if (empty($data['nuevoLogo'])) {
                $data['nuevoLogo'] = $data['proyecto'][0]['logo'];
            } 

            if(empty($titulo)){
                $data['nuevoTitulo'] = $data['proyecto'][0]['titulo'];
            } else if(strlen($titulo) > 128){
                $data['msjErrorTitulo'] = 'El título no puede tener más de 128 caracteres';
                $procesaForm = false;
            }

            if(empty($descripcion)){
                $data['nuevaDescripcion'] = $data['proyecto'][0]['descripcion'];
            } else if(strlen($descripcion) > 256){
                $data['msjErrorDescripcion'] = 'La descripción no puede tener más de 256 caracteres';
                $procesaForm = false;
            }

            if(empty($tecnologias)){
                $data['nuevaTecnologias'] = $data['proyecto'][0]['tecnologias'];
            } else if (!preg_match('/^[^,]+(,[^,]+)*$/', $tecnologias)) {
                $data['msjErrorTecnologias'] = 'Error: Las tecnologías deben estar separadas por comas. Ejemplo: "Tec1, Tec2, Tec3...".';
                $procesaForm = false;
            } else if(strlen($tecnologias) > 256){
                $data['msjErrorTecnologias'] = 'Las tecnologías no pueden tener más de 256 caracteres';
                $procesaForm = false;
            }


        }

        if($procesaForm){

            $tecs = implode(',', array_map('trim', explode(',', $tecnologias)));

            $proyectos->setIdP($proyecto);
            $proyectos->setTitulosP($titulo);
            $proyectos->setDescripcionP($descripcion);
            $proyectos->setLogoP($data['nuevoLogo']);
            $proyectos->setTecnologiasP($tecs);
            $proyectos->setVisibleP($visible);
            $proyectos->setUsuarios_idP($usuarioId);
            $proyectos->edit($proyecto);


            header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
            exit;
        } else {
            $this->renderHTML('../app/views/edit_project_view.php', $data);
        }
    }

    public function deleteProjectAction()
    {
        $usuarios = Usuarios::getInstancia();
        $proyectos = Proyectos::getInstancia();

        $usuario = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        $user = $proyectos->getUser($usuario);

        if(empty($_SESSION['usuario']) || $_SESSION['usuario']['id'] != $user[0]['usuarios_id']){
            header("Location: /");
            exit;
        }

        $usuarioData = $proyectos->get($usuario);

        if ($usuarioData && !empty($usuarioData[0]['logo'])) {
            // Verificar que no sea la imagen por defecto antes de borrar
            $defaultPhoto = 'uploads/default.png';
            if ($usuarioData[0]['logo'] !== $defaultPhoto && file_exists($usuarioData[0]['logo'])) {
                unlink($usuarioData[0]['logo']); // Borrar la foto del sistema de archivos
            }
        }

        $proyectos->setUsuarios_idP($_SESSION['usuario']['id']);
        $proyectos->delete($usuario);

        header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
        exit;
    }


}







?>