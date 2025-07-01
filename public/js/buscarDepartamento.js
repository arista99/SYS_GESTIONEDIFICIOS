$(document).ready(function () {
    // Inicializar DataTable
    var tabla = $('#tablaDatosDepartamento').DataTable({
        ajax: {
            url: 'ListaDepartamento',
            type: 'POST',
            data: function (d) {
                d.nroDepartamento = $('#nroDepartamento').val();
                d.estadoDepartamento = $('#estadoDepartamento').val();
            }
        },
        columns: [
            { data: 'denominacion' },
            { data: 'nroHabitaciones' },
            { data: 'nroDepartamento' },
            { data: 'areaM2' },
            { data: 'tipo' },
            { data: 'estado' },
            { data: 'nombres' },
            { data: 'piso' },
            {
                data: 'idDepartamento',
                render: function (data,type, row) {
                    if (idRol == 4) {
                        return `
                            <button class="btn btn-sm btn-warning btnEditar"
                            data-id="${row.idDepartamento}"
                            data-nrohabitaciones="${row.nroHabitaciones}"
                            data-nrodepartamento="${row.nroDepartamento}"
                            data-area="${row.areaM2}"
                            data-tipo="${row.tipo}"
                            data-estado="${row.estado}"
                            data-nombres="${row.nombres}"
                            data-piso="${row.piso}">
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
        columnsDefs: [
            {
                targets: 8,
                visible: idRol == 4,
                searchable: false
            }
        ]
    });

    // Botón Buscar
    $('#btnBuscar').click(function () {
        tabla.ajax.reload();
    });

});