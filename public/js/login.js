window.addEventListener("DOMContentLoaded", () => {
  //LOGEO DE USUARIO VIA AJAX
  $("#btn-loginU").click(function (event) {
    event.preventDefault(); // Evita que el formulario se envíe automáticamente
    //let formData = $("#frmAjaxLogin").serialize(); // Serializa los datos del formulario
    
    let datos = $("#frmAjaxLogin").serialize(); // Serializa los datos del formulario

    //console.log(formData);
    $.ajax({
      type: 'POST',
      url: 'LoginUsuario', // Ruta del controlador PHP
      data: datos,
      dataType: 'json', // Indicamos que esperamos un JSON
      success: function (response) {
        if (response.status === "success") {
          Swal.fire({
            icon: 'success',
            title: 'Bienvenido',
            timer: 1500,
            showConfirmButton: false,
          }).then(function () {
            window.location.href = response.redirect; // Redirige según el rol
          });
        } else {
          Swal.fire({
            icon: 'error',
            title: response.message,
            timer: 2000,
            showConfirmButton: false,
          });
        }
      },
      error: function (xhr, status, error) {
        console.error("AJAX Error:", xhr.responseText);
        Swal.fire({
          icon: 'error',
          title: 'Error en la conexión',
          text: xhr.responseText,
          timer: 3000,
          showConfirmButton: false,
        });
      },
    });
  });
});
