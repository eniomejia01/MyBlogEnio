<?php

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;
use Controllers\PaginasController;
use Controllers\ProductosController;


$router = new Router();

// Zona Privada
$router->get('/admin', [PropiedadController::class, 'index']);
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']); 


$router->get('/', [ProductosController::class, 'index']);

// Zona Pública
$router->get('/login_copy', [PaginasController::class, 'login_copy']);
$router->post('/login_copy', [PaginasController::class, 'login_copy']);

$router->get('/nosotros', [PaginasController::class, 'nosotros']);
$router->get('/propiedades', [PaginasController::class, 'propiedades']);
$router->get('/propiedad', [PaginasController::class, 'propiedad']);

// Login y Autenticacion
// $router -> get('/login', [LoginControllers::class, 'login']);
// $router -> post('/login', [LoginControllers::class, 'login']);
// $router -> get('/logout', [LoginControllers::class, 'logout']);



// Confirma cuenta


$router -> comprobarRutas();



