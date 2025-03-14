<?php

require "../bootstrap.php";
require_once "../vendor/autoload.php";

use App\Core\Router;
use App\Controllers\ContactosController;
use App\Controllers\AuthController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE"); 

// Permitimos el acceso desde cualquier origen
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

// Recuperamos el método utilizado

$requestMethod = $_SERVER['REQUEST_METHOD'];
// $request = $_SERVER['REQUEST_METHOD'];

$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $request );

$userId = null;
if(isset($uri[2])){
    $userId = (int) $uri[2];
}

// Proceso de login

if($request == '/login/'){
    $auth = new AuthController($requestMethod);
    if (!$auth->loginFromRequest()) {
        exit(http_response_code(401));
    };
} 

$input = (array) json_decode(file_get_contents('php://input'), TRUE);
$authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
$arr = explode(" ", $authHeader);
$jwt = null;

if ($authHeader) {
    $arr = explode(" ", $authHeader);
    if (isset($arr[1])) {
        $jwt = $arr[1];
    }
}


if($jwt){
    try{
        $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
    } catch (Exception $e){
        echo json_encode(array(
            'message' => 'Acceso denegado', 
            'error' => $e->getMessage() 
        ));
        exit(http_response_code(401));
    }
}

$router = new Router();
$router->add(array(
    'name'=>'contactos',
    'path'=>'/^\/contactos\/([0-9]+)?$/',
    'action'=>ContactosController::class)
);


$route = $router->match($request);
if ($route) {
    $controllerName = $route['action'];
    $controller = new $controllerName($requestMethod, $userId);
    $controller->processRequest();
} else {
    $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
    $response['body'] = null;
    echo json_encode($response);
}

?>