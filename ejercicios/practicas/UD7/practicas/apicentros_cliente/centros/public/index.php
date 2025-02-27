<?php

require "../bootstrap.php";
require_once "../vendor/autoload.php";

use App\Core\Router;
use App\Controllers\UserController;
use App\Controllers\CentrosCivicosController;
use App\Controllers\InstalacionesController;
use App\Controllers\ActividadesController;
use App\Controllers\ReservasController;
use App\Controllers\InscripcionesController;
use App\Controllers\AuthController;
use App\Controllers\ViewController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE"); 

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
if(isset($uri[3])){
    $userId = (int) $uri[3];
}

// Proceso de login

// if($request == '/api/login/'){
//     $auth = new AuthController($requestMethod);
//     if (!$auth->loginFromRequest()) {
//         exit(http_response_code(401));
//     };
// } 

function sesion(){
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

    // var_dump($authHeader);
    
    if($jwt){
        try{
            $decoded = JWT::decode($jwt, new Key(KEY, 'HS256'));
            return true;
        } catch (Exception $e){
            echo json_encode(array(
                'message' => 'Acceso denegado', 
                           'error' => $e->getMessage() 
            ));
            return false;
            exit(http_response_code(401));
        }
    }
    return false;
}

// var_dump(sesion());



$router = new Router();

// VISTA

$router->add(array(
    'name'=>'home',
    'path'=>'/^\/+$/',
    'action' => [ViewController::class, 'indexAction'],
    'perfil'=>  ['publico']
));


$route = $router->match($request);
if ($route) {

    if($route['perfil'][0] == 'usuario' && !sesion()){
        header('HTTP/1.1 401 Unauthorized');
        $response['body'] = json_encode(array('message' => 'Acceso no autorizado'));
        echo json_encode($response['body']);
        exit();
    }

    if($route['perfil'][0] == 'registros' && sesion()){
        header('HTTP/1.1 401 Unauthorized');
        $response['body'] = json_encode(array('message' => 'Acceso no permitido'));
        echo json_encode($response['body']);
        exit();
    }

    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
    $response['body'] = null;
    echo json_encode($response);
}

?>