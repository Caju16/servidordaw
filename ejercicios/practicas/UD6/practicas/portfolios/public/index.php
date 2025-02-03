<?php
session_start();
// requreimos el bootstrap y el autoload para la carga automatica de clases
require_once "../boostrap.php";
require_once "../vendor/autoload.php";
require_once "../app/Controllers/UserController.php";
require_once "../app/Controllers/PortController.php";

// Usamos el espacio de nombre
use App\Core\Router;
use App\Controllers\UserController;
use App\Controllers\PortController;

// Creamos una instancia de la clase Router
$router = new Router();

// Añadimos rutas al array
$router->add([  'name' => 'index',
                'path' => '/^\/$/',
                'action' => [UserController::class, 'IndexAction']]);     

$router->add([  'name' => 'Login',
                'path' => '/^\/usuario\/login$/',
                'action' => [UserController::class, 'LoginAction'],
                'perfil' => ['user']]);     

$router->add([  'name' => 'Register',
                'path' => '/^\/usuario\/register$/',
                'action' => [UserController::class, 'RegisterAction'],
                'perfil' => ['user']]);   

$router->add([  'name' => 'Logout',
                'path' => '/^\/usuario\/logout$/',
                'action' => [UserController::class, 'LogoutAction'],
                'perfil' => ['user']]);

$router->add([  'name' => 'System',
                'path' => '/^\/usuario\/system$/',
                'action' => [UserController::class, 'SystemAction'],
                'perfil' => ['user']]);
                
$router->add([  'name' => 'List',
                'path' => '/^\/portfolios\/list\/\d+$/',
                'action' => [PortController::class, 'ListAction'],
                'perfil' => ['user']]);

$router->add([  'name' => 'CrearTrabajo',
                'path' => '/^\/portfolios\/crear\/trabajo$/',
                'action' => [PortController::class, 'createWorkAction'],
                'perfil' => ['user']]);

$router->add([  'name' => 'CrearSkill',
                'path' => '/^\/portfolios\/crear\/skill$/',
                'action' => [PortController::class, 'createSkillAction'],
                'perfil' => ['user']]);

$router->add([  'name' => 'CrearRrrss',
                'path' => '/^\/portfolios\/crear\/rrss$/',
                'action' => [PortController::class, 'createRRSSAction'],
                'perfil' => ['user']]);

$router->add([  'name' => 'CrearProyecto',
                'path' => '/^\/portfolios\/crear\/project$/',
                'action' => [PortController::class, 'createProjectAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'EditarTrabajo',
                'path' => '/^\/portfolios\/edit\/trabajo\/\d+$/',
                'action' => [PortController::class, 'editWorkAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'BorrarTrabajo',
                'path' => '/^\/portfolios\/delete\/trabajo\/\d+$/',
                'action' => [PortController::class, 'deleteWorkAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'EditarProyecto',
                'path' => '/^\/portfolios\/edit\/project\/\d+$/',
                'action' => [PortController::class, 'editProjectAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'BorrarProyecto',
                'path' => '/^\/portfolios\/delete\/project\/\d+$/',
                'action' => [PortController::class, 'deleteProjectAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'EditarSkill',
                'path' => '/^\/portfolios\/edit\/skill\/\d+$/',
                'action' => [PortController::class, 'editSkillAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'BorrarSkill',
                'path' => '/^\/portfolios\/delete\/skill\/\d+$/',
                'action' => [PortController::class, 'deleteSkillAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'EditarRrrss',
                'path' => '/^\/portfolios\/edit\/rrss\/\d+$/',
                'action' => [PortController::class, 'editRRSSAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'BorrarRrrss',
                'path' => '/^\/portfolios\/delete\/rrss\/\d+$/',
                'action' => [PortController::class, 'deleteRRSSAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'EditarUsuario',
                'path' => '/^\/usuario\/editar$/',
                'action' => [UserController::class, 'editUserAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'BorrarUsuario',
                'path' => '/^\/usuario\/delete$/',
                'action' => [UserController::class, 'deleteUserAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'Verificar',
                'path' => '/^\/verificar(\/|\?token=)[\w\.\+\-\/=]+$/',
                'action' => [UserController::class, 'verifyUserAction']]);

$request = $_SERVER['REQUEST_URI'];
$route = $router->match($request); // Comprobamos que coincide una ruta

if($route){

    // if(in_array($_SESSION)){
    //     if(!in_array($route['perfil'], $_SESSION['usuario']['perfil'])){
    //         echo "No tienes permisos para acceder a esta ruta";
    //         return;
    //     }
    // }

    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;
    $controller->$actionName($request);
}else{
    echo "No route";
}
?>