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
                    $autenticado = $auth->comprobarPassword($resultado);

                    if ($autenticado) {
                        // Configuraciones de seguridad para la sesión
                        session_start();

                        // Regeneramos el ID de sesión para prevenir ataques de fijación
                        session_regenerate_id(true);

                        // Configuramos cookies seguras
                        ini_set('session.cookie_httponly', 1);
                        ini_set('session.use_only_cookies', 1);
                        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                            ini_set('session.cookie_secure', 1);
                        }

                        var_dump($resultado);

                        $_SESSION['id'] = $resultado->id;
                        $_SESSION['nombre'] = $resultado->nombre;
                        $_SESSION['email'] = $resultado->email;
                        $_SESSION['login_copy'] = true;
                        $_SESSION['admin'] = true;
                        $_SESSION['ultimo_acceso'] = time();

                        var_dump($_SESSION);

                        header('Location: /admin');
                        exit;
                    } else {
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/anonaadmin', [
            'errores' => $errores
        ]);
    }
}