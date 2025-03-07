<?php
session_start();

// Si no hay una sesión iniciada, se establece el rol como 'invitado'
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = '';
    $_SESSION['perfil'] = 'invitado';
}

require_once "../bootstrap.php";
require_once "../vendor/autoload.php";

use App\Core\Router;
use App\Controllers\DefaultController;
use App\Controllers\SystemController;

$router = new Router();

$router->add([  'name' => 'index',
                'path' => '/^\/$/',
                'action' => [DefaultController::class, 'IndexAction'],
                'perfil' => ['invitado', 'user']]);     

$router->add([  'name' => 'logout',
                'path' => '/^\/logout$/',
                'action' => [DefaultController::class, 'LogoutAction'],
                'perfil' => ['user']]);

$router->add([  'name' => 'sistema',
                'path' => '/^\/sistema$/',
                'action' => [SystemController::class, 'IndexAction'],
                'perfil' => ['user']]);

// Limpia la ruta de petición
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Busca la ruta solicitada 
$route = $router->match($request);

// Si la ruta existe y el rol del usuario es permitido, se ejecuta la acción correspondiente
if($route){
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
