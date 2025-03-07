<?php

    namespace App\Controllers;

    use App\Models\Usuarios;
    use App\Models\Examenes;
    use App\Models\Preguntas;
    use App\Models\Notas;

    class SystemController extends BaseController
    {
        public function IndexAction()
        {
            $data = [];
            $notas = Notas::getInstancia();

            if(isset($_POST['empezar'])){

                $examenes = Examenes::getInstancia();
                $preguntas = Preguntas::getInstancia();

                if(!isset($_SESSION['idExamen'])){
                    $data['examenes'] = $examenes->getAll();

                    $ids = array_column($data['examenes'], 'id');
                    $idE = $ids[array_rand($ids)];

                    $_SESSION['idExamen'] = $idE;
                }

                $examen = $examenes->get($_SESSION['idExamen']);

                $data['preguntas'] = $preguntas->get($_SESSION['idExamen']);

                $data['examen'] = $examen[0];

            }

            if(isset($_POST['finalizar'])){
                $preguntas = Preguntas::getInstancia();
                $examenes = Examenes::getInstancia();

                $preguntas_examen = $preguntas->get($_SESSION['idExamen']);

                $nota = 0;
                $correcciones = [];

                foreach ($preguntas_examen as $pregunta) {
                    $idPregunta = $pregunta['id'];
                    $respuestaUsuario = $_POST["respuesta$idPregunta"] ?? null;
                    $respuestaCorrecta = $pregunta['respuesta_correcta'];


                    if ($respuestaUsuario == $respuestaCorrecta) {
                        $nota += 1;
                        $correcciones[$idPregunta] = true;
                    } else {
                        $nota -= 1;
                        $correcciones[$idPregunta] = false;
                    }
                }

                // Guardar nota en la base de datos
                $notas->setNotas([
                    'id_usuario' => $_SESSION['user'][0]['id'],
                    'id_examen' => $_SESSION['idExamen'],
                    'nota' => $nota,
                    'fecha_realizacion' => date('Y-m-d H:i:s')
                ]);

                // Pasar datos a la vista de corrección
                $data['nota'] = $nota;
                $data['correcciones'] = $correcciones;
                $data['preguntas'] = $preguntas_examen;

                // Limpiar la sesión del examen
                unset($_SESSION['idExamen']);

                // Renderizar la vista de corrección
                $this->renderHTML('../app/views/correccion_view.php', $data);
                return;
            }

            $this->renderHTML('../app/views/system_view.php', $data);
        }


    }
?>