<?php

// requerimos el boostrap y el autoload

require_once("../boostrap.php");
require_once("../vendor/autoload.php");

use App\Controllers\MascotasController;
use App\Core\Router;


$router = new Router();

$router->add(array(
    'name'=>'primera',
    'path'=>'/^\/$/',
    'action'=>[MascotasController::class, 'IndexAction']
));

$router->add(array(
    'name'=>'segunda',
    'path'=>'/^\/mascotas\/add$/',
    'action'=>[MascotasController::class, 'AddMascotasAction']
));


$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);

if($route){
    $controller = new $route['action'][0];
    $action = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);

} else {
    echo "No rute";
}
?>