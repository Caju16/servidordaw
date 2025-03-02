<?php

namespace App\Controllers;

class UserController extends BaseController
{

    public function loginAction()
    {
        
        ?>

        <script>
            if (localStorage.getItem("token")) {
                window.location.href = "/";
            }
        </script>

        <?php


        $lprocesaFormulario = false;
        $data['email'] = $data['password'] = '';
        $data['msjErrorEmail'] = $data['msjErrorPassword'] = $data['EstadoLogin'] = '';

        // var_dump($_POST);
        
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
            // $data['usuarios'] = $usuario->login($data['email'], $data['password']); 

            ?>

            <script>
                
                const email = "<?php echo $data['email']; ?>";
                const password = "<?php echo $data['password']; ?>";
                
                    const loginData = { email, password };
                    console.log("Enviando JSON:", JSON.stringify(loginData));
                    fetch("http://apicentros.local/api/login", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(loginData)
                    
                })
                .then(response => {
                    console.log("Respuesta completa:", response);
                    return response.json();
                })
                .then(data => {
                    if (data.jwt) {
                        localStorage.setItem("token", data.jwt);
                        window.location.href = "/";
                    } else {
                        alert("Credenciales incorrectas");
                    }
                })
                .catch(error => console.error("Error:", error));

            </script>

            <?php
            
            if (empty($data['usuarios'])) {
                $this->renderHTML('../app/views/login_view.php', $data);
            } else {

                // si se logea


            }

        } else {
            $this->renderHTML('../app/views/login_view.php', $data);
        }

    }


    public function registerAction()
    {
        ?>

        <script>
            if (localStorage.getItem("token")) {
                window.location.href = "/";
            }
        </script>

        <?php
        
        $lprocesaFormulario = false;
        $data['nombre'] = $data['email'] = $data['password'] = $data['repassword'] = '';
        $data['msjErrorNombre'] = $data['msjErrorEmail'] = $data['msjErrorPassword'] = $data['msjErrorRepassword'] = '';

        if (!empty($_POST)) {
            $data['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $data['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $data['repassword'] = filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_STRING);

            $lprocesaFormulario = true;

            if (empty($data['nombre'])) {
                $lprocesaFormulario = false;
                $data['msjErrorNombre'] = 'El campo nombre no puede estar vacío';
            }

            if (empty($data['email'])) {
                $lprocesaFormulario = false;
                $data['msjErrorEmail'] = 'El campo email no puede estar vacío';
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['msjErrorEmail'] = "El formato del email no es valido";
                $lprocesaFormulario = false;
            }

            if (empty($data['password'])) {
                $lprocesaFormulario = false;
                $data['msjErrorPassword'] = 'El campo password no puede estar vacío';
            }

            if (empty($data['repassword'])) {
                $lprocesaFormulario = false;
                $data['msjErrorRepassword'] = 'El campo repetir password no puede estar vacío';
            } else if ($data['password'] !== $data['repassword']) {
                $lprocesaFormulario = false;
                $data['msjErrorRepassword'] = 'Las contraseñas no coinciden';
            }
        }

        if ($lprocesaFormulario) {
            ?>

            <script>
                const nombre = "<?php echo $data['nombre']; ?>";
                const email = "<?php echo $data['email']; ?>";
                const password = "<?php echo $data['password']; ?>";
                
                const registerData = { nombre, email, password };
                console.log("Enviando JSON:", JSON.stringify(registerData));
                fetch("http://apicentros.local/api/register", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(registerData)
                })
                .then(response => {
                    console.log("Respuesta completa:", response);
                    return response.json();
                })
                .then(data => {
                    console.log("Datos recibidos:", data);
                    if (data.message === "Usuario creado con éxito") {
                        alert("Registro exitoso. Por favor, inicie sesión.");
                        window.location.href = "/usuario/login";
                    } else {
                        alert("Error en el registro: " + data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
            </script>

            <?php
            
            if (empty($data['usuarios'])) {
                $this->renderHTML('../app/views/register_view.php', $data);
            } else {
                // si se registra
            }

        } else {
            $this->renderHTML('../app/views/register_view.php', $data);
        }
    }

    public function editUserAction()
    {

        ?>

        <script>

            const token = localStorage.getItem("token");
            if (!token) {
                window.location.href = "/usuario/login";
            }

            const decodedToken = jwt_decode(token);
            const userId = decodedToken.data[0];
            const userEmail = decodedToken.data.usuario;

            

            fetch(`http://apicentros.local/api/user?id=${userId}}`, {
                method: "GET",
                headers: { "Authorization": `Bearer ${token}` },
            })
            .then(response => response.json())
            .then(data => {

                console.log("Datos recibidos:", data);

                if (data) {
                    document.getElementById("nombre").value = data.nombre;
                    document.getElementById("email").value = data.email;
                    document.getElementById("password").value = data.password;
                    document.getElementById("repassword").value = data.password;
                } else {
                    alert("Error al obtener los datos del usuario.");
                }
            })
            .catch(error => console.error("Error:", error));
        </script>
    
        <?php

        $lprocesaFormulario = false;
        $data['nombre'] = $data['email'] = $data['password'] = $data['repassword'] = '';
        $data['msjErrorNombre'] = $data['msjErrorEmail'] = $data['msjErrorPassword'] = $data['msjErrorRepassword'] = '';

        if (!empty($_POST)) {
            $data['nombre'] = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
            $data['email'] = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
            $data['password'] = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
            $data['repassword'] = filter_input(INPUT_POST, 'repassword', FILTER_SANITIZE_STRING);

            $lprocesaFormulario = true;

            if (empty($data['nombre'])) {
                $lprocesaFormulario = false;
                $data['msjErrorNombre'] = 'El campo nombre no puede estar vacío';
            }

            if (empty($data['email'])) {
                $lprocesaFormulario = false;
                $data['msjErrorEmail'] = 'El campo email no puede estar vacío';
            } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['msjErrorEmail'] = "El formato del email no es valido";
                $lprocesaFormulario = false;
            }

            if (empty($data['password'])) {
                $lprocesaFormulario = false;
                $data['msjErrorPassword'] = 'El campo password no puede estar vacío';
            }

            if (empty($data['repassword'])) {
                $lprocesaFormulario = false;
                $data['msjErrorRepassword'] = 'El campo repetir password no puede estar vacío';
            } else if ($data['password'] !== $data['repassword']) {
                $lprocesaFormulario = false;
                $data['msjErrorRepassword'] = 'Las contraseñas no coinciden';
            }
        }

        if($lprocesaFormulario){
           ?>

            <script>

            console.log("Token decodificado:", userId, userEmail);

            fetch(`http://apicentros.local/api/user?id=${userId}}`, {
                method: "GET",
                headers: { "Authorization": `Bearer ${token}` },
            })
            .then(response => response.json())
            .then(data => {

                if (data) {
                    if(userEmail == data.email){
                        userEmail = data.email;
                    } else {
                        const email = "<?php echo $data['email']; ?>";
                    }
                } else {
                    alert("Error al obtener los datos del usuario.");
                }
            })
            .catch(error => console.error("Error:", error));

                const nombre = "<?php echo $data['nombre']; ?>";
                const email = "<?php echo $data['email']; ?>";
                const password = "<?php echo $data['password']; ?>";

                

                const userData = { nombre, email, password };

                fetch("http://apicentros.local/api/user", {
                    method: "PUT",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": `Bearer ${token}`
                    },
                    body: JSON.stringify(userData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message === "Usuario actualizado con éxito") {
                        alert("Usuario actualizado con éxito.");
                        window.location.href = "/";
                    } else {
                        alert("Error al actualizar el usuario: " + data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
            </script>

            <?php
        }


        $this->renderHTML('../app/views/user_edit_view.php', $data);
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/jwt-decode/build/jwt-decode.min.js"></script>
