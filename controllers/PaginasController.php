<?php


namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {
        $propiedades = Propiedad::get(3);


        $router->render("/paginas/index", [
            "propiedades" => $propiedades,
        ]);
    }

    public static function nosotros(Router $router) {
        $router->render("/paginas/nosotros");
    }

    public static function anuncios(Router $router) {
        $propiedades = Propiedad::all();

        $router->render("/paginas/anuncios", [
            "propiedades" => $propiedades,
        ]);
    }
    
    public static function anuncio(Router $router) {
        
        $id = validarORedireccionar("/propiedades");

        $propiedad = Propiedad::find($id);

        $router->render("paginas/anuncio", [
            "propiedad" => $propiedad
        ]);
    }

    public static function blog(Router $router) {
        $router->render("/paginas/blog");
    }

    public static function contacto(Router $router) {

        $mensaje = null;

        if($_SERVER["REQUEST_METHOD"] === "POST") {

            $respuestas = $_POST["contacto"];

            // Creando una nueva instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = "smtp.mailtrap.io";
            $mail->SMTPAuth = true;
            $mail->Username = "116bdf4ffb6094";
            $mail->Password = "947a5c40397db2";
            $mail->SMTPSecure = "tls";
            $mail->Port = 2525;
            
            // Configurar el contenido del mail
            $mail->setFrom("admin@bienesraices.com");
            $mail->addAddress("admin@bienesraices.com", "Cipriani.com");           
            $mail->Subject = "Tienes un nuevo Mensaje";

            // Habilitar el HTML
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";


            // Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas["nombre"] . ' </p>';

            // Enviar de forma condicional algunos campos, sean email o telefono
            if($respuestas["contacto"] === "telefono") {
                $contenido .= '<p>Elígio ser contactado a través del teléfono</p>';
                $contenido .= '<p>Teléfono: ' . $respuestas["telefono"] . ' </p>';
                $contenido .= '<p>Fecha: ' . $respuestas["fecha"] . ' </p>';
                $contenido .= '<p>Hora: ' . $respuestas["hora"] . ' </p>';
            } else {
                // De ser E-mail, agregamos el campo de email
                $contenido .= '<p>Elígio ser contactado a través del E-mail</p>';
                $contenido .= '<p>E-mail: ' . $respuestas["email"] . ' </p>';
            }
            $contenido .= '<p>Mensaje: ' . $respuestas["mensaje"] . ' </p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas["tipo"] . ' </p>';
            $contenido .= '<p>Precio: $' . $respuestas["precio"] . ' </p>';
            $contenido .= '</html>';
            $mail->Body = $contenido;

            // Enviar el email
            if($mail->send()) {
                $mensaje = "Mensaje Enviado Correctamente";
            } else {
                $mensaje = "Hubo un error para enviar el mensaje";
            }
        }

        $router->render("/paginas/contactos", [
            "mensaje" => $mensaje,
        ]);
    }
}