<?php
session_start();
require_once "../vendor/autoload.php";

use App\Core\Router;
use App\Controllers\DefaultController;
use App\Controllers\CargarController;
use Laminas\Diactoros\ServerRequestFactory;
use App\Controllers\PageController;
use Laminas\Diactoros\Response;

$router = new Router();

$router->add([  'name' => 'index',
                'path' => '/^\/$/',
                'action' => [DefaultController::class, 'IndexAction']]);
                
$router->add([  'name' => 'cargar',
                'path' => '/^\/cargardatos$/',
                'action' => [CargarController::class, 'IndexAction']]);    

$router->add(array(
    'name' => '',
    'path' => '/^\/blogs\/nuevo$/',
    'action' => [PageController::class, 'IndexAction'],
));

$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$route = $router->match($request->getUri()->getPath());

// var_dump($route);

$response = new Response();


if($route){
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request, $response);
}else{
    $response->getBody()->write("No route");
}

http_response_code($response->getStatusCode());
foreach ($response->getHeaders() as $name => $values) {
    foreach ($values as $value) {
        header(sprintf('%s: %s', $name, $value), false);
    }
}
var_dump($request->getUri()->getPath());
?>


<?php

// use App\Controllers\BaseController;
// use App\Controllers\DatosController;
// use Laminas\Diactoros\Response\RedirectResponse;
// use Illuminate\Database\Capsule\Manager as Capsule;

// require_once("../bootstrap.php");
// require_once("../vendor/autoload.php");

// use App\Core\Router;

// $capsule = new Capsule;
// $capsule->addConnection([
//     'driver'    => 'mysql',
//     'host'      => '127.0.0.1',
//     'database'  => 'symblog', // Reemplaza con el nombre real de tu BD
//     'username'  => 'root', // Usuario de la BD
//     'password'  => '', // Contraseña de la BD
//     'charset'   => 'utf8',
//     'collation' => 'utf8_unicode_ci',
//     'prefix'    => '',
// ]);
// $capsule->setAsGlobal();
// $capsule->bootEloquent();

// $request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
//     $_SERVER,
//     $_GET,
//     $_POST,
//     $_COOKIE,
//     $_FILES
// );

// $router = new Router();

// // $router->add(array(
// //     'name' => '',
// //     'path' => '/^\/$/',
// //     'action' => [BaseController::class, 'renderHTML'],
// //     'perfil' => []
// // ));

// var_dump($request->getUri()->getPath());

