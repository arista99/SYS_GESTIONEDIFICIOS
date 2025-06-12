window.addEventListener("DOMContentLoaded", () => {
    $(document).ready(function () {
        $("#saveInfoButtonEdificio").click(function (event) {
            event.preventDefault();

            // Obtener los datos del formulario
            var formData = {
                condominio: $("#condominio").val(),
                direccion: $("#direccion").val(),
                nropiso: $("#nropiso").val(),
                nrodepa: $("#nrodepa").val(),
                estado_con: $("#estado_con").val(),
            };

            console.log(formData);

            // Realizar la solicitud AJAX
            $.ajax({
                url: "registrarEdificio", // Cambia a la URL de tu controlador
                method: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    // Verificar si la solicitud fue exitosa
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Se creo departamento',
                            timer: 1500,
                            showConfirButton: false,
                        }).then(function () {
                            $("#modalCrearEdificio").modal("hide"); // Cerrar el modal
                            location.reload(); // Recargar la página
                        });

                    } else {
                        alert("Error: " + response.message); // Mostrar el mensaje de error del servidor
                    }
                },
                error: function (xhr, status, error) {
                    // Manejar errores de la solicitud AJAX
                    console.error("Error en la solicitud AJAX:", error);
                    console.error("Respuesta del servidor:", xhr.responseText); // Mostrar la respuesta en la consola
                    alert(
                        "Ocurrió un error al procesar la solicitud. Por favor, intenta nuevamente."
                    );
                },
            });
        });
    });
});
