<main class="contenedor seccion formulario-menu contenido-centrado">
    <h2>Iniciar Sesión</h2>

    <?php foreach ($errores as $error) : ?>
        <div data-cy="alerta-error" class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form data-cy="formulario-login" method="POST" class="formulario" action="/login">
        <fieldset>
            <legend>Email y Password</legend>

            <label for="email">E-Mail</label>
            <input data-cy="input-email" type="email" name="email" placeholder="Tu E-Mail" id="email">

            <label for="password">Password</label>
            <input data-cy="input-password" type="password" name="password" placeholder="Tu Password" id="password">
        </fieldset>

        <input type="submit" value="Iniciar Sesión" class="boton-enviar">
    </form>
</main>