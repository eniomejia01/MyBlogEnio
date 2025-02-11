<?php

namespace Middlewares;

class AuthMiddleware
{
    // Esta función verifica si el usuario está autenticado correctamente
    public static function verificarLogin()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        // Verificamos múltiples condiciones de seguridad
        $autenticado = isset($_SESSION['login_copy']) &&
            isset($_SESSION['admin']) &&
            isset($_SESSION['id']) &&
            $_SESSION['admin'] === true;

        if (!$autenticado) {
            header('Location: /');
            exit;
        }

        // Verificamos el tiempo de inactividad (30 minutos)
        if (isset($_SESSION['ultimo_acceso'])) {
            $inactivo = 1800; // 30 minutos en segundos
            $tiempo_transcurrido = time() - $_SESSION['ultimo_acceso'];

            if ($tiempo_transcurrido > $inactivo) {
                self::logout(); // Cerramos la sesión si ha pasado mucho tiempo
            }
        }

        // Actualizamos el tiempo del último acceso
        $_SESSION['ultimo_acceso'] = time();
    }

    // Método para cerrar sesión de forma segura
    public static function logout()
    {
        session_start();

        // Limpiamos todas las variables de sesión
        $_SESSION = [];

        // Destruimos la cookie de sesión
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }

        // Destruimos la sesión
        session_destroy();

        // Redirigimos al inicio
        header('Location: /');
        exit;
    }
}
