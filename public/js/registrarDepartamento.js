window.addEventListener("DOMContentLoaded", () => {
    $(document).ready(function () {
      $("#saveInfoButton").click(function (event) {
        event.preventDefault();
  
        // Obtener los datos del formulario
        var formData = {
          denominacion: $("#denominacion").val(),
          nro_departamento: $("#nro_departamento").val(),
          area: $("#area").val(),
          tipo_deparamento: $("#tipo_deparamento").val(),
          estado_deparamento: $("#estado_deparamento").val(),
          dueno_departamentos: $("#dueno_departamentos").val(),
          piso: $("#piso").val(),
          dueno_telefono: $("#dueno_telefono").val(),
        };
  
        // console.log(formData);
  
        // Realizar la solicitud AJAX
        $.ajax({
          url: "RegistrarDepartamento", // Cambia a la URL de tu controlador
          method: "POST",
          data: formData,
          dataType: "json",
          success: function (response) {
            // Verificar si la solicitud fue exitosa
            if (response.success) {
              alert("Solicitud actualizada correctamente."); // Mensaje de éxito
              $("#exampleModal").modal("hide"); // Cerrar el modal
              location.reload(); // Recargar la página
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