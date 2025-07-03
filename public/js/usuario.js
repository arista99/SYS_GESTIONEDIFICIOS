$(document).ready(function () {
    let lecturaActiva = false;

    document.addEventListener("DOMContentLoaded", () => {
        const toggleLectura = document.getElementById("toggleLectura");

        // Si existe y es un checkbox
        if (toggleLectura) {
            toggleLectura.addEventListener("change", () => {
                lecturaActiva = toggleLectura.checked;
            });
        }

        // Exponer la función globalmente para que funcione con eventos inline
        window.leerTexto = function (elemento) {
            if (!lecturaActiva) return;

            const texto = elemento.innerText || elemento.getAttribute('aria-label') || elemento.value || '';
            if (!texto) return;

            const mensaje = new SpeechSynthesisUtterance(texto);
            mensaje.lang = 'es-ES';
            window.speechSynthesis.cancel(); // Detener lectura anterior
            window.speechSynthesis.speak(mensaje);
        };
    });
  });