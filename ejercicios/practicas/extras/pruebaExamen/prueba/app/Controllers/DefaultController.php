<?php

    namespace App\Controllers;

    use App\Models\Usuarios;
    use App\Models\Notas;

    class DefaultController extends BaseController
    {
        public function IndexAction()
        {
            $data = [];
            $data['email'] = $data['password'] = $data['repassword'] = $data['nombre'] = $data['apellidos'] = $data['resumen_perfil'] = $data['foto'] = '';
            $data['msjErrorEmail'] = $data['msjErrorPassword'] = $data['msjErrorNombre'] = $data['msjErrorApellidos'] = $data['msjErrorRepassword'] = $data['msjErrorFoto'] = '';
            $data['msjErrorRegisterEmail'] = $data['msjErrorRegisterPassword'] = $data['msjErrorResumenPerfil'] = $data['msjErrorCaptcha'] = '';
            $data['registerPassword'] = $data['registerEmail'] = '';
            $data['pic'] = '';
            $data['num1'] = $data['num2'] = $data['resultado'] = '';
            $lProcesaFormulario = false;


            $usuarios = Usuarios::getInstancia();
            $notas = Notas::getInstancia();

            $data['usuarios'] = $usuarios->getAll();

            foreach($data['usuarios'] as $usuario) {
                $data['notas'][$usuario['id']] = $notas->getNota($usuario['id']);
            }

            // SOLO GENERAR EL CAPTCHA SI NO EXISTE EN LA SESIÓN
            if (!isset($_SESSION['num1']) || !isset($_SESSION['num2'])) {
                $_SESSION['num1'] = rand(1, 10);
                $_SESSION['num2'] = rand(1, 10);
                $_SESSION['captcha'] = $_SESSION['num1'] + $_SESSION['num2'];
            }

            // Asignar los valores de la sesión al array de datos
            $data['num1'] = $_SESSION['num1'];
            $data['num2'] = $_SESSION['num2'];

            if(isset($_POST['enviar'])) {
                $data['email'] = $_POST['email'];
                $data['password'] = $_POST['password'];
                $lProcesaFormulario = true;

                if($data['email'] == '') {
                    $lProcesaFormulario = false;
                    $data['msjErrorEmail'] = "Debes rellenar el email";
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

            if(isset($_POST['register'])){
                $data['nombre'] = $_POST['nombre'];
                $data['apellidos'] = $_POST['apellidos'];
                $data['registerEmail'] = $_POST['email'];
                $data['registerPassword'] = $_POST['password'];
                $data['repassword'] = $_POST['repassword'];
                $data['resumen_perfil'] = $_POST['resumen_perfil'];
                $lProcesaFormulario = true;

                if($data['nombre'] == '') {
                    $lProcesaFormulario = false;
                    $data['msjErrorNombre'] = "Debes rellenar el nombre";
                } 

                if($data['apellidos'] == '') {
                    $lProcesaFormulario = false;
                    $data['msjErrorApellidos'] = "Debes rellenar los apellidos";
                } 

                if($data['registerEmail'] == '') {
                    $lProcesaFormulario = false;
                    $data['msjErrorRegisterEmail'] = "Debes rellenar el email";
                } 

                if($data['registerPassword'] == '') {
                    $lProcesaFormulario = false;
                    $data['msjErrorRegisterPassword'] = "Debes rellenar la contraseña";
                } 

                if($data['repassword'] == '') {
                    $lProcesaFormulario = false;
                    $data['msjErrorRepassword'] = "Debes rellenar la contraseña";
                } 

                if($data['registerPassword'] != $data['repassword']) {
                    $lProcesaFormulario = false;
                    $data['msjErrorRepassword'] = "Las contraseñas no coinciden";
                } 

                if($data['resumen_perfil'] == '') {
                    $lProcesaFormulario = false;
                    $data['msjErrorResumenPerfil'] = "Debes rellenar el resumen del perfil";
                } 

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
                    $data['msjErrorFoto'] = 'Hubo un error al subir la imagen.';
                    $lprocesaFormulario = false;
                }

                if($data['registerPassword'] != $data['repassword']) {
                    $lProcesaFormulario = false;
                    $data['msjErrorRepassword'] = "Las contraseñas no coinciden";
                } 
            }

            if($lProcesaFormulario){
                if(isset($_POST['enviar'])){
                    $usuario = $usuarios->login($data['email'], $data['password']);

                    if($usuario) {
                        $_SESSION['user'] = $usuario;
                        $_SESSION['perfil'] = 'user';
                        header('Location: /sistema');
                    } else {
                        $data['msjErrorPassword'] = "Usuario o contraseña incorrectos";
                        $this->renderHTML('../app/views/index_view.php', $data);
                    }
                }

                else if(isset($_POST['register'])){

                    $rb = random_bytes(32);
                    $token  = base64_encode($rb);
                    $secureToken = uniqid('',true) . $token;

                    $usuarios->setNombre($data['nombre']);
                    $usuarios->setApellidos($data['apellidos']);
                    $usuarios->setEmail($data['registerEmail']);
                    $usuarios->setPassword($data['registerPassword']);
                    $usuarios->setResumenPerfil($data['resumen_perfil']);
                    $usuarios->setFoto($data['pic']);
                    $usuarios->setToken($secureToken);
                    $usuarios->setFechaCreacionToken(date('Y-m-d H:i:s'));
                    $usuarios->setVisible(1);
                    $usuarios->setCuentaActiva(1);

                    $usuario = $usuarios->set();
                    
                    
                    header('Location: /');
                }
            } else {
                $this->renderHTML('../app/views/index_view.php', $data);
            }

            if(isset($_SESSION['usuario'])) {
                $this->renderHTML('../app/views/index_view.php', $data);
                // var_dump($_SESSION);
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