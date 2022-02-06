<section class="logo-header">
        <div class="titulo-principal">
            <hr class="border-h1" color="#EEAD31">
            <h1 class="titulo">Cipriani</h1>
            <h2 class="span">Negocios Inmobiliarios</h2>
            <hr class="border-h1" color="#EEAD31">

            <p class="parrafo-titulo light">
                Hipólito Yrigoyen 718, Q8300 Neuquén
                <br>
                Tel 2994044950 / 2994873343
                <br>
                Los 7 Días de la semana de 9:00 am a 7:00 pm
            </p>
        </div>

    </section>

    <main class="contenedor seccion">
        <h2>Bienvenido</h2>
        <?php include "iconos.php"; ?>
    </main>

    <section data-cy="anuncios-index" class="anuncios seccion contenedor">
        <h2>Casas y Departamentos en Ventas</h2>

        <?php
        $limite = 3;
        include "listado.php";
        ?>

        <div class="btn">
            <a data-cy="ver-propiedades" href="anuncios" class="boton-global">Ver más</a>
        </div>

    </section>

    <section class="imagen-contacto">
        <h3>Encuentra la casa de tus sueños</h3>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad</p>
        <a href="contactos" class="boton-contacto">Contactános</a>
    </section>

    <div class="contenedor seccion seccion-inferior">

        <section class="blog">
            <h3>Nuestro Blog</h3>

            <article class="entrada-blog">
                <div class="imagen-blog">
                    <picture>
                        <source srcset="build/img/blog1.webp" type="image/webp">
                        <source srcset="build/img/blog1.jpg" type="image/jpg">
                        <img loading="lazy" src="build/img/blog1.jpg" alt="blog">
                    </picture>
                </div>

                <div class="texto-blog">
                    <a href="blog">
                        <h4>Terraza en el techo de tu casa</h4>
                    </a>
                    <p class="informacion-blog">Escrito el: <span>20/10/2021</span> por: <span>Admin</span> </p>
                    <p>Consejos para construir una terraza en el techo de tu <br> casa con los mejores materiales y ahorrando dinero</p>
                </div>

            </article>

            <article class="entrada-blog">
                <div class="imagen-blog">
                    <picture>
                        <source srcset="build/img/blog2.webp" type="image/webp">
                        <source srcset="build/img/blog2.jpg" type="image/jpg">
                        <img loading="lazy" src="build/img/blog2.jpg" alt="blog">
                    </picture>
                </div>

                <div class="texto-blog">
                    <a href="blog">
                        <h4>Guía para la decoración de tu hogar</h4>
                    </a>
                    <p class="informacion-blog">Escrito el: <span>20/10/2021</span> por: <span>Admin</span> </p>
                    <p>Maximiza el espacio en tu hogar con esta guia, aprende a combinar muebles y colores para darle vida a tu espacio</p>
                </div>

            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- Rodriguez, Emilia</p>
            </div>

        </section>

    </div>
    </body>

</html>