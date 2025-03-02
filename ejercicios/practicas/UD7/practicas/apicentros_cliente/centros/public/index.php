<?php

require "../bootstrap.php";
require_once "../vendor/autoload.php";

use App\Core\Router;
use App\Controllers\UserController;
use App\Controllers\ViewController;
use App\Controllers\ReservasController;
use App\Controllers\InscripcionesController;

$router = new Router();

// VISTA

$router->add(array(
    'name'=>'home',
    'path' => '/^\/(\?.*)?$/',
    'action' => [ViewController::class, 'indexAction'],
    'perfil'=>  ['publico']
));

// LOGIN 

$router->add(array(
    'name'=>'login',
    'path' => '/^\/usuario\/login$/',
    'action' => [UserController::class, 'loginAction'],
    'perfil'=>  ['publico']
));

// REGISTRO

$router->add(array(
    'name'=>'register',
    'path' => '/^\/usuario\/register$/',
    'action' => [UserController::class, 'registerAction'],
    'perfil'=>  ['publico']
));

// EDITAR

$router->add(array(
    'name'=>'edit_user',
    'path'=>'/^\/usuario\/edit$/',
    'action'=> [UserController::class, 'editUserAction'],
    'perfil'=>  ['usuario']
));

// CREAR RESERVA

$router->add(array(
    'name'=>'create_reserva',
    'path'=>'/^\/reserva\/create$/',
    'action'=> [ReservasController::class, 'indexAction'],
    'perfil'=>  ['usuario']
));

// MIS RESERVAS

$router->add(array(
    'name'=>'mis_reservas',
    'path'=>'/^\/reservas\/misreservas$/',
    'action'=> [ReservasController::class, 'misReservasAction'],
    'perfil'=>  ['usuario']
));


// CREAR INSCRIPCIÓN

$router->add(array(
    'name'=>'create_inscripcion',
    'path'=>'/^\/inscripcion\/create$/',
    'action'=> [InscripcionesController::class, 'indexAction'],
    'perfil'=>  ['usuario']
));

// MIS INSCRIPCIONES

$router->add(array(
    'name'=>'mis_inscripciones',
    'path'=>'/^\/inscripciones\/misinscripciones$/',
    'action'=> [InscripcionesController::class, 'misInscripcionesAction'],
    'perfil'=>  ['usuario']
));

$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);

if ($route) {
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