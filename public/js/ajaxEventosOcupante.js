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
                data-id="${row.idOcupante}">
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
});