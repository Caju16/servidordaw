<?php

namespace App\Controllers;

use App\Models\Contactos;

class ContactosController
{

    private $requestMethod;
    private $contactos;
    private $contacosId;

    public function __construct($requestMethod, $contactosId)
    {
        $this->requestMethod = $requestMethod;
        $this->contacosId = $contactosId;
        $this->contactos = Contactos::getInstancia();
    }


    public function processRequest(){

        switch($this->requestMethod){
            case 'GET':
                $response = $this->getContactos($this->contacosId);
                break;

            case 'POST':
                $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                $response = $this->createContactos($input);
                break;

            case 'PUT':
                $input = (array) json_decode(file_get_contents('php://input'), TRUE);
                $response = $this->updateContactos($this->contacosId, $input);
                break;

            case 'DELETE':
                $response = $this->deleteContactos($this->contacosId);
                break;
                
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($response['status_code_header']);
        if (isset($response['body'])) {
            echo $response['body'];
        }
    }

    private function createContactos($input)
    {
        if (!isset($input['nombre'], $input['telefono'], $input['email'])) {
            return $this->unprocessableEntityResponse();
        }

        $this->contactos->set($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = json_encode(['message' => 'Contacto creado con éxito']);
        return $response;
    }

    private function Todos(){
        $result = $this->contactos->getAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function updateContactos($id, $input)
    {
        if (!$this->getContactos($this->contacosId)) {
            return $this->notFoundResponse();
        }

        $result = $this->contactos->edit($id, $input);

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(['message' => 'Contacto actualizado con éxito']);
        return $response;
    }

    private function deleteContactos($input){
        if (!$this->getContactos($this->contacosId)) {
            return $this->notFoundResponse();
        }

        $this->contactos->delete($this->contacosId);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode(['message' => 'Contacto eliminado con éxito']);
        return $response;
    }

    private function getContactos($id){
        $result = $this->contactos->get($id);
        if(!$result){
            return $this->notFoundResponse();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = json_encode(['message' => 'Recurso no encontrado']);
        return $response;
    }

    private function unprocessableEntityResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Entity';
        $response['body'] = json_encode(['message' => 'Entrada no válida']);
        return $response;
    }
}
?>