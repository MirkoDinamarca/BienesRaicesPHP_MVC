document.addEventListener("DOMContentLoaded", function() {

    eventListeners();

    lightMode();

});

function lightMode() {

    const prefiereLightMode = window.matchMedia("(prefers-color-scheme: light)");
    // console.log(prefiereLightMode.matches);

    if(prefiereLightMode.matches) {
        document.body.classList.add("light-mode");
    } else {
        document.body.classList.remove("light-mode");
    }

    prefiereLightMode.addEventListener("change", function() {
        if(prefiereLightMode.matches) {
            document.body.classList.add("light-mode");
        } else {
            document.body.classList.remove("light-mode");
        }
    });

    const botonLightMode = document.querySelector(".light-mode-boton");

    botonLightMode.addEventListener("click", function() {
        document.body.classList.toggle("light-mode");

        //Para que el modo elegido se quede guardado en local-storage
        if (document.body.classList.contains('light-mode')) {
            localStorage.setItem('modo-light','true');
        } else {
            localStorage.setItem('modo-light','false');
        }
    });

     //Obtenemos el modo del color actual
     if (localStorage.getItem('modo-light') === 'true') {
        document.body.classList.add('light-mode');
    } else {
        document.body.classList.remove('light-mode');
    }
}

function eventListeners() {
    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input => input.addEventListener("click", mostrarMetodosContacto));

}

function mostrarMetodosContacto(e) {
    const contactoDiv = document.querySelector("#contacto");
    // console.log(e.target.value);
    if (e.target.value === "telefono") {
        contactoDiv.innerHTML = `
            <label for="telefono">Ingrese su Teléfono</label>
            <input data-cy="input-telefono" type="tel" placeholder="Tu Teléfono" id="telefono" name="contacto[telefono]">

            <p>Elija la fecha y la hora del encuentro</p>

            <label for="fecha">Fecha</label>
            <input data-cy="input-fecha" type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora</label>
            <input data-cy="input-hora" type="time" id="hora" min="09:00" max="20:00" name="contacto[hora]">
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email">Ingrese su E-Mail</label>
            <input data-cy="input-email" type="email" placeholder="Tu E-Mail" id="email" name="contacto[email]" required>
        `;
    }
    // contactoDiv.textContent = "Diste click";
}