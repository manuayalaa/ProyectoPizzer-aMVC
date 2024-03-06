<?php
require('../app/Config/config.php');
require('../vendor/autoload.php');

use App\Core\Router;
use App\Controllers\IndexController;
use App\Controllers\NumerosController;

$router = new Router();

$router->add(array(
    'name' => 'home',
    'path' => '/^\/pizzas$/',
    'action' => [IndexController::class, 'IndexAction']
));
$router->add(array(
    'name' => 'home',
    'path' => '/^\/bebidas$/',
    'action' => [IndexController::class, 'BebidaAction']
));
$router->add(array(
    'name' => 'home',
    'path' => '/^\/postres$/',
    'action' => [IndexController::class, 'PostresAction']
));
// Router para cerrar sesion
$router->add(array(
    'name' => 'home',
    'path' => '/^\/cierresesion$/',
    'action' => [IndexController::class, 'CerrarSesionAction']
));
// Router para carrito
$router->add(array(
    'name' => 'home',
    'path' => '/^\/carrito$/',
    'action' => [IndexController::class, 'CarritoAction']
));
// Router para login
$router->add(array(
    'name' => 'home',
    'path' => '/^\/login$/',
    'action' => [IndexController::class, 'LoginAction']
));
// Router para gestioncomandas
$router->add(array(
    'name' => 'home',
    'path' => '/^\/gestioncomandas$/',
    'action' => [IndexController::class, 'GestionComandasAction']
));
//Router para cierresesioncomandas
$router->add(array(
    'name' => 'home',
    'path' => '/^\/cierresesioncomandas$/',
    'action' => [IndexController::class, 'CerrarSesionComandasAction']
));
$request = str_replace(DIRBASEURL, '', $_SERVER['REQUEST_URI']);

$route = $router->match($request);
if ($router) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];

    $controller = new $controllerName;
    $controller->$actionName($request);
} else {
    echo 'error';
}
