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
});