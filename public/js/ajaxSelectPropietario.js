function cargarSexo(selectedValue = null) {
  $.ajax({
    url: "listaSexoP",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_sexo");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if (!selectedValue) {
      //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
      // }

      data.forEach((sexo) => {
        const isSelected = selectedValue === sexo.descripcion;
        const optionText = isSelected
          ? `${sexo.descripcion} - Opción actual`
          : sexo.descripcion;

        select.append(
          `<option value="${sexo.idSexo}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando edificio:", error);
    },
  });
}

function cargarDepartamento(selectedValue = null) {
  $.ajax({
    url: "listDepartamentoP",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_departamento");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if (!selectedValue) {
      //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
      // }

      data.forEach((departamento) => {
        const isSelected = selectedValue === departamento.nroDepartamento;
        const optionText = isSelected
          ? `${departamento.nroDepartamento} - Opción actual`
          : departamento.nroDepartamento;

        select.append(
          `<option value="${departamento.idDepartamento}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando tipo departamento:", error);
    },
  });
}

function cargarNombre(selectedValue = null) {
  $.ajax({
    url: "listaNombreP",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_nombres");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if (!selectedValue) {
      //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
      // }

      data.forEach((nombre) => {
        const isSelected = selectedValue === nombre.nombres;
        const optionText = isSelected
          ? `${nombre.nombres} - Opción actual`
          : nombre.nombres;

        select.append(
          `<option value="${nombre.idUsuario}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando lista usuarios:", error);
    },
  });
}
