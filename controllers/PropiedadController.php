<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    public static function index(Router $router)
    {

        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();

        // Mensaje de alerta
        $mensaje = $_GET["mensaje"] ?? null;

        // Pasamos los registros a la vista
        $router->render("/propiedades/admin", [
            "propiedades" => $propiedades,
            "vendedores" => $vendedores,
            "mensaje" => $mensaje
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        // Arreglo de errores para almacenar campos vacíos
        $errores = Propiedad::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            /* Crea una nueva instancia */
            $propiedad = new Propiedad($_POST["propiedad"]);

            // Generando un nombre único para las imágenes
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Si existe una imágen, entonces pasa la validación
            if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                // Realiza un resize a la imagen con Intervention
                $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);

                // Le pasamos el nombre de la imágen al atributo
                $propiedad->setImagen($nombreImagen);
            }

            // Si hay errores, entonces se solicita al usuario que ingrese bien los datos
            $errores = $propiedad->validar();

            // Verificar que el arreglo $errores esté vacío para insertar los datos a la DB
            if (empty($errores)) {
                // Crear la carpeta para subir imágenes
                if (!is_dir(CARPETA_DE_IMAGENES)) {
                    mkdir(CARPETA_DE_IMAGENES);
                }

                // Guardamos la imágen en el servidor
                $image->save(CARPETA_DE_IMAGENES . $nombreImagen);

                // Guarda todo en la Base de Datos
                $propiedad->guardar();
            }
        }

        $router->render("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarORedireccionar("/admin");

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        // Arreglo de errores para almacenar campos vacíos
        $errores = Propiedad::getErrores();

        // Se ejecuta el código una vez que el usuario envía el formulario
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Asignar los atributos
            $args = $_POST["propiedad"];

            $propiedad->sincronizar($args);

            // Si hay errores, entonces se solicita al usuario que ingrese bien los datos
            $errores = $propiedad->validar();

            // Generando un nombre único para las imágenes
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Si existe una imágen, entonces pasa la validación
            if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                // Realiza un resize a la imagen con Intervention
                $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);

                // Le pasamos el nombre de la imágen al atributo
                $propiedad->setImagen($nombreImagen);
            }

            // Verificar que el arreglo $errores esté vacío para insertar los datos a la DB
            if (empty($errores)) {

                if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                    $image->save(CARPETA_DE_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        }

        $router->render("/propiedades/actualizar", [
            "propiedad" => $propiedad,
            "errores" => $errores,
            "vendedores" => $vendedores
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
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
