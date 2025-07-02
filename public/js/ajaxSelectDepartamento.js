function cargarEdificio(selectedValue = null) {
  $.ajax({
    url: "listaEdificioD",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_denominacion");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if (!selectedValue) {
      //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
      // }

      data.forEach((edificio) => {
        const isSelected = selectedValue === edificio.denominacion;
        const optionText = isSelected
          ? `${edificio.denominacion} - Opción actual`
          : edificio.denominacion;

        select.append(
          `<option value="${edificio.idEdificio}" ${
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

function cargarTipo(selectedValue = null) {
  $.ajax({
    url: "listaTipoD",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_tipo");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if (!selectedValue) {
      //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
      // }

      data.forEach((tipo) => {
        const isSelected = selectedValue === tipo.descripcion;
        const optionText = isSelected
          ? `${tipo.descripcion} - Opción actual`
          : tipo.descripcion;

        select.append(
          `<option value="${tipo.idTipo}" ${
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

function cargarEstado(selectedValue = null) {
  $.ajax({
    url: "listaEstadoD",
    type: "GET",
    dataType: "json",
    success: function (data) {
      let select = $("#edit_estado");
      select.empty();

      // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
      // if (!selectedValue) {
      //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
      // }

      data.forEach((estado) => {
        const isSelected = selectedValue === estado.descripcion;
        const optionText = isSelected
          ? `${estado.descripcion} - Opción actual`
          : estado.descripcion;

        select.append(
          `<option value="${estado.idEstado}" ${
            isSelected ? "selected" : ""
          }>${optionText}</option>`
        );
      });
    },
    error: function (xhr, status, error) {
      console.error("Error cargando estado departamento:", error);
    },
  });
}

function cargarNombre(selectedValue = null) {
  $.ajax({
    url: "listaNombreD",
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