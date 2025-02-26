<?php

namespace App\Controllers;

use App\Models\Reservas;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class ReservasController
{

    private $requestMethod;
    private $reservas;
    private $usuariosId;

    public function __construct($requestMethod, $usuariosId)
    {
        $this->requestMethod = $requestMethod;
        $this->usuariosId = $usuariosId;
        $this->reservas = Reservas::getInstancia();
    }


    public function processRequest(){

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = explode('/', $uri);

        switch($this->requestMethod){
            case 'GET':
                $response = $this->getReservas();
                break;

            case 'POST':
                $response = $this->NuevaReserva();
                break;
            
            case 'DELETE':
                $response = $this->deleteReserva($uri[3]);
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
    
    private function NuevaReserva(){

        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        $result = $this->reservas->set($input);

        // var_dump($result); die();

        // if (!$result) {
        //     return $this->notFoundResponse();
        // }

        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode(['message' => 'Reserva creada con éxito'], JSON_UNESCAPED_UNICODE);
        return $response; 

    }

    private function getReservas(){

        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

        $jwt = explode(" ", $authHeader)[1] ?? null;

        try {
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
            $idUser = $decoded->data->{0} ?? null;

        } catch (Exception $e) {
            return $this->unauthorizedResponse("Acceso denegado: " . $e->getMessage());
        }
        
        
        $input['id'] = $idUser;

        $result = $this->reservas->get(['id' => $idUser]);
        
        if (!$result) {
            return $this->noData();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function deleteReserva($id = ''){

        $authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
        $reserva = null;

        $jwt = explode(" ", $authHeader)[1] ?? null;

        try {
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
            $idUser = $decoded->data->{0} ?? null;

        } catch (Exception $e) {
            return $this->unauthorizedResponse("Acceso denegado: " . $e->getMessage());
        }

        $reservasUsuario = $this->reservas->get(['id' => $idUser]);

        foreach ($reservasUsuario as $reserva) {
            if ($reserva['id'] == $id) {
                $reserva = $reserva;
                $result = $this->reservas->delete($id);
            } else {
                $reserva = null;
            }
        }

        if (!$reserva) {
            return $this->notFound();
        }


        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(['message' => 'Reserva eliminada con éxito'], JSON_UNESCAPED_UNICODE);
        return $response;
    }


    private function notFoundResponse(){
        return [
            'status_code_header' => 'HTTP/1.1 404 Not Found',
            'body' => json_encode(['message' => 'No se ha podido realizar la consulta'], JSON_UNESCAPED_UNICODE)
        ];
    }

    private function noData(){
        return [
            'status_code_header' => 'HTTP/1.1 404 Not Found',
            'body' => json_encode(['message' => 'No se han encontrado reservas'], JSON_UNESCAPED_UNICODE)
        ];
    }

    private function notFound(){
        return [
            'status_code_header' => 'HTTP/1.1 404 Not Found',
            'body' => json_encode(['message' => 'No se ha encontrado la reserva'], JSON_UNESCAPED_UNICODE)
        ];
    }

}
?>