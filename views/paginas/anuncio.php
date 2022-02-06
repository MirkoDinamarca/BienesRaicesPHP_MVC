<section class="contenedor propiedad">
    <h2 data-cy="titulo-propiedad"><?php echo $propiedad->titulo; ?></h2>

    <div class="info-propiedad">
        <img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen Propiedad">

        <p class="precio">$<?php echo $propiedad->precio; ?></p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono-invert" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono-invert" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="icono-invert" src="build/img/icono_dormitorio.svg" alt="icono dormitorios">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>

        <p><?php echo $propiedad->descripcion; ?></p>

    </div>
</section>