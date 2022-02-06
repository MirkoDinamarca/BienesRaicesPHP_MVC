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
    <link rel="stylesheet" href="/..//build/css/app.css"> <!-- /build/css/app.css -->
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
                    <a href="/nosotros.php">Nosotros</a>
                    <a href="/anuncios.php">Anuncios</a>
                    <a href="/blog.php">Blog</a>
                    <a href="/contactos.php">Contacto</a>  
                    <?php if($auth): ?>
                        <a href="/cerrar-sesion.php">Cerrar Sesión</a>     
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>