$(document).ready(function () {
    // Inicializar DataTable
    var tabla = $('#tablaDatosEdificio').DataTable({
        ajax: {
            url: 'ListaEdificio',
            type: 'POST',
            data: function (d) {
                d.denominacion  = $('#denominacion').val();
            }
        },
        columns: [
            { data: 'denominacion' },
            { data: 'direccion' },
            { data: 'nroDePisos' },
            { data: 'nroDeDepartamentos' },
            { data: 'estado' },
            {
                data: 'idEdificio',
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
                }
            }
        ]
    });

    // Botón Buscar
    $('#btnBuscarEdificio').click(function () {
        tabla.ajax.reload();
    });

    // Acciones de Actualizar

    // $('#tablaDatosEdificio').on('click', '.btnEditar', function () {

    //     var formData = {
    //        id: $('#edit_id').val($(this).data('id'));
    //        condominio:  $('#edit_condominio').val($(this).data('condominio'));
    //        direccion:  $('#edit_direccion').val($(this).data('direccion'));
    //        nropiso:  $('#edit_nropiso').val($(this).data('nropiso'));
    //        nrodepa:  $('#edit_nrodepa').val($(this).data('nrodepa'));
    //        nrodepa:  $('#edit_estado_con').val($(this).data('nrodepa'));
        
    //     };
    //     6*9
    //     $('#modalEditarEdificio').modal('show');
    // });
    

    // Acciones de eliminar
    $('#tablaDatosEdificio').on('click', '.btnEliminar', function () {
        const id = $(this).data('id');
    
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta acción no se puede deshacer.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('eliminarEdificio', { id }, function () {
                    Swal.fire(
                        '¡Eliminado!',
                        'El departamento ha sido eliminado.',
                        'success'
                    );
                    tabla.ajax.reload();
                }).fail(function () {
                    Swal.fire(
                        'Error',
                        'Hubo un problema al eliminar el departamento.',
                        'error'
                    );
                });
            }
        });
    });
    
});