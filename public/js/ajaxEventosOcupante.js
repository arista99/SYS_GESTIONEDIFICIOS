$(document).ready(function () {
  // Inicializar DataTable
  var tabla = $("#tablaDatosOcupante").DataTable({
    ajax: {
      url: "ListaOcupante",
      type: "POST",
      data: function (d) {
        d.nrodni = $("#nrodni").val();
      },
    },
    columns: [
      { data: "nroDepartamento" },
      { data: "ocupante" },
      { data: "dni" },
      { data: "celular" },
      { data: "relacion" },
      { data: "estado" },
      {
        data: "idOcupante",
        render: function (data, type, row) {
          if (idRol == 4) {
            return `
              <button class="btn btn-sm btn-warning btnEditar"
                data-id="${row.idOcupante}"
                data-nrodepartamento="${row.nroDepartamento}"
                data-nombres="${row.nombres}"
                data-apepaterno="${row.apePaterno}"
                data-apematerno="${row.apeMaterno}"
                data-dni="${row.dni}"
                data-celular="${row.celular}"
                data-sexo="${row.sexoo}"
                data-relacion="${row.relacion}"
                data-estado="${row.estado}"
                >
                ✏️
              </button>
              <button class="btn btn-sm btn-danger btnEliminar" data-id="${row.idOcupante}">🗑️</button>
            `;
          } else {
            return "";
          }
        },
      },
    ],
    columnDefs: [
      {
        targets: 6,
        visible: idRol == 4, // solo mostrar si rol == 4
        searchable: false,
      },
    ],
  });

  // Botón Buscar
  $("#btnBuscarDni").click(function () {
    tabla.ajax.reload();
  });

  // Crear Propietario
  $("#saveInfoButtonOcupante").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      departamento_ocu: $("#departamento_ocu").val(),
      nombre_ocu: $("#nombre_ocu").val(),
      apep_ocu: $("#apep_ocu").val(),
      apem_ocu: $("#apem_ocu").val(),
      dni_ocu: $("#dni_ocu").val(),
      celular_ocu: $("#celular_ocu").val(),
      sexo_ocu: $("#sexo_ocu").val(),
      relacion_ocu: $("#relacion_ocu").val(),
      estado_ocu: $("#estado_ocu").val(),
    };

    // console.log(formData);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "RegistrarOcupante", // Cambia a la URL de tu controlador
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        // Verificar si la solicitud fue exitosa
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Se creo Ocupante",
            timer: 1500,
            showConfirButton: false,
          }).then(function () {
            $("#modalCrearOcupante").modal("hide"); // Cerrar el modal
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
  $("#tablaDatosOcupante").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#idOcupante").val(btn.data("id"));
    $("#edit_nombre_ocu").val(btn.data("nombres"));
    $("#edit_apep_ocu").val(btn.data("apepaterno"));
    $("#edit_apem_ocu").val(btn.data("apematerno"));
    $("#edit_dni_ocu").val(btn.data("dni"));
    $("#edit_celular_ocu").val(btn.data("celular"));
    $("#edit_estado_ocu").val(btn.data("estado"));

    // Llenar selects con valor seleccionado correctamente usando los IDs
    cargarSexo(btn.data("sexo"));
    cargarDepartamento(btn.data("nrodepartamento"));
    cargarRelacion(btn.data("relacion"));

    $("#modalEditarOcupante").modal("show"); // Bootstrap 4/5
  });

   // Actualizar Ocupante
   $("#formEditarOcupante").on("submit", function (e) {
    e.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      id: $("#idOcupante").val(),
      edit_departamento_ocu: $("#edit_departamento_ocu").val(),
      edit_nombre_ocu: $("#edit_nombre_ocu").val(),
      edit_apep_ocu: $("#edit_apep_ocu").val(),
      edit_apem_ocu: $("#edit_apem_ocu").val(),
      edit_dni_ocu: $("#edit_dni_ocu").val(),
      edit_celular_ocu: $("#edit_celular_ocu").val(),
      edit_sexo_ocu: $("#edit_sexo_ocu").val(),
      edit_relacion_ocu: $("#edit_relacion_ocu").val(),
      edit_estado_ocu: $("#edit_estado_ocu").val(),
    };

    // console.log(formData);
    $.ajax({
      url: "ActualizarOcupante",
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

          $("#modalEditarOcupante").modal("hide");
          $("#tablaDatosOcupante").DataTable().ajax.reload(null, false);
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
  $("#tablaDatosOcupante").on("click", ".btnEliminar", function () {
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
        $.post("eliminarOcupante", { id }, function () {
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
