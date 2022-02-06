<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController {
    // Inicia sesión
    public static function login(Router $router) {

        $errores = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            // Creamos una nueva instancia
            $auth = new Admin($_POST);

            // Valida si no hay errores
            $errores = $auth->validar();

            // Si es que no hay errores, entonces...
            if(empty($errores)) {
                // Verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if(!$resultado) {
                    // Usuario Incorrecto, (mensaje de error)
                    $errores = Admin::getErrores();
                } else {
                    // Verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);

                    if($autenticado) {
                        // Autenticar al usuario
                        $auth->autenticar();
                    } else {
                        // Password Incorrecto, (mensaje de error)
                        $errores = Admin::getErrores();
                    }
                }
            }
        }
        // Mostramos las vistas
        $router->render("auth/login", [
            "errores" => $errores,
        ]);
    }

    // Cierra sesión
    public static function logout() {
        session_start();

        $_SESSION = [];

        header("Location: /");
    }
}