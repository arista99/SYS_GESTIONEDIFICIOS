$(document).ready(function () {
    // Inicializar DataTable
    var tabla = $("#tablaDatosUsuario").DataTable({
      ajax: {
        url: "ListaUsuarios",
        type: "POST",
        data: function (d) {
            d.inputCondominio = $("#inputCondominio").val();
            d.inputHabitaciones = $("#inputHabitaciones").val();
        },
      },
      columns: [
        { data: "denominacion" },
        { data: "nroHabitaciones" },
        { data: "nroDepartamento" },
        { data: "tipo" },
        { data: "descripcion" },
      ],
    });

    // Botón Buscar
    $("#btnBuscar").click(function () {
        tabla.ajax.reload(function () {
            // ✅ Leer celdas visibles después de cargar los datos
            if (typeof leerTexto === "function" && lecturaActiva) {
                $("#tablaDatosUsuario tbody td").each(function (i, td) {
                    const texto = td.innerText.trim();
                    if (texto) {
                        const mensaje = new SpeechSynthesisUtterance(texto);
                        mensaje.lang = 'es-ES';
                        window.speechSynthesis.speak(mensaje);
                    }
                });
            }
        });
    });
});