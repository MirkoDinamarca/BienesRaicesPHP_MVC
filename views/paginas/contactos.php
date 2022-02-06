<main class="contenedor seccion formulario-menu">
    <h2>Contactos</h2>

    <!-- Mensaje de Alerta cuando se envía el formulario -->
    <?php if($mensaje): ?>
        <p data-cy="alerta-mensaje" class='alerta exito'><?php echo $mensaje; ?></p>;
    <?php endif;?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpg">
        <img loading="lazy" srcset="build/img/destacada3.jpg" src="" alt="Imagen Contacto">
    </picture>

    <h3>Llene el formulario de Contacto</h3>

    <form data-cy="formulario-contacto" class="formulario" action="/contactos" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input data-cy="input-nombre" type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" required>

            

            <label for="mensaje">Mensaje:</label>
            <textarea data-cy="input-mensaje" id="mensaje" cols="30" rows="10" name="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o Compra</label>
            <select data-cy="input-opciones" id="opciones" name="contacto[tipo]" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="vende">Vende</option>
                <option value="compra">Compra</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input data-cy="input-precio" type="number" placeholder="Tu Precio o Presupuesto" id="presupuesto" name="contacto[precio]" required>
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>

            <p>Como desea ser contactado</p>

            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input data-cy="forma-contacto" type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                <label for="contactar-email">E-Mail</label>
                <input data-cy="forma-contacto" type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
            </div>

            <div id="contacto"></div>
        </fieldset>

        <input type="submit" value="Enviar" class="boton-enviar">
    </form>
</main>
</body>

</html>