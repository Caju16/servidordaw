<?php

namespace App\Controllers;
use App\Models\Usuarios;
use App\Config\Config;
use App\Core\EmailSender;

class UserController extends BaseController
{
    public function IndexAction()
    {
        $lprocesaFormulario = false; // Flag para saber si hay que procesar el formulario o no

        $data['msjErrorNombre'] = $data['ErrorNotFound'] = $data['EstadoLogin'] = ''; // Inicializamos las variables de error
        $data['userName'] = $data['userLastName'] = $data['encontrado'] = []; // Inicializamos la variable username y encontrado como array

        $usuario = Usuarios::getInstancia(); // Instanciamos la clase Usuarios

        $data['usuarios'] = $usuario->getAll(); // Obtenemos todos los usuarios

        $usuarioSesion = $_SESSION['usuario'] ?? null; // Comprobamos si hay un usuario en sesión

        $usuariosFiltrados = [];
        
        foreach ($data['usuarios'] as $u) {
            if (($usuarioSesion && $u['id'] == $usuarioSesion['id']) || $u['visible']) {
                $usuariosFiltrados[] = $u;
            }
        }
        
        $data['usuarios'] = $usuariosFiltrados;


        if(isset($_POST['nombre']) || isset($_POST['apellidos'])){

            // Si se ha enviado el formulario, guardamos las variables
            
            $data['userName'] = $_POST['nombre']; 
            $data['userLastName'] = $_POST['apellidos']; 
        } else {
            // Si no se ha enviado el formulario, las variables estarán vacías

            $data['userName'] = ''; 
            $data['userLastName'] = ''; 
        }

        if (!empty($_POST)) {
            $lprocesaFormulario = true; // Si se ha enviado el formulario, cambiamos el flag a true

            $data['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING); // Saneamos las variables
            $data['apellidos'] = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING); 

            // Capitalizamos el texto

            $data['nombre'] = Config::capitalizarTexto($data['nombre']);
            $data['apellidos'] = Config::capitalizarTexto($data['apellidos']);


            $nombreSinTildes = Config::quitarTildes($data['nombre']);
            $apellidosSinTildes = Config::quitarTildes($data['apellidos']);


            if (empty($data['nombre'])) {
                $lprocesaFormulario = false;
                $data['msjErrorNombre'] = 'El campo nombre no puede estar vacío';
            }
      
            if ($lprocesaFormulario) {
                // Recorremos los usuarios y si el nombre coincide con el nombre introducido, guardamos el usuario en la variable encontrado

                foreach($data['usuarios'] as $item){

                    $nombreUsuarioSinTildes = Config::quitarTildes($item['nombre']);
                    $apellidoUsuarioSinTildes = Config::quitarTildes($item['apellidos']);

                    // Si se proporciona el nombre y los apellidos, buscamos el registro que coincida con ambos

                    if (!empty($data['apellidos'])) {
                        if ($nombreSinTildes == $nombreUsuarioSinTildes && $apellidosSinTildes == $apellidoUsuarioSinTildes) {
                            $data['encontrado'][] = $usuario->get($item['id']);
                        }
                    } else {
                        // Si sólo se proporciona el nombre, buscamos todos los registros que coincidan con él
                        if ($nombreSinTildes == $nombreUsuarioSinTildes) {
                            $data['encontrado'][] = $usuario->get($item['id']);
                        }
                    }

                }

                // Si no se ha encontrado ningún usuario, mostramos un mensaje de error
                
                if (empty($data['encontrado'])) {
                    $data['ErrorNotFound'] = 'No se ha encontrado el usuario';
                }  
            } 
        } 

        $this->renderHTML('../app/views/public_view.php', $data);
    }

