<?php
session_start();
// requreimos el bootstrap y el autoload para la carga automatica de clases
require_once "../boostrap.php";
require_once "../vendor/autoload.php";
require_once "../app/Controllers/UserController.php";

// Usamos el espacio de nombre
use App\Core\Router;
use App\Controllers\UserController;
use App\Controllers\PortController;
use App\Controllers\TrabajosController;
use App\Controllers\ProyectosController;
use App\Controllers\SkillsController;
use App\Controllers\RrssController;

// Creamos una instancia de la clase Router
$router = new Router();

// Añadimos rutas al array
$router->add([  'name' => 'index',
                'path' => '/^\/(\?.*)?$/',
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
                'action' => [TrabajosController::class, 'createWorkAction'],
                'perfil' => ['user']]);

$router->add([  'name' => 'CrearSkill',
                'path' => '/^\/portfolios\/crear\/skill$/',
                'action' => [SkillsController::class, 'createSkillAction'],
                'perfil' => ['user']]);

$router->add([  'name' => 'CrearRrrss',
                'path' => '/^\/portfolios\/crear\/rrss$/',
                'action' => [RrssController::class, 'createRRSSAction'],
                'perfil' => ['user']]);

$router->add([  'name' => 'CrearProyecto',
                'path' => '/^\/portfolios\/crear\/project$/',
                'action' => [ProyectosController::class, 'createProjectAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'EditarTrabajo',
                'path' => '/^\/portfolios\/edit\/trabajo\/\d+$/',
                'action' => [TrabajosController::class, 'editWorkAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'BorrarTrabajo',
                'path' => '/^\/portfolios\/delete\/trabajo\/\d+$/',
                'action' => [TrabajosController::class, 'deleteWorkAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'EditarProyecto',
                'path' => '/^\/portfolios\/edit\/project\/\d+$/',
                'action' => [ProyectosController::class, 'editProjectAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'BorrarProyecto',
                'path' => '/^\/portfolios\/delete\/project\/\d+$/',
                'action' => [ProyectosController::class, 'deleteProjectAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'EditarSkill',
                'path' => '/^\/portfolios\/edit\/skill\/\d+$/',
                'action' => [SkillsController::class, 'editSkillAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'BorrarSkill',
                'path' => '/^\/portfolios\/delete\/skill\/\d+$/',
                'action' => [SkillsController::class, 'deleteSkillAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'EditarRrrss',
                'path' => '/^\/portfolios\/edit\/rrss\/\d+$/',
                'action' => [RrssController::class, 'editRRSSAction'],
                'perfil' => ['user']]);

$router->add([ 'name' => 'BorrarRrrss',
                'path' => '/^\/portfolios\/delete\/rrss\/\d+$/',
                'action' => [RrssController::class, 'deleteRRSSAction'],
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

    // if(isset($route['perfil'])){
    //     if(!isset($_SESSION['perfil']) || !in_array($_SESSION['perfil'], $route['perfil'])){
    //         echo "No tienes permisos";
    //         exit;
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