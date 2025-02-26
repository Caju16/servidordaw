<?php

namespace App\Controllers;

use App\Models\Inscripciones;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class InscripcionesController
{

    private $requestMethod;
    private $inscripciones;
    private $usuariosId;

    public function __construct($requestMethod, $usuariosId)
    {
        $this->requestMethod = $requestMethod;
        $this->usuariosId = $usuariosId;
        $this->inscripciones = Inscripciones::getInstancia();
    }


    public function processRequest(){

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        switch($this->requestMethod){

            case 'POST':
                $response = $this->nuevaInscripcion();
                break;
            
            case 'DELETE':
                $response = $this->deleteInscripcion($uri[3]);
                break;
                
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }
    
    private function nuevaInscripcion(){

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $plazas = $this->inscripciones->getPlazas($input['id_actividad']);
        $inscripcionesActuales = $this->inscripciones->getInscripcionesCount($input['id_actividad']);

        if ($inscripcionesActuales >= $plazas[0]['plazas']) {
            $response['status_code_header'] = 'HTTP/1.1 400 Bad Request';
            $response['body'] = json_encode(['message' => 'No hay plazas disponibles'], JSON_UNESCAPED_UNICODE);
            return $response;
        }
        
        $result = $this->inscripciones->set($input);

        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode(['message' => 'Inscripcion creada con éxito'], JSON_UNESCAPED_UNICODE);
        return $response; 

    }


    private function deleteInscripcion($id = ''){

        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
        $inscripcion = null;

        $jwt = explode(" ", $authHeader)[1] ?? null;

        try {
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
            $idUser = $decoded->data->{0} ?? null;
            
        } catch (Exception $e) {
            return $this->unauthorizedResponse("Acceso denegado: " . $e->getMessage());
        }

        
        $inscripcionesUsuario = $this->inscripciones->getById($idUser);
        
        foreach ($inscripcionesUsuario as $inscripcion) {
            if ($inscripcion['id'] == $id) {
                $inscripcion = $inscripcion;
                // var_dump($inscripcion); die();
                $result = $this->inscripciones->delete($id);
            } else {
                $inscripcion = null;
            }
        }

        if (!$inscripcion) {
            return $this->notFound();
        }


        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(['message' => 'Inscripcion eliminada con éxito'], JSON_UNESCAPED_UNICODE);
        return $response;
    }


    private function notFoundResponse(){
        return [
            'status_code_header' => 'HTTP/1.1 404 Not Found',
            'body' => json_encode(['message' => 'No se ha podido realizar la consulta'], JSON_UNESCAPED_UNICODE)
        ];
    }

    private function notFound(){
        return [
            'status_code_header' => 'HTTP/1.1 404 Not Found',
            'body' => json_encode(['message' => 'No se ha encontrado la Inscripcion'], JSON_UNESCAPED_UNICODE)
        ];
    }

}
?>