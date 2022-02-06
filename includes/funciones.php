<?php

define("TEMPLATES_URL", __DIR__ . "/templates");
define("FUNCIONES_URL", __DIR__ . "funciones.php");
define("CARPETA_DE_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . "\imagenes/");

function incluirTemplate($nombre) {
    include TEMPLATES_URL . "/${nombre}.php"; // Concatenamos la URL de los templates en una constante
}

function estaAutenticado() {
    session_start();
    
    $auth = $_SESSION["login"];

    if($auth) {
        return true;
    }
    return false;
}

function debuguear($variable) {
    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    exit;
}

// Sanitizar el HTML (IMPORTANTE HACERLO SIEMPRE)
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Validar el tipo de contenido para que un usuario no elimine lo que sea
function validarTipoContenido($tipo) {
    $tipos = ["vendedor", "propiedad"];

    return in_array($tipo, $tipos);
}

// Mostrar los mensajes
function mostrarNotificacion($codigo) {
    $mensaje = "";

    switch ($codigo) {
        case 1:
            $mensaje = "Creado exitosamente";
            break;
        case 2:
            $mensaje = "Actualizado exitosamente";
            break;
        case 3:
            $mensaje = "Eliminado exitosamente";
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}

// Validar si es un ID válido para actualizar o eliminar
function validarORedireccionar(string $url) {
    // Validar que sea un ID correcto
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id) {
        header("Location: ${url}");
    } 

    return $id;
}