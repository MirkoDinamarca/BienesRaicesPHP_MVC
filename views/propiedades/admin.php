<main class="contenedor seccion">
    <h2 data-cy="titulo-administracion">Administrador de Bienes Raíces</h2>

    <?php 
        if($mensaje):
            $resultado = mostrarNotificacion(intval($mensaje)); 
            if ($mensaje): ?>
                <p class="alerta exito"><?php echo s($resultado); ?></p>
    <?php   endif;     
                
        endif; ?>
        

    <a href="/propiedades/crear" class="boton-enviar">Nueva Propiedad</a>
    <a href="/vendedores/crear" class="boton-enviar_naranja">Nuevo(a) Vendedor</a>

    <h3>Propiedades</h3>

    <table class="propiedades">
        <thead>
            <th>ID</th>
            <th>Titulo</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Acciones</th>
        </thead>

        <tbody>
            <!-- Mostrar los resultados desde BD -->
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td><?php echo $propiedad->id; ?></td>
                    <td><?php echo $propiedad->titulo; ?></td>
                    <td> <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-tabla"> </td>
                    <td>$<?php echo $propiedad->precio; ?></td>
                    <td>
                        <a href="propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-actualizar">Actualizar</a>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-eliminar" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Vendedores</h3>

    <table class="propiedades">
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Telefono</th>
            <th>Acciones</th>
        </thead>

        <tbody>
            <!-- Mostrar los resultados desde BD -->
            <?php foreach($vendedores as $vendedor): ?>
                <tr>
                    <td><?php echo $vendedor->id; ?></td>
                    <td><?php echo $vendedor->nombre . " " . $vendedor->apellido ?></td>
                    <td><?php echo $vendedor->telefono; ?></td>
                    <td>
                        <a href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-actualizar">Editar</a>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-eliminar" value="Eliminar">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>