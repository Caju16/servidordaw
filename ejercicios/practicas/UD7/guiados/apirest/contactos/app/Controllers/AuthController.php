<?php

namespace App\Controllers;

use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
use App\Models\Usuario;

class AuthController
{
    private $requestMethod;
    private $userId;
    private $users;

    public function __construct($requestMethod, $userId)
    {
        $this->requestMethod = $requestMethod;
        $this->userId = $userId;
        $this->users = Usuario::getInstancia();
    }

    public function loginFromRequest()
    {
        // Leemos flujo de entrada
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);

        // Determinamos si el JSON es válido
        if (json_last_error() !== JSON_ERROR_NONE) {
            http_response_code(400);
            echo json_encode(["message" => "El JSON recibido no es válido.", "error" => json_last_error_msg()]);
            exit;
        }

        $usuario = $input['usuario'];
        $password = $input['password'];
        $dataUser = $this->users->login($usuario, $password);

        if ($dataUser) {
            $key = KEY; // Clave de encriptación
            $issuer_claim = "http://apirest.local"; // Emisor del token
            $audience_claim = "http://apirest.local"; // Destinatario del token
            $issuedat_claim = time(); // Tiempo en que fue emitido el token
            $notbofore_claim = time(); // Tiempo antes del cual no es válido el token
            $expire_claim = $issuedat_claim + 3600; // Tiempo de expiración del token

            $token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbofore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "usuario" => $usuario,
                    "id" => $dataUser['id']
                )
            );

            http_response_code(200);
            $jwt = JWT::encode($token, $key, 'HS256');
            echo json_encode(
                array(
                    "message" => "Inicio de sesión exitoso.",
                    "jwt" => $jwt,
                    "expireAt" => $expire_claim
                )
            );
        } else {
            http_response_code(401);
            echo json_encode(array("message" => "Inicio de sesión fallido."));
        }
    }
}
?>