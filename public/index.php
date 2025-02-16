<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AdminController;
use Controllers\LoginController;
use Controllers\PostsController;

$router = new Router();

// Zona Privada
$router->get('/admin', [AdminController::class, 'index']);
$router->get('/propiedades/crear', [AdminController::class, 'crear']);
$router->post('/propiedades/crear', [AdminController::class, 'crear']);
$router->get('/propiedades/actualizar', [AdminController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [AdminController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [AdminController::class, 'eliminar']); 


$router->get('/', [PostsController::class, 'index']);

// Zona Pública
$router->get('/anonaadmin', [LoginController::class, 'login_copy']);
$router->post('/anonaadmin', [LoginController::class, 'login_copy']);
$router->get('/propiedades', [LoginController::class, 'propiedades']);
$router->get('/propiedad', [LoginController::class, 'propiedad']);

$router -> comprobarRutas();



