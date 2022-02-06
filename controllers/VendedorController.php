<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class VendedorController
{

    public static function crear(Router $router)
    {
        $vendedor = new Vendedor;

        // Arreglo de errores para que no queden campos vacíos
        $errores = Vendedor::getErrores();

        // Se ejecuta el código una vez que el usuario envía el formulario
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Creando una nueva instancia
            $vendedor = new Vendedor($_POST["vendedor"]);

            // Validar que no haya campos vacíos
            $errores = $vendedor->validar();

            // Si no hay errores..
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render("vendedores/crear", [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar("/admin");

        // Buscar ese id en la BD
        $vendedor = Vendedor::find($id);

        $errores = Vendedor::getErrores();

        // Se ejecuta el código una vez que el usuario envía el formulario
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Asignar los atributos
            $args = $_POST["vendedor"];

            //Sincronizar objeto en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args);

            // Asegurarse que no haya errores
            $errores = $vendedor->validar();

            // En caso de no haber errores..
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render("vendedores/actualizar", [
            "vendedor" => $vendedor,
            "errores" => $errores,
        ]);
    }

    public static function eliminar()
    {
        // Validar el ID
        $id = $_POST["id"];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if ($id) {
                $tipo = $_POST["tipo"];
                if (validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
}
