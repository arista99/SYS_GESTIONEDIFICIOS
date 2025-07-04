function cargarEspecie(selectedValue = null) {
    $.ajax({
      url: "listEspecieM",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#edit_esp_mascota");
        select.empty();
  
        // Opcional: si no hay valor seleccionado, mostrar el mensaje por defecto
        // if (!selectedValue) {
        //select.append(`<option disabled selected>Seleccionar Centro de Costo</option>`);
        // }
  
        data.forEach((especie) => {
          const isSelected = selectedValue === especie.descripcion;
          const optionText = isSelected
            ? `${especie.descripcion} - Opción actual`
            : especie.descripcion;
  
          select.append(
            `<option value="${especie.idEspecie}" ${
              isSelected ? "selected" : ""
            }>${optionText}</option>`
          );
        });
      },
      error: function (xhr, status, error) {
        console.error("Error cargando especie:", error);
      },
    });
  };


  function cargarDepartamento(selectedValue = null) {
    $.ajax({
      url: "listaDepartamentoM",
      type: "GET",
      dataType: "json",
      success: function (data) {
        let select = $("#edit_dep_mascota");
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