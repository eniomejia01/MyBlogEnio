<?php

namespace Controllers;

use Model\Admin;
use MVC\Router;

class LoginController{

    public static function login_copy(Router $router)
    {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Admin($_POST);
            $errores = $auth->validar();

            if (empty($errores)) {
                $resultado = $auth->existeUsuario();

                if (!$resultado) {
                    $errores = Admin::getErrores();
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
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/anonaadmin', [
            'errores' => $errores,
            
        ]);
    }
}