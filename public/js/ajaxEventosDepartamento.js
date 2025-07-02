$(document).ready(function () {
  // Inicializar DataTable
  var tabla = $("#tablaDatosDepartamento").DataTable({
    ajax: {
      url: "ListaDepartamento",
      type: "POST",
      data: function (d) {
        d.nroDepartamento = $("#nroDepartamento").val();
        d.estadoDepartamento = $("#estadoDepartamento").val();
      },
    },
    columns: [
      { data: "denominacion" },
      { data: "nroHabitaciones" },
      { data: "nroDepartamento" },
      { data: "areaM2" },
      { data: "tipo" },
      { data: "estado" },
      { data: "nombres" },
      { data: "piso" },
      {
        data: "idDepartamento",
        render: function (data, type, row) {
          if (idRol == 4) {
            return `
                            <button class="btn btn-sm btn-warning btnEditar"
                            data-id="${row.idDepartamento}"
                            data-denominacion="${row.denominacion}"
                            data-nrohabitaciones="${row.nroHabitaciones}"
                            data-nrodepartamento="${row.nroDepartamento}"
                            data-area="${row.areaM2}"
                            data-tipo="${row.tipo}"
                            data-estado="${row.estado}"
                            data-nombres="${row.nombres}"
                            data-piso="${row.piso}"
                            data-telefono="${row.telefono}"
                            >
                            ✏️
                            </button>
                            <button class="btn btn-sm btn-danger btnEliminar" data-id="${row.idDepartamento}">🗑️</button>
                        `;
          } else {
            return "";
          }
        },
      },
    ],
    columnDefs: [
      {
        targets: 8,
        visible: idRol == 4, // solo mostrar si rol == 4
        searchable: false,
      },
    ],
  });

  // Botón Buscar
  $("#btnBuscar").click(function () {
    tabla.ajax.reload();
  });

  // Crear Departamento
  $("#saveInfoButtonDepartamento").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      edificio: $("#edificio").val(),
      nro_habitaciones: $("#nro_habitaciones").val(),
      nro_departamento: $("#nro_departamento").val(),
      aream2: $("#aream2").val(),
      tipo_departamento: $("#tipo_departamento").val(),
      estado_departamento: $("#estado_departamento").val(),
      dueno_departamento: $("#dueno_departamento").val(),
      piso_departamento: $("#piso_departamento").val(),
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
          Swal.fire({
            icon: "success",
            title: "Se creo departamento",
            timer: 1500,
            showConfirButton: false,
          }).then(function () {
            $("#modalCrearDepartamento").modal("hide"); // Cerrar el modal
            location.reload(); // Recargar la página
          }); // Mensaje de éxito
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
  $("#tablaDatosDepartamento").on("click", ".btnEditar", function () {
    let btn = $(this);

    $("#idDepartamento").val(btn.data("id"));
    $("#edit_nroHabitaciones").val(btn.data("nrohabitaciones"));
    $("#edit_nroDepartamento").val(btn.data("nrodepartamento"));
    $("#edit_areaM2").val(btn.data("area"));
    $("#edit_piso").val(btn.data("piso"));
    $("#edit_telefono").val(btn.data("telefono"));

    // Llenar selects con valor seleccionado correctamente usando los IDs
    cargarEdificio(btn.data("denominacion"));
    cargarTipo(btn.data("tipo"));
    cargarEstado(btn.data("estado"));
    cargarNombre(btn.data("nombres"));

    $("#modalEditarDepartamento").modal("show"); // Bootstrap 4/5
  });

  // Actualizar Departamento
  $("#formEditarDepartamento").on("submit", function (e) {
    e.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      id: $("#id").val(),
      edit_usuario: $("#edit_usuario").val(),
      edit_usu_red: $("#edit_usu_red").val(),
      edit_centro_costo: $("#edit_centro_costo").val(),
      edit_email: $("#edit_email").val(),
      edit_sede: $("#edit_sede").val(),
      edit_perfil: $("#edit_perfil").val(),
      edit_area: $("#edit_area").val(),
    };

    // console.log(formData);
    $.ajax({
      url: "actualizarDepartamento",
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

          $("#modalEditarDepartamento").modal("hide");
          $("#tablaDatosDepartamento").DataTable().ajax.reload(null, false);
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
  $("#tablaDatosDepartamento").on("click", ".btnEliminar", function () {
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
        $.post("eliminarDepartamento", { id }, function () {
          Swal.fire(
            "¡Eliminado!",
            "El Departamento ha sido eliminado.",
            "success"
          );
          tabla.ajax.reload();
        }).fail(function () {
          Swal.fire(
            "Error",
            "Hubo un problema al eliminar el departamento - tiene un servicio pendiente",
            "error"
          );
        });
      }
    });
  });
});
