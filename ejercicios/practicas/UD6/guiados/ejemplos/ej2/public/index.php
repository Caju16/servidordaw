<?php
// requreimos el bootstrap y el autoload para la carga automatica de clases
require_once "../boostrap.php";
require_once "../vendor/autoload.php";
require_once "../app/Controllers/PerrosController.php";

// Usamos el espacio de nombre
use App\Core\Router;
use App\Controllers\PerrosController;

// Creamos una instancia de la clase Router
$router = new Router();

// Añadimos rutas al array
$router->add([  'name' => 'primera',
                'path' => '/^\/$/',
                'action' => [PerrosController::class, 'IndexAction']]);

$router->add([  'name' => 'segunda',
                'path' => '/^\/mascotas\/add$/',
                'action' => [PerrosController::class, 'AddAction']]);

$router->add([  
                'name' => 'tercera',
                'path' => '/^\/mascotas\/delete(\?id=\d+)?$/',
                'action' => [PerrosController::class, 'DeleteAction']]);
                
$router->add([  
                'name' => 'cuarta',
                'path' => '/^\/mascotas\/edit(\?id=\d+)?$/',
                'action' => [PerrosController::class, 'EditAction']]);              

$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request); // Comprobamos que coincide una ruta

if($route){
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
}else{
    echo "No route";
}
?>