$(document).ready(function () {
  // Inicializar DataTable
  var tabla = $("#tablaDatosMascota").DataTable({
    ajax: {
      url: "ListaMascota",
      type: "POST",
    },
    columns: [
      { data: "nroDepartamento" },
      { data: "nombre" },
      { data: "descripcion" },
      {
        data: "idMascota",
        render: function (data, type, row) {
          if (idRol == 4) {
            return `
              <button class="btn btn-sm btn-warning btnEditar"
                data-id="${row.idMascota}"
                data-nrodepartamento="${row.nroDepartamento}"
                data-nombre="${row.nombre}"
                data-descripcion="${row.descripcion}"
                >
                ✏️
              </button>
              <button class="btn btn-sm btn-danger btnEliminar" data-id="${row.idMascota}">🗑️</button>
            `;
          } else {
            return "";
          }
        },
      },
    ],
    columnDefs: [
      {
        targets: 3,
        visible: idRol == 4, // solo mostrar si rol == 4
        searchable: false,
      },
    ],
  });

  // Crear Mascota
  $("#saveInfoButtonMascota").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      dep_mascota: $("#dep_mascota").val(),
      nom_mascota: $("#nom_mascota").val(),
      esp_mascota: $("#esp_mascota").val(),
    };

    // console.log(formData);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "RegistrarMascota", // Cambia a la URL de tu controlador
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        // Verificar si la solicitud fue exitosa
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Se creo Mascota",
            timer: 1500,
            showConfirButton: false,
          }).then(function () {
            $("#modalCrearMascota").modal("hide"); // Cerrar el modal
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

  
  // Evento click para llenar el modal de edición
  $("#tablaDatosMascota").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#idMascota").val(btn.data("id"));
    $("#edit_nom_mascota").val(btn.data("nombre"));


    // Llenar selects con valor seleccionado correctamente usando los IDs
    cargarDepartamento(btn.data("nrodepartamento"));
    cargarEspecie(btn.data("descripcion"));

    $("#modalEditarMascota").modal("show"); // Bootstrap 4/5
  });

   // Actualizar Ocupante
   $("#formEditarMascota").on("submit", function (e) {
    e.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      id: $("#idMascota").val(),
      edit_dep_mascota: $("#edit_dep_mascota").val(),
      edit_nom_mascota: $("#edit_nom_mascota").val(),
      edit_esp_mascota: $("#edit_esp_mascota").val(),
    };

    // console.log(formData);
    $.ajax({
      url: "ActualizarMascota",
      type: "POST",
      // data: formData,
      data: $(this).serialize(),
      dataType: "json", // ✅ Asegura que jQuery ya lo parsee
      success: function (response) {
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Actualizado correctamente",
            showConfirmButton: false,
            timer: 1500,
          });

          $("#modalEditarMascota").modal("hide");
          $("#tablaDatosMascota").DataTable().ajax.reload(null, false);
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response.message || "Ocurrió un error al actualizar.",
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("Error AJAX:", error);
        console.error("Respuesta:", xhr.responseText);

        Swal.fire({
          icon: "error",
          title: "Error de servidor",
          text: "No se pudo procesar la solicitud. Intenta más tarde.",
        });
      },
    });
  });

  // Acciones de eliminar
  $("#tablaDatosMascota").on("click", ".btnEliminar", function () {
    const id = $(this).data("id");

    Swal.fire({
      title: "¿Estás seguro?",
      text: "Esta acción no se puede deshacer.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.post("eliminarMascota", { id }, function () {
          Swal.fire(
            "¡Eliminado!",
            "El Propietario ha sido eliminado.",
            "success"
          );
          tabla.ajax.reload();
        }).fail(function () {
          Swal.fire(
            "Error",
            "Hubo un problema al eliminar propietario",
            "error"
          );
        });
      }
    });
  });

});