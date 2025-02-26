<?php
session_start();
require_once "../bootstrap.php";
require_once "../vendor/autoload.php";

use App\Core\Router;
use App\Controllers\DefaultController;
use App\Controllers\CargarController;

$router = new Router();

$router->add([  'name' => 'index',
                'path' => '/^\/$/',
                'action' => [DefaultController::class, 'IndexAction']]);
                
$router->add([  'name' => 'cargar',
                'path' => '/^\/cargardatos$/',
                'action' => [CargarController::class, 'IndexAction']]);    

$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);

if($route){
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($blogs);
}else{
    echo "No route";
}
?>
