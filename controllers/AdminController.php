<?php


namespace Controllers;

use Middlewares\AuthMiddleware;
use MVC\Router;
use Model\Propiedad;


class AdminController {


    public static function index(Router $router) {

        // Verificamos la autenticación antes de mostrar la vista
        AuthMiddleware::verificarLogin();
        
        $propiedades = Propiedad::all();
            // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [

            'propiedades' => $propiedades,
            'resultado' => $resultado,


        ]);
    }

    public static function crear(Router $router) {

        $propiedad = new Propiedad;


        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();


        if($_SERVER['REQUEST_METHOD'] === 'POST') {


            // Crea una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);
    
    
            // Validar
            $errores = $propiedad -> validar();
    
        // Revisar que el arreglo de errores este vacio
            if(empty($errores)){
        
            // Guardar en la BD
            $propiedad -> guardar();


            }
    
            
        }


        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,

            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {

        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);

        $errores = Propiedad::getErrores();

        // Método Post para actualizar
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // asignar los atributos
            $args = $_POST['propiedad'];
    
            $propiedad -> sincronizar($args);
    
            $errores = $propiedad->validar();

            $propiedad -> guardar();
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,

        ]);

    }

    public static function eliminar(){

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
    
            if($id){
    
                $tipo = $_POST['tipo'];
    
                if(validarTipoContenido($tipo)) {            
                    // Compara lo que vamos a eliminar
                    $propiedad = Propiedad::find($id);
                    $propiedad-> eliminar();
                } 
            }
        }
    }


}