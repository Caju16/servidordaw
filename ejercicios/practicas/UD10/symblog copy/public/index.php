<?php
session_start();
$_SESSION['perfil_usuario'] = $_SESSION['perfil_usuario'] ?? 'invitado';
require_once "../bootstrap.php";
require_once "../vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => $_ENV['DBNAME'],
    'username'  => $_ENV['DBUSER'],
    'password'  => $_ENV['DBPASS'],
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

$request = Laminas\Diactoros\ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$routerContainer = new Aura\Router\RouterContainer();
$map = $routerContainer->getMap();

$map->get( 'about', '/about', ["controller" => "App\Controllers\PageController", "action" => "indexAction"]);
$map->get( 'index', '/', ["controller" => "App\Controllers\DefaultController", "action" => "indexAction"]);
$map->get( 'addBlog', '/addBlog', ["controller" => "App\Controllers\CargarController", "action" => "indexAction", "auth" => true]);
$map->post( 'postBlog', '/postBlog', ["controller" => "App\Controllers\CargarController", "action" => "addBlogAction", "auth" => true]);


$route = $routerContainer->getMatcher()->match($request);


if($route){
    $handler = $route->handler;
    $controllerName = $handler['controller'];
    $actionName = $handler['action'];
    $controllerName = new $controllerName;
    $controllerName->$actionName($request);
}else{
    echo "No route";
}