$(document).ready(function () {
    // Inicializar DataTable
    const tabla = $('#tablaDatos').DataTable({
        ajax: {
            url: 'ListaDepartamento',
            type: 'POST',
            data: function (d) {
                d.nro = $('#nroDepartamento').val();
                d.estado = $('#estadoDepartamento').val();
            }
        },
        columns: [
            { data: 'denominacion' },
            { data: 'nroDepartamento' },
            { data: 'areaM2' },
            { data: 'tipo' },
            { data: 'estado' },
            { data: 'nombres' },
            { data: 'piso' },
            {
                data: 'idDepartamento',
                render: function (data) {
                    return `
                        <button class="btn btn-sm btn-warning btnEditar" data-id="${data}">✏️</button>
                        <button class="btn btn-sm btn-danger btnEliminar" data-id="${data}">🗑️</button>
                    `;
                }
            }
        ]
    });

    // Botón Buscar
    $('#btnBuscar').click(function () {
        tabla.ajax.reload();
    });

    // Guardar nuevo departamento (modal)
    // $('#formCrear').submit(function (e) {
    //     e.preventDefault();
    //     $.post('controlador.php?accion=crearDepartamento', $(this).serialize(), function (resp) {
    //         tabla.ajax.reload();
    //         $('#modalCrear').modal('hide');
    //         $('#formCrear')[0].reset();
    //     });
    // });

    // Acciones de eliminar
    // $('#tablaDatos').on('click', '.btnEliminar', function () {
    //     const id = $(this).data('id');
    //     if (confirm('¿Estás seguro de eliminar este departamento?')) {
    //         $.post('controlador.php?accion=eliminarDepartamento', { id }, function () {
    //             tabla.ajax.reload();
    //         });
    //     }
    // });
});