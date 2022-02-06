<?php

    if(!isset($_SESSION)) {
        session_start();
    }
    $auth = $_SESSION["login"] ?? false;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/../build/css/app.css"> <!-- /build/css/app.css -->
    <title>Cipriani</title>
</head>

<body>
    <header class="header">
        <div class="contenido-header">
            <a href="/">
                <h2 class="header-titulo">Cipriani</h2>
            </a>

            <div class="derecha">
                <img src="/build/img/dark-mode.svg" alt="boton tema" class="light-mode-boton">
                <nav class="navegacion-principal">
                    <a href="/nosotros">Nosotros</a>
                    <a href="/anuncios">Anuncios</a>
                    <a href="/blog">Blog</a>
                    <a href="/contactos">Contacto</a>
                    <?php if ($auth) : ?>
                        <a href="/logout">Cerrar Sesión</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

    <?php echo $contenido; ?>

    <div class="logo-contactos">
        <div class="seccion-contactos">
            <h2>Contactos</h2>

            <p class="parrafo-titulo">
                Hipólito Yrigoyen 718, Q8300 Neuquén
                <br>
                Tel 2994044950 / 2994873343
                <br>
                Los 7 Días de la semana de 9:00 am a 7:00 pm
            </p>

            <div class="botones-contactos">
                <div class="btn separacion-contacto">
                    <button class="boton-global">Facebook</button>
                </div> 
                <div class="btn separacion-contacto">
                    <button class="boton-global">Whatsapp</button>
                </div> 
            </div>

            <p class="copyright">Todos los derechos Reservados <?php echo date("Y"); ?> &copy;</p>
        </div>
    </div>
    
    <script src="../build/js/bundle.js"></script>
</body>
