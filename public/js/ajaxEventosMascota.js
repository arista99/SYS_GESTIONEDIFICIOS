$(document).ready(function () {
  // Inicializar DataTable
  var tabla = $("#tablaDatosMascota").DataTable({
    ajax: {
      url: "ListaMascota",
      type: "POST",
      data: function (d) {
        d.mascota = $("#mascota").val();
      },
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
                data-id="${row.idMascota}">
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

  // Botón Buscar
  $("#btnBuscarDni").click(function () {
    tabla.ajax.reload();
  });
});