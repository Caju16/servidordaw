<?php

namespace App\Controllers;
use App\Models\Usuarios;
use App\Models\Trabajos;
use App\Models\Habilidades;
use App\Models\Redes;
use App\Models\Proyectos;
use App\Config\Config;
use App\Config\Navbar;

class PortController extends BaseController
{
    public function ListAction()
    {

        $usuario = Usuarios::getInstancia();
        $trabajos = Trabajos::getInstancia();
        $habilidades = Habilidades::getInstancia();
        $redes = Redes::getInstancia();
        $proyectos = Proyectos::getInstancia();

        $data['id'] =  explode('/', string: $_SERVER['REQUEST_URI'])[3];

        $encontrado = false;
        
        $data['usuariosDisponibles'] = $usuario->getAll();

        foreach($data['usuariosDisponibles'] as $key => $value){
            if($value['id'] == $data['id']){
                $encontrado = true;
            }
        }

        if(!$encontrado){
            header('Location: /');
            exit;
        }
        
        $data['usuario'] = $usuario->get($data['id']);
        $data['trabajos'] = $trabajos->get($data['id']);
        $data['habilidades'] = $habilidades->get($data['id']);
        $data['redes'] = $redes->get($data['id']);
        $data['proyectos'] = $proyectos->get($data['id']);

        $this->renderHTML('../app/views/list_view.php', $data);
    }



    // EDICION DE TRABAJOS

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

        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        $usuario = Usuarios::getInstancia();
        $trabajos = Trabajos::getInstancia();

        $procesaForm = false;

        $trabajo = explode('/', string: $_SERVER['REQUEST_URI'])[4];





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

        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        $trabajos = Trabajos::getInstancia();

        $usuario = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        $trabajos->setUsuarios_idT($_SESSION['usuario']['id']);
        $trabajos->delete($usuario);

        header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
        exit;
    }




    // EDICIÓN DE PROYECTOS

    public function createProjectAction()
    {

        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        $usuario = Usuarios::getInstancia();
        $proyectos = Proyectos::getInstancia();

        $procesaForm = false;

        $data['usuario'] = $usuario->get($_SESSION['usuario']['id']);

        $data['titulo'] = $data['descripcion'] = $data['logo'] = $data['tecnologias'] = $data['visible'] = '';
        $data['msjErrorTitulo'] = $data['msjErrorDescripcion'] = $data['msjErrorLogo'] = $data['msjErrorTecnologias'] = '';

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

    public function editProjectAction()
    {

        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }
        
        $proyectos = Proyectos::getInstancia();
        $usuario = Usuarios::getInstancia();

        $proyecto = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        $data['proyecto'] = $proyectos->get($proyecto);
        $data['usuario'] = $usuario->get($_SESSION['usuario']['id']);

        $data['nuevoTitulo'] = $data['nuevaDescripcion'] = $data['nuevoLogo'] = $data['nuevaTecnologias'] = $data['visible'] = '';
        $data['msjErrorTitulo'] = $data['msjErrorDescripcion'] = $data['msjErrorTecnologias'] = $data['msjErrorLogo'] = '';

        $procesaForm = false;

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
        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        $proyectos = Proyectos::getInstancia();

        $usuario = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        $proyectos->setUsuarios_idP($_SESSION['usuario']['id']);
        $proyectos->delete($usuario);

        header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
        exit;
    }





    // EDICIÓN DE HABILIDADES

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

        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        $usuario = Usuarios::getInstancia();
        $habilidad = Habilidades::getInstancia();

        $procesaForm = false;

        $habilidadId = explode('/', string: $_SERVER['REQUEST_URI'])[4];

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
            $habilidad->edit($habilidadId);


            header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
            exit;
        } else {
            $this->renderHTML('../app/views/edit_skill_view.php', $data);
        }
    }

    public function deleteSkillAction()
    {
        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        $habilidad = Habilidades::getInstancia();

        $usuario = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        $habilidad->setUsuarios_idS($_SESSION['usuario']['id']);
        $habilidad->delete($usuario);

        header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
        exit;
    }








    // EDICIÓN DE REDES SOCIALES

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

        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        // $usuario = Usuarios::getInstancia();
        $redes = Redes::getInstancia();

        $procesaForm = false;

        $rrss = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        // $data['usuario'] = $usuario->get($_SESSION['usuario']['id']);

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
            $redes->edit($id);

            header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
            exit;
        } else {
            $this->renderHTML('../app/views/edit_rrss_view.php', $data);
        }
    }

    public function deleteRRSSAction()
    {

        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        $redes = Redes::getInstancia();

        $usuario = explode('/', string: $_SERVER['REQUEST_URI'])[4];

        $redes->setUsuarios_idR($_SESSION['usuario']['id']);
        $redes->delete($usuario);

        header('Location: /portfolios/list/' . $_SESSION['usuario']['id']);
        exit;
    }




}
?>