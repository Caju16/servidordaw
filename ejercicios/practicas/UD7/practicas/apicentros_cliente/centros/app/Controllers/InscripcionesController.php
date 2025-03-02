<?php

namespace App\Controllers;

class InscripcionesController extends BaseController
{
    public function indexAction()
    {
        $lProcesaFormulario = false;
        $data['nombre'] = $data['telefono'] = $data['email'] = $data['actividad'] = $data['fecha_inscripcion'] = $data['estado'] = '';
        $data['msjErrorNombre'] = $data['msjErrorTelefono'] = $data['msjErrorEmail'] = $data['msjErrorActividad'] = $data['msjErrorFechaInscripcion'] = $data['msjErrorEstado'] = '';
        
        ?>
        
        <script>
            function cargarActividades(selectElement = null) {
                fetch("http://apicentros.local/api/actividades")
                    .then(response => response.json())
                    .then(actividades => {
                        if (selectElement) {
                            actividades.forEach(actividad => {
                                let option = document.createElement("option");
                                option.value = actividad.id;
                                option.textContent = actividad.nombre;
                                selectElement.appendChild(option);                                
                            });
                        } 
                    })
                    .catch(error => console.error("Error cargando actividades:", error));
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
            $data['actividad'] = $_POST['actividad'];
            $data['fecha_inscripcion'] = $_POST['fecha_inscripcion'];
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
            
            if(empty($data['actividad'])){
                $data['msjErrorActividad'] = 'La actividad es obligatoria';
                $lProcesaFormulario = false;
            }
            
            if(empty($data['fecha_inscripcion'])){
                $data['msjErrorFechaInscripcion'] = 'La fecha de inscripción es obligatoria';
                $lProcesaFormulario = false;
            }
            
            if(empty($data['estado'])){
                $data['msjErrorEstado'] = 'El estado es obligatorio';
                $lProcesaFormulario = false;
            }
            
            if($lProcesaFormulario){
                ?>

                <script>
                    alert("Inscripción creada correctamente.");
                    window.location.href = "/";
                </script>

                <?php
                $this->renderHTML('../app/views/new_inscripciones_view.php', $data);

            } else {
                $this->renderHTML('../app/views/new_inscripciones_view.php', $data);
            } 
        
        } else {
            $this->renderHTML('../app/views/new_inscripciones_view.php', $data);
        }
    }

    public function misInscripcionesAction()
    {
        $this->renderHTML('../app/views/mis_inscripciones_view.php');
    }
}
?>

<script src="https://cdn.jsdelivr.net/npm/jwt-decode/build/jwt-decode.min.js"></script>