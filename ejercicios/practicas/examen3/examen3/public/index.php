<?php
session_start();

// Si no existe la variable de sesión id, la creamos y le asignamos un valor vacío

if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = '';
    $_SESSION['perfil'] = 'invitado';
}

require_once "../bootstrap.php";
require_once "../vendor/autoload.php";

use App\Core\Router;
use App\Controllers\DefaultController;
use App\Controllers\MultasController;

$router = new Router();

// Rutas

$router->add([  'name' => 'index',
                'path' => '/^\/$/',
                'action' => [DefaultController::class, 'IndexAction']]);
                
$router->add([  'name' => 'logout',
                'path' => '/^\/logout$/',
                'action' => [DefaultController::class, 'LogoutAction']]);

$router->add([  'name' => 'sistema',
                'path' => '/^\/listado$/',
                'action' => [MultasController::class, 'IndexAction'],
                'perfil' => ['admin', 'agente', 'conductor']]);

$router->add([  'name' => 'multas',
                'path' => '/^\/multas\/pagar\/(\d+)$/',
                'action' => [MultasController::class, 'MultasAction'],
                'perfil' => ['conductor']]);

$router->add([  'name' => 'multar',
                'path' => '/^\/acciones\/multar$/',
                'action' => [MultasController::class, 'MultarAction'],
                'perfil' => ['agente']]);

$router->add([  'name' => 'nuevaMulta',
                'path' => '/^\/acciones\/nuevaMulta$/',
                'action' => [MultasController::class, 'NuevaMultaAction'],
                'perfil' => ['agente']]);


$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request);

if($route){
    // Si la ruta tiene un perfil y el perfil del usuario no está en la lista de perfiles permitidos, redirigimos a la página principal
    if (isset($route['perfil']) && !in_array($_SESSION['perfil'], $route['perfil'])) {
        header("Location: /");
    } else{
        $controllerName = $route['action'][0];
        $actionName = $route['action'][1];
        $controller = new $controllerName;
        $controller->$actionName($request);
    }
}else{
    echo "No route";
}
?>
