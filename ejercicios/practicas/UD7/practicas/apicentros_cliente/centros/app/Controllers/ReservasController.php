<?php

namespace App\Controllers;

class ReservasController extends BaseController
{

    public function indexAction()
    {
        $lProcesaFormulario = false;
        $data['nombre'] = $data['telefono'] = $data['email'] = $data['instalacion'] = $data['fecha_hora_inicio'] = $data['fecha_hora_final'] = $data['estado'] = '';
        $data['msjErrorNombre'] = $data['msjErrorTelefono'] = $data['msjErrorEmail'] = $data['msjErrorInstalacion'] = $data['msjErrorFechaHoraInicio'] = $data['msjErrorFechaHoraFinal'] = $data['msjErrorEstado'] = '';
       
        ?>
        
        <script>
            function cargarInstalaciones(selectElement = null) {
            fetch("http://apicentros.local/api/instalaciones")
                .then(response => response.json())
                .then(instalaciones => {
                    if (selectElement) {
                        instalaciones.forEach(instalacion => {
                            let option = document.createElement("option");
                            option.value = instalacion.id;
                            option.textContent = instalacion.nombre;
                            selectElement.appendChild(option);
                        });
                    } 
                })
                .catch(error => console.error("Error cargando instalaciones:", error));
            }

            const token = localStorage.getItem("token");
            if (!token) {
                window.location.href = "/usuario/login";
            }

            const decodedToken = jwt_decode(token);
            const userId = decodedToken.data[0];

        </script>
        
        
        <?php

         if(!empty($_POST)){
            
            $lProcesaFormulario = true;
            
            $data['nombre'] = $_POST['nombre'];
            $data['telefono'] = $_POST['telefono'];
            $data['email'] = $_POST['email'];
            $data['instalacion'] = $_POST['instalacion'];
            $data['fecha_hora_inicio'] = $_POST['fecha_hora_inicio'];
            $data['fecha_hora_final'] = $_POST['fecha_hora_final'];
            $data['estado'] = $_POST['estado'];
            
            if(empty($data['nombre'])){
                $data['msjErrorNombre'] = 'El nombre es obligatorio';
                $lProcesaFormulario = false;
            }
            
            if(empty($data['telefono'])){
                $data['msjErrorTelefono'] = 'El teléfono es obligatorio';
                $lProcesaFormulario = false;
            }
            
            if(empty($data['email'])){
                $data['msjErrorEmail'] = 'El email es obligatorio';
                $lProcesaFormulario = false;
            }
            
            if(empty($data['instalacion'])){
                $data['msjErrorInstalacion'] = 'La instalación es obligatoria';
                $lProcesaFormulario = false;
            }
            
            if(empty($data['fecha_hora_inicio'])){
                $data['msjErrorFechaHoraInicio'] = 'La fecha y hora de inicio es obligatoria';
                $lProcesaFormulario = false;
            }
            
            if(empty($data['fecha_hora_final'])){
                $data['msjErrorFechaHoraFinal'] = 'La fecha y hora de final es obligatoria';
                $lProcesaFormulario = false;
            }
            
            if(empty($data['estado'])){
                $data['msjErrorEstado'] = 'El estado es obligatorio';
                $lProcesaFormulario = false;
            }
            
            if($lProcesaFormulario){
                ?>

                <script>
                    alert("Reserva creada correctamente.");
                    window.location.href = "/";
                </script>

                <?php

            } else {
                $this->renderHTML('../app/views/new_reserva.php', $data);
            } 
        
        } else {
            $this->renderHTML('../app/views/new_reserva.php', $data);
        }
    }

    public function misReservasAction(){
        $data = [];


        $this->renderHTML('../app/views/mis_reservas_view.php', $data);
    }

}
?>

<script src="https://cdn.jsdelivr.net/npm/jwt-decode/build/jwt-decode.min.js"></script>
