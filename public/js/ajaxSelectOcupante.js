function cargarSexo(selectedValue = null) {
    $.ajax({
      url: "listaSexoO",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#edit_sexo_ocu");
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
        console.error("Error cargando sexo:", error);
      },
    });
  };


  function cargarDepartamento(selectedValue = null) {
    $.ajax({
      url: "listaDepartamentoO",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#edit_departamento_ocu");
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

  function cargarRelacion(selectedValue = null) {
    $.ajax({
      url: "listRelacionO",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#edit_relacion_ocu");
        select.empty();
  
        // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
        // if (!selectedValue) {
        //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
        // }
  
        data.forEach((relacion) => {
          const isSelected = selectedValue === relacion.descripcion;
          const optionText = isSelected
            ? `${relacion.descripcion} - Opción actual`
            : relacion.descripcion;
  
          select.append(
            `<option value="${relacion.idRelacion}" ${
              isSelected ? "selected" : ""
            }>${optionText}</option>`
          );
        });
      },
      error: function (xhr, status, error) {
        console.error("Error cargando lista relacion:", error);
      },
    });
  }
  