<main class="contenedor seccion">
        <h2>Crear Propiedad</h2>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>

        <a href="/admin" class="boton-enviar">Volver</a>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            <?php include __DIR__ . "/formulario.php"?>
            <input type="submit" value="Crear Propiedad" class="boton-enviar">
        </form>     
</main>