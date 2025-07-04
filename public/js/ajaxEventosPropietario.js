$(document).ready(function () {
  // Inicializar DataTable
  var tabla = $("#tablaDatosPropietario").DataTable({
    ajax: {
      url: "ListaPropietario",
      type: "POST",
      data: function (d) {
        d.nrodni = $("#nrodni").val();
      },
    },
    columns: [
      { data: "propietario" },
      { data: "dni" },
      { data: "celular" },
      { data: "correo" },
      { data: "nroDepartamento" },
      { data: "estado" },
      { data: "dueno" },
      {
        data: "idPropietario",
        render: function (data, type, row) {
          if (idRol == 4) {
            return `
              <button class="btn btn-sm btn-warning btnEditar"
                data-id="${row.idPropietario}"
                data-propietario="${row.propietario}"
                data-nombres="${row.nombres}"
                data-apepaterno="${row.apePaterno}"
                data-apematerno="${row.apeMaterno}"
                data-dni="${row.dni}"
                data-celular="${row.celular}"
                data-correo="${row.correo}"
                data-sexo="${row.descripcion}"
                data-nrodepartamento="${row.nroDepartamento}"
                data-estado="${row.estado}"
                data-dueno="${row.dueno}">
                ✏️
              </button>
              <button class="btn btn-sm btn-danger btnEliminar" data-id="${row.idPropietario}">🗑️</button>
            `;
          } else {
            return "";
          }
        },
      },
    ],
    columnDefs: [
      {
        targets: 7,
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
   $("#saveInfoButtonPropietario").click(function (event) {
    event.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      nombre_pro: $("#nombre_pro").val(),
      dni_pro: $("#dni_pro").val(),
      apep_pro: $("#apep_pro").val(),
      apem_pro: $("#apem_pro").val(),
      celular_pro: $("#celular_pro").val(),
      correo_pro: $("#correo_pro").val(),
      sexo_pro: $("#sexo_pro").val(),
      departamento_pro: $("#departamento_pro").val(),
      estado_pro: $("#estado_pro").val(),
      dueno_departamento: $("#dueno_departamento").val(),
    };

    // console.log(formData);

    // Realizar la solicitud AJAX
    $.ajax({
      url: "RegistrarPropietario", // Cambia a la URL de tu controlador
      method: "POST",
      data: formData,
      dataType: "json",
      success: function (response) {
        // Verificar si la solicitud fue exitosa
        if (response.success) {
          Swal.fire({
            icon: "success",
            title: "Se creo Propietario",
            timer: 1500,
            showConfirButton: false,
          }).then(function () {
            $("#modalCrearPropietario").modal("hide"); // Cerrar el modal
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
    $("#tablaDatosPropietario").on("click", ".btnEditar", function () {
      let btn = $(this);
  
      $("#idPropietario").val(btn.data("id"));
      $("#edit_nombre_pro").val(btn.data("nombres"));
      $("#edit_apep_pro").val(btn.data("apepaterno"));
      $("#edit_apem_pro").val(btn.data("apematerno"));
      $("#edit_dni_pro").val(btn.data("dni"));
      $("#edit_celular_pro").val(btn.data("celular"));
      $("#edit_correo_pro").val(btn.data("correo"));
      $("#edit_sexo_pro").val(btn.data("sexo"));
      $("#edit_departamento_pro").val(btn.data("nrodepartamento"));
      $("#edit_estado_pro").val(btn.data("estado"));
      $("#edit_dueno_departamento").val(btn.data("dueno"));
  
      // Llenar selects con valor seleccionado correctamente usando los IDs
      cargarSexo(btn.data("denominacion"));
      cargarDepartamento(btn.data("tipo"));
      cargarNombre(btn.data("estado"));
  
      $("#modalEditarPropietario").modal("show"); // Bootstrap 4/5
    });

    // Actualizar Propietario
  $("#formEditarPropietario").on("submit", function (e) {
    e.preventDefault();

    // Obtener los datos del formulario
    var formData = {
      id: $("#idPropietario").val(),
      edit_nombre_pro: $("#edit_nombre_pro").val(),
      edit_apep_pro: $("#edit_apep_pro").val(),
      edit_apep_pro: $("#edit_apep_pro").val(),
      edit_dni_pro: $("#edit_dni_pro").val(),
      edit_celular_pro: $("#edit_celular_pro").val(),
      edit_correo_pro: $("#edit_correo_pro").val(),
      edit_sexo: $("#edit_sexo").val(),
      edit_departamento: $("#edit_departamento").val(),
      edit_estado_pro: $("#edit_estado_pro").val(),
      edit_nombres: $("#edit_nombres").val(),
    };

    // console.log(formData);
    $.ajax({
      url: "ActualizarPropietario",
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

          $("#modalEditarPropietario").modal("hide");
          $("#tablaDatosPropietario").DataTable().ajax.reload(null, false);
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
  $("#tablaDatosPropietario").on("click", ".btnEliminar", function () {
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
        $.post("eliminarPropietario", { id }, function () {
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