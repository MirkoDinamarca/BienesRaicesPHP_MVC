<?php

namespace MVC;

class Router {
    
    // Almacernar URLs
    public $rutasGET = [];
    public $rutasPOST = [];

    // Almacenar rutas GET
    public function get($url, $fn) { // De la URL, le asociamos una función
        $this->rutasGET[$url] = $fn;
    }

    // Almacenar rutas POST
    public function post($url, $fn) { // De la URL, le asociamos una función
        $this->rutasPOST[$url] = $fn;
    }

    // Comprobar que las rutas sean verdaderas
    public function comprobarRutas() {

        session_start();
        $auth = $_SESSION["login"] ?? null;

        // Arreglos de rutas protegidas
        $rutas_protegidas = [
            "/admin", 
            "/propiedades/crear", 
            "/propiedades/actualizar", 
            "/propiedades/eliminar",
            "/vendedores/crear", 
            "/vendedores/actualizar", 
            "/vendedores/eliminar",
        ];

        $urlActual = $_SERVER["PATH_INFO"] ?? "/";
        $metodo = $_SERVER["REQUEST_METHOD"];

        if ($metodo === "GET") {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            header ("Location: /");
        }

        // Si la URL existe y hay una función asociada, entonces..
        if ($fn) {
            call_user_func($fn, $this);
        } else {
            echo "Página no Encontrada";
        }
    }

    // Muestra una vista
    public function render($view, $datos = []) {

        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); // Inicia el almacenamiento en memoria
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpiamos esa memoria y la almacenamos en $contenido

        include __DIR__ . "/views/layout.php";
    }
}