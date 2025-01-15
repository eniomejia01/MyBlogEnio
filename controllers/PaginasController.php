<?php

namespace Controllers;

use Model\Admin;
use MVC\Router;
use Model\Propiedad;


class PaginasController{

    public static function login_copy(Router $router)
    {
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $alertas = $auth->validar();

            if (empty($alertas)) {
                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    $alertas = Admin::getErrores();
                } else {
                    // Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado) {
                        // Autenticar el usuario
                        session_start();

                        $_SESSION['id'] = $resultado->id;
                        $_SESSION['nombre'] = $resultado->nombre;
                        $_SESSION['email'] = $resultado->email;
                        $_SESSION['login_copy'] = true;
                        $_SESSION['admin'] = true;

                        header('Location: /admin');
                        exit;
                    } else {
                        $alertas = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/login_copy', [
            'alertas' => $alertas,
            
        ]);
    }

    public static function index( Router $router){
        
        $propiedades = Propiedad::get(3);
        // $inicio = true;

        $router -> render('/paginas/index', [
            'propiedades' => $propiedades,
            // 'inicio' => $inicio

        ]);
    }

    public static function propiedades( Router $router){

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);

    }

    public static function propiedad( Router $router){

        $id = validarORedireccionar('/public/propiedades');

        // buscar la propiedad por su id
        $propiedad = Propiedad::find($id);

        $router -> render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }


}