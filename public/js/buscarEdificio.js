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
          return `
                        <button class="btn btn-sm btn-warning btnEditar"
                        data-id="${row.idEdificio}"
                        data-condominio="${row.denominacion}"
                        data-direccion="${row.direccion}"
                        data-nropiso="${row.nroDePisos}"
                        data-nrodepa="${row.nroDeDepartamentos}"
                        data-estado="${row.estado}">
                        ✏️</button>
                         <button class="btn btn-sm btn-danger btnEliminar" data-id="${row.idEdificio}">🗑️</button>
                    `;
        },
      },
    ],
  });

  // Botón Buscar
  $("#btnBuscarEdificio").click(function () {
    tabla.ajax.reload();
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
 $('#formEditarEdificio').on('submit', function (e) {
    e.preventDefault();

    // Obtener valores
    const condominio = $('#edit_condominio').val().trim();
    const direccion = $('#edit_direccion').val().trim();
    const nropiso = $('#edit_nropiso').val().trim();
    const nrodepa = $('#edit_nrodepa').val().trim();
    const estado = $('#edit_estado_con').val().trim();

    // Validaciones simples
    if (!condominio || !direccion || !nropiso || !nrodepa || !estado) {
        Swal.fire({
            icon: 'warning',
            title: 'Campos incompletos',
            text: 'Por favor completa todos los campos.'
        });
        return;
    }

    if (isNaN(nropiso) || isNaN(nrodepa)) {
        Swal.fire({
            icon: 'warning',
            title: 'Formato incorrecto',
            text: 'Nro de Pisos y Nro de Departamentos deben ser números.'
        });
        return;
    }


    $.ajax({
        url: 'actualizarEdificio',
        type: 'POST',
        data: $(this).serialize(),
        success: function (response) {
            const res = JSON.parse(response);

            if (res.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Actualizado correctamente',
                    showConfirmButton: false,
                    timer: 1500
                });

                $('#modalEditarEdificio').modal('hide');

                // 🔁 Recarga la tabla
                $('#tablaDatosEdificio').DataTable().ajax.reload(null, false);
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: res.message
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo conectar con el servidor.'
            });
        }
    });
});


  // Acciones de eliminar
  // $('#tablaDatosEdificio').on('click', '.btnEliminar', function () {
  //     const id = $(this).data('id');

  //     Swal.fire({
  //         title: '¿Estás seguro?',
  //         text: "Esta acción no se puede deshacer.",
  //         icon: 'warning',
  //         showCancelButton: true,
  //         confirmButtonColor: '#d33',
  //         cancelButtonColor: '#3085d6',
  //         confirmButtonText: 'Sí, eliminar',
  //         cancelButtonText: 'Cancelar'
  //     }).then((result) => {
  //         if (result.isConfirmed) {
  //             $.post('eliminarEdificio', { id }, function () {
  //                 Swal.fire(
  //                     '¡Eliminado!',
  //                     'El departamento ha sido eliminado.',
  //                     'success'
  //                 );
  //                 tabla.ajax.reload();
  //             }).fail(function () {
  //                 Swal.fire(
  //                     'Error',
  //                     'Hubo un problema al eliminar el departamento.',
  //                     'error'
  //                 );
  //             });
  //         }
  //     });
  // });
});