    public function LoginAction()
    {

        $usuario = Usuarios::getInstancia(); 

        $lprocesaFormulario = false;
        $data['email'] = $data['password'] = '';
        $data['msjErrorEmail'] = $data['msjErrorPassword'] = $data['EstadoLogin'] = '';
        
        if(!empty($_POST)){

            $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $data['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

            $lprocesaFormulario = true;

            if (empty($data['email'])) {
                $lprocesaFormulario = false;
                $data['msjErrorEmail'] = 'El campo email no puede estar vacío';
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['msjErrorEmail'] = "El formato del email no es valido";
                $lprocesaFormulario = false;
            }

            if (empty($data['password'])) {
                $lprocesaFormulario = false;
                $data['msjErrorPassword'] = 'El campo password no puede estar vacío';
            }

        }

        if ($lprocesaFormulario) {
            $data['usuarios'] = $usuario->login($data['email'], $data['password']); 
            
            if (empty($data['usuarios'])) {
                $data['EstadoLogin'] = 'El email o la contraseña no son correctos';
                $this->renderHTML('../app/views/login_view.php', $data);
            } else {

                $_SESSION['usuario'] = $data['usuarios'];
                header("Location: /usuario/system");
                exit;
            }

        } else {
            $this->renderHTML('../app/views/login_view.php', $data);
        }

    }

    public function RegisterAction()
    {

        $usuario = Usuarios::getInstancia(); 

        $lprocesaFormulario = false;
        $data['nombre'] = $data['apellidos'] = $data['email'] = $data['password']= $data['categoria']  = $data['resumen'] = $data['pic'] = $data['visible'] = '';
        $data['msjErrorEmail'] = $data['msjErrorPassword'] = $data['msjErrorNombre'] = $data['msjErrorApellidos'] = $data['msjErrorCategoria'] = $data['msjErrorResumen'] = $data['msjErrorPic'] = $data['EstadoRegistro'] = '';

        $data['pic'] = 'uploads/default.png';


        if(!empty($_POST)){

            $data['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $data['apellidos'] = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING);
            $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $data['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $data['categoria'] = filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_STRING);
            $data['resumen'] = filter_input(INPUT_POST, 'resumen', FILTER_SANITIZE_STRING);

            $rb = random_bytes(32);
            $token  = base64_encode($rb);
            $secureToken = uniqid('',true) . $token;
            
            $data['token'] = $secureToken;
            
            $data['nombre'] = Config::capitalizarTexto($data['nombre']);
            $data['apellidos'] = Config::capitalizarTexto($data['apellidos']);
            
            $lprocesaFormulario = true;

            if (isset($_FILES['pic']) && $_FILES['pic']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['pic']['tmp_name'];
                $fileName = $_FILES['pic']['name'];
                $fileSize = $_FILES['pic']['size'];
                $fileType = $_FILES['pic']['type'];
    
                // Validar el tipo de archivo
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($fileType, $allowedMimeTypes)) {
                    $data['msjErrorPic'] = 'El archivo debe ser una imagen (JPG, PNG, GIF).';
                    $lprocesaFormulario = false;
                } else {
                    // Generar un nombre único para la imagen
                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                    $newFileName =  $data['nombre'].$data['apellidos']."_". uniqid('user_') . '.' . $fileExtension;
    
                    // Ruta donde se almacenará la imagen
                    $uploadFileDir = 'uploads/';
                    $dest_path = $uploadFileDir . $newFileName;
    
                    // Mover el archivo al directorio de destino
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $data['pic'] = $dest_path;
                    } else {
                        $data['msjErrorPic'] = 'Hubo un problema al subir la imagen.';
                        $lprocesaFormulario = false;
                    }
                }
            } else if (isset($_FILES['pic']) && $_FILES['pic']['error'] !== UPLOAD_ERR_NO_FILE) {
                $data['msjErrorPic'] = 'Hubo un error al subir la imagen.';
                $lprocesaFormulario = false;
            }



            // Si se ha marcado la casilla, guardamos un 1, si no, un 0

            if (isset($_POST['visible'])) {
                $data['visible'] = (int)$_POST['visible'];
            } else {
                $data['visible'] = 0;
            }


            if (empty($data['nombre'])) {
                $lprocesaFormulario = false;
                $data['msjErrorNombre'] = 'El campo nombre no puede estar vacío';
            } else if (strlen($data['nombre']) > 128) {
                $data['msjErrorNombre'] = 'El nombre no puede tener más de 128 caracteres';
                $lprocesaFormulario = false;
            }
    
            if (empty($data['apellidos'])) {
                $lprocesaFormulario = false;
                $data['msjErrorApellidos'] = 'El campo apellidos no puede estar vacío';
            } else if (strlen($data['apellidos']) > 128) {
                $data['msjErrorApellidos'] = 'Los apellidos no pueden tener más de 128 caracteres';
                $lprocesaFormulario = false;
            }

            if (empty($data['email'])) {
                $lprocesaFormulario = false;
                $data['msjErrorEmail'] = 'El campo email no puede estar vacío';
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
                $data['msjErrorEmail'] = "El formato del email no es valido";
                $lprocesaFormulario = false;
            } else if ($usuario->emailExists($data['email'])) {
                $data['msjErrorEmail'] = "El correo ya está registrado.";
                $lprocesaFormulario = false;
            } else if (strlen($data['email']) > 64) {
                $data['msjErrorEmail'] = 'El email no puede tener más de 64 caracteres';
                $lprocesaFormulario = false;
            }

            if (empty($data['password'])) {
                $lprocesaFormulario = false;
                $data['msjErrorPassword'] = 'El campo password no puede estar vacío';
            } else if (strlen($data['password']) > 64) {
                $data['msjErrorPassword'] = 'La contraseña no puede tener más de 64 caracteres';
                $lprocesaFormulario = false;
            }

            if (empty($data['categoria'])) {
                $lprocesaFormulario = false;
                $data['msjErrorCategoria'] = 'El campo categoría no puede estar vacío';
            } else if (strlen($data['categoria']) > 64) {
                $data['msjErrorCategoria'] = 'La categoría no puede tener más de 64 caracteres';
                $lprocesaFormulario = false;
            }
    
            if (empty($data['resumen'])) {
                $lprocesaFormulario = false;
                $data['msjErrorResumen'] = 'El campo resumen no puede estar vacío';
            } else if (strlen($data['resumen']) > 1024) {
                $data['msjErrorResumen'] = 'El resumen no puede tener más de 1024 caracteres';
                $lprocesaFormulario = false;
            }

            // if (empty($data['pic'])) {
            //     $lprocesaFormulario = false;
            //     $data['msjErrorPic'] = 'El campo foto no puede estar vacío';
            // }

        }

        
        
        if ($lprocesaFormulario) {

            $usuario->setNombre($data['nombre']);
            $usuario->setApellidos($data['apellidos']);
            $usuario->setEmail($data['email']);
            $usuario->setPassword($data['password']);
            $usuario->setCategoriaProfesional($data['categoria']);
            $usuario->setResumenPerfil($data['resumen']);
            $usuario->setFoto($data['pic']);
            $usuario->setVisible($data['visible']);
            $usuario->setToken($data['token']);
            $usuario->setFechaCreacionToken(date('Y-m-d H:i:s'));
            $usuario->setCuentaActiva(0); 
            $usuario->set();
            
            $emailSender = new EmailSender;
            $emailSender->sendConfirmationMail($data['nombre'], $data['apellidos'], $data['email'], $data['token']);

            $this->renderHTML('../app/views/success_view.php', $data);
        } else {
            $this->renderHTML('../app/views/register_view.php', $data);
        }

    }

    public function editUserAction(){

        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        $usuarios = Usuarios::getInstancia();

        $lprocesaFormulario = false;
        $data['nuevoNombre'] = $data['nuevosApellidos'] = $data['nuevoEmail'] = $data['nuevaPassword'] = $data['nuevaCategoria'] = $data['nuevoResumen'] = $data['nuevaPic'] = $data['visible'] = '';
        $data['msjErrorNombre'] = $data['msjErrorApellidos'] = $data['msjErrorEmail'] = $data['msjErrorPassword'] = $data['msjErrorCategoria'] = $data['msjErrorResumen'] = $data['msjErrorPic'] = $data['EstadoRegistro'] = '';

        $data['usuario'] = $usuarios->get($_SESSION['usuario']['id']);

        if(!empty($_POST)){

            $data['nuevoNombre'] = filter_input(INPUT_POST, 'nuevoNombre', FILTER_SANITIZE_STRING);
            $data['nuevosApellidos'] = filter_input(INPUT_POST, 'nuevosApellidos', FILTER_SANITIZE_STRING);
            $data['nuevoEmail'] = filter_input(INPUT_POST, 'nuevoEmail', FILTER_SANITIZE_EMAIL);
            $data['nuevaPassword'] = filter_input(INPUT_POST, 'nuevaPassword', FILTER_SANITIZE_STRING);
            $data['nuevaCategoria'] = filter_input(INPUT_POST, 'nuevaCategoria', FILTER_SANITIZE_STRING);
            $data['nuevoResumen'] = filter_input(INPUT_POST, 'nuevoResumen', FILTER_SANITIZE_STRING);

            $rb = random_bytes(32);
            $token  = base64_encode($rb);
            $secureToken = uniqid('',true) . $token;
            
            $data['token'] = $secureToken;
            
            $data['nuevoNombre'] = Config::capitalizarTexto($data['nuevoNombre']);
            $data['nuevosApellidos'] = Config::capitalizarTexto($data['nuevosApellidos']);
            
            $lprocesaFormulario = true;

            if (isset($_FILES['nuevaPic']) && $_FILES['nuevaPic']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['nuevaPic']['tmp_name'];
                $fileName = $_FILES['nuevaPic']['name'];
                $fileSize = $_FILES['nuevaPic']['size'];
                $fileType = $_FILES['nuevaPic']['type'];
    
                // Validar el tipo de archivo
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!in_array($fileType, $allowedMimeTypes)) {
                    $data['msjErrorPic'] = 'El archivo debe ser una imagen (JPG, PNG, GIF).';
                    $lprocesaFormulario = false;
                } else {
                    // Generar un nombre único para la imagen
                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                    $newFileName =  $data['nuevoNombre'].$data['nuevosApellidos']."_". uniqid('user_') . '.' . $fileExtension;
    
                    // Ruta donde se almacenará la imagen
                    $uploadFileDir = 'uploads/';
                    $dest_path = $uploadFileDir . $newFileName;
    
                    // Mover el archivo al directorio de destino
                    if (move_uploaded_file($fileTmpPath, $dest_path)) {
                        $data['nuevaPic'] = $dest_path;
                    } else {
                        $data['msjErrorPic'] = 'Hubo un problema al subir la imagen.';
                        $lprocesaFormulario = false;
                    }
                }
            } else if (isset($_FILES['nuevaPic']) && $_FILES['nuevaPic']['error'] !== UPLOAD_ERR_NO_FILE) {
                $data['msjErrorPic'] = 'Hubo un error al subir la imagen.';
                $lprocesaFormulario = false;
            }


            if (isset($_POST['visible'])) {
                $data['visible'] = (int)$_POST['visible'];
            } else {
                $data['visible'] = 0;
            }


            if (empty($data['nuevoNombre'])) {
                $data['nuevoNombre'] = $data['usuario']['nombre'];
            } else if (strlen($data['nuevoNombre']) > 128) {
                $data['msjErrorNombre'] = 'El nombre no puede tener más de 128 caracteres';
                $lprocesaFormulario = false;
            }
    
            if (empty($data['nuevosApellidos'])) {
                $data['nuevosApellidos'] = $data['usuario']['apellidos'];
            } else if (strlen($data['nuevosApellidos']) > 128) {
                $data['msjErrorApellidos'] = 'Los apellidos no pueden tener más de 128 caracteres';
                $lprocesaFormulario = false;
            }

            if (empty($data['nuevoEmail'])) {
                $lprocesaFormulario = false;
                $data['msjErrorEmail'] = 'El campo email no puede estar vacío';
            } else if (!filter_var($data['nuevoEmail'], FILTER_VALIDATE_EMAIL)){
                $data['msjErrorEmail'] = "El formato del email no es valido";
                $lprocesaFormulario = false;
            } else if (!$usuarios->isEmailValid($data['nuevoEmail'])) {
                $data['msjErrorEmail'] = "El correo ya está registrado.";
                $lprocesaFormulario = false;
            } else if (strlen($data['nuevoEmail']) > 64) {
                $data['msjErrorEmail'] = 'El email no puede tener más de 64 caracteres';
                $lprocesaFormulario = false;
            }

            if (empty($data['nuevaPassword'])) {
                $data['nuevaPassword'] = $data['usuario']['password'];
            } else if (strlen($data['nuevaPassword']) > 64) {
                $data['msjErrorPassword'] = 'La contraseña no puede tener más de 64 caracteres';
                $lprocesaFormulario = false;
            }

            if (empty($data['nuevaCategoria'])) {
                $data['nuevaCategoria'] = $data['usuario']['categoria_profesional'];
            } else if (strlen($data['nuevaCategoria']) > 64) {
                $data['msjErrorCategoria'] = 'La categoría profesional no puede tener más de 64 caracteres';
                $lprocesaFormulario = false;
            }
    
            if (empty($data['nuevoResumen'])) {
                $data['nuevoResumen'] = $data['usuario']['resumen_perfil'];
            } else if (strlen($data['nuevoResumen']) > 1024) {
                $data['msjErrorResumen'] = 'El resumen no puede tener más de 1024 caracteres';
                $lprocesaFormulario = false;
            }
    
            if (empty($data['nuevaPic'])) {
                $data['nuevaPic'] = $data['usuario']['foto'];
            }
        }

        if($lprocesaFormulario){
            $usuarios->setNombre($data['nuevoNombre']);
            $usuarios->setApellidos($data['nuevosApellidos']);
            $usuarios->setEmail($data['nuevoEmail']);
            $usuarios->setPassword($data['nuevaPassword']);
            $usuarios->setCategoriaProfesional($data['nuevaCategoria']);
            $usuarios->setResumenPerfil($data['nuevoResumen']);
            $usuarios->setFoto($data['nuevaPic']);
            $usuarios->setVisible($data['visible']);
            $usuarios->edit($_SESSION['usuario']['id']);
            $data['EstadoRegistro'] = 'Usuario actualizado con éxito';

            header("Location: /");

        } else {
            $this->renderHTML('../app/views/edit_user_view.php', $data);
        }


    }

    public function deleteUserAction(){
        
        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }

        $usuarios = Usuarios::getInstancia();

        $usuarios->delete($_SESSION['usuario']['id']);

        session_start();

        session_unset();

        session_destroy();

        header("Location: /");
    }

    public function SystemAction()
    {
        
        if(empty($_SESSION['usuario'])){
            header("Location: /");
            exit;
        }


        $this->renderHTML('../app/views/system_view.php');
    }

    public function verifyUserAction()
    {
        // Obtiene el token de la URL
        $token = explode('/', string: $_SERVER['REQUEST_URI']);
        // Elimina los dos primeros elementos del array $token y los une en una cadena separada por / y lo almacena en la variable $token
        $token = array_slice($token, 2);
        $token = implode('/', $token);

        // Crea una instancia de la clase Usuarios y verifica el token
        $claseUsuario = Usuarios::getInstancia();
        $claseUsuario->verificarToken($token);
        
        // var_dump($claseUsuario);die();

        // Si el token es válido, muestra un mensaje de éxito y redirige a la página principal
        if ($claseUsuario->getMensaje() == 'Usuario verificado') {
            // $_SESSION['autenticado'] = true;
            // $_SESSION['usuario'] = $claseUsuario->nombre;
            //     $this->cerrarSesionAction();     
            header('Location: /');
        } else {
            echo "<h2>" . $claseUsuario->getMensaje() . "</h2>";
            header('Location: /');
        }
    }


    

    public function LogoutAction()
    {
        session_start();

        session_unset();

        session_destroy();

        header("Location: /");
    }


}
?>