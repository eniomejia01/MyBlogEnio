<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;

class ProductosController{
    
    public static function index ( Router $router ) {

        $propiedades = Propiedad::all();


        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;
        // session_start()

        $router->render('paginas/index', [
            // 'nombre' => $_SESSION['nombre'],
            'propiedades' => $propiedades,
            'resultado' => $resultado,
        ]);
    }
}
