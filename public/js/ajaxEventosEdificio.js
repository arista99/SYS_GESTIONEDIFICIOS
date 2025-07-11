$(document).ready(function () {
  // Inicializar DataTable
  var tabla = $("#tablaDatosEdificio").DataTable({
    ajax: {
      url: "ListaEdificio",
      type: "POST",
      data: function (d) {
        d.denominacion = $("#denominacion").val();
      },
    },
    columns: [
      { data: "denominacion" },
      { data: "direccion" },
      { data: "nroDePisos" },
      { data: "nroDeDepartamentos" },
      { data: "estado" },
      {
        data: "idEdificio",
        render: function (data, type, row) {
          if (idRol == 4) {
            return `
              <button class="btn btn-sm btn-warning btnEditar"
                data-id="${row.idEdificio}"
                data-condominio="${row.denominacion}"
                data-direccion="${row.direccion}"
                data-nropiso="${row.nroDePisos}"
                data-nrodepa="${row.nroDeDepartamentos}"
                data-estado="${row.estado}">
                ✏️
              </button>
              <button class="btn btn-sm btn-danger btnEliminar" data-id="${row.idEdificio}">🗑️</button>
            `;
          } else {
            return "";
          }
        },
      },
    ],
    columnDefs: [
      {
        targets: 5,
        visible: idRol == 4, // solo mostrar si rol == 4
        searchable: false,
      },
    ],
  });

  // Botón Buscar
  $("#btnBuscarEdificio").click(function () {
    tabla.ajax.reload();
  });

  // Crear Edificio
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

    // console.log(formData);

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
            icon: "success",
            title: "Se creo edificio",
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

  // Evento click para llenar el modal de edición
  $("#tablaDatosEdificio").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#idEdificio").val(btn.data("id"));
    $("#edit_condominio").val(btn.data("condominio"));
    $("#edit_direccion").val(btn.data("direccion"));
    $("#edit_nropiso").val(btn.data("nropiso"));
    $("#edit_nrodepa").val(btn.data("nrodepa"));
    $("#edit_estado_con").val(btn.data("estado"));

    $("#modalEditarEdificio").modal("show"); // Bootstrap 4/5
  });

  //Actualizar edificio
  $("#formEditarEdificio").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "actualizarEdificio",
      type: "POST",
      data: $(this).serialize(),
      success: function (response) {
        const res = JSON.parse(response);

        if (res.success) {
          Swal.fire({
            icon: "success",
            title: "Actualizado correctamente",
            showConfirmButton: false,
            timer: 1500,
          });

          $("#modalEditarEdificio").modal("hide");

          // 🔁 Recarga la tabla
          $("#tablaDatosEdificio").DataTable().ajax.reload(null, false);
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: res.message,
          });
        }
      },
      error: function () {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "No se pudo conectar con el servidor.",
        });
      },
    });
  });

  // Acciones de eliminar
  $("#tablaDatosEdificio").on("click", ".btnEliminar", function () {
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
        $.post("eliminarEdificio", { id }, function () {
          Swal.fire(
            "¡Eliminado!",
            "El edificio ha sido eliminado.",
            "success"
          );
          tabla.ajax.reload();
        }).fail(function () {
          Swal.fire(
            "Error",
            "Hubo un problema al eliminar el edificio.",
            "error"
          );
        });
      }
    });
  });
});
