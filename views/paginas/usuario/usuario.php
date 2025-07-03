<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Lista de Departamentos y Mascotas">
    <meta name="author" content="">

    <title>Lista Departamentos - Usuario</title>

    <!-- Font Awesome -->
    <link href="public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

    <!-- SB Admin 2 CSS -->
    <link href="public/assets/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .scroll-to-top-fixed {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1031;
            font-size: 1.25rem;
        }

        .scroll-to-top-fixed:hover {
            background-color: #2e59d9;
            color: white;
        }
    </style>
</head>

<body class="bg-gradient-primary">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-4">
                        <h2 class="mb-0" onmouseover="leerTexto(this)">Lista de Departamentos</h2>

                        <!-- Filtro -->
                        <div class="row mb-4">
                            <div class="col-md-6 col-lg-4">
                            <input type="text" id="inputCondominio" class="form-control" placeholder="Ingrese Condominio" aria-label="Ingrese Condominio" onfocus="leerTexto(this)">
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <input type="text" id="inputHabitaciones" class="form-control" placeholder="Ingrese numero de Habitaciones" aria-label="Ingrese numero de Habitaciones" onfocus="leerTexto(this)">
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <button id="btnBuscar" class="btn btn-primary w-100" onmouseover="leerTexto(this)" onfocus="leerTexto(this)">Buscar</button>
                            </div>
                        </div>

                        <hr class="mt-0 mb-4">

                        <!-- Tabla -->
                        <div class="table-responsive">
                            <table id="tablaDatosUsuario" class="table table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th onmouseover="leerTexto(this)">Condominio</th>
                                        <th onmouseover="leerTexto(this)">Número de Habitaciones</th>
                                        <th onmouseover="leerTexto(this)">Número de Departamento</th>
                                        <th onmouseover="leerTexto(this)">Tipo de Departamento</th>
                                        <th onmouseover="leerTexto(this)">Estado de Departamento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Aquí se llenan los datos dinámicamente -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Interruptor de lectura -->
    <div class="form-check form-switch position-fixed bottom-0 end-0 m-4">
        <input class="form-check-input" type="checkbox" role="switch" id="toggleLectura">
        <label class="form-check-label text-white" for="toggleLectura">
            <i class="fas fa-wheelchair"></i>
        </label>
    </div>

    <!-- Scripts -->
    <!-- jQuery (¡debe ir primero!) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap core JavaScript-->
    <script src="public/assets/vendor/jquery/jquery.min.js"></script>
    <script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="public/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- SB Admin 2 -->
    <script src="public/assets/js/sb-admin-2.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <!-- SweetAlert -->
    <script src="vendor/realrashid/sweet-alert/resources/js/sweetalert.all.js"></script>
    <!-- Tu AJAX y lógica -->
    <script src="public/js/ajaxEventosUsuario.js"></script>

    <!-- Lectura de texto -->
    <script>
        let lecturaActiva = false;

        document.addEventListener("DOMContentLoaded", () => {
            const toggleLectura = document.getElementById("toggleLectura");

            if (toggleLectura) {
                toggleLectura.addEventListener("change", () => {
                    lecturaActiva = toggleLectura.checked;
                    const estado = lecturaActiva ? 'activada' : 'desactivada';
                    const mensaje = new SpeechSynthesisUtterance(`Lectura ${estado}`);
                    mensaje.lang = 'es-ES';
                    window.speechSynthesis.cancel();
                    window.speechSynthesis.speak(mensaje);
                });
            }
        });

        // Hacer disponible globalmente
        function leerTexto(elemento) {
            if (!lecturaActiva) return;

            const texto = elemento.innerText || elemento.getAttribute('aria-label') || elemento.value || '';
            if (!texto) return;

            const mensaje = new SpeechSynthesisUtterance(texto);
            mensaje.lang = 'es-ES';
            window.speechSynthesis.cancel(); // Detiene lectura anterior
            window.speechSynthesis.speak(mensaje);
        }
    </script>

</body>

</html>
