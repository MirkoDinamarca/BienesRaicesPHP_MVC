<main class="contenedor seccion">
        <h2>Editar Vendedor(a)</h2>

        <a href="/admin" class="boton-enviar">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>

        <?php endforeach; ?>

        <form class="formulario" method="POST">
            <?php include  __DIR__ . "/formulario.php"?>
            <input type="submit" value="Guardar Cambios" class="boton-enviar">
        </form>
</main>