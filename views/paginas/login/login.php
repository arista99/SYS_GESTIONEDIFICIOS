
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Gestion de Edificios</title>

    <!-- Custom fonts for this template-->
    <link href="public/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/assets/css/sb-admin-2.min.css" rel="stylesheet"> 

    </head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-4">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col">
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <h3>Gestion de Edificios</h3>
                                        <!-- <img src="public/img/logo.jpg" alt="Logo transber" class="w-75 h-75 img-fluid" style="max-height: 300px;"> -->
                                        <hr class="w-50 mx-auto border-primary">
                                    </div>
                                    <!-- <form action="LoginUsuario" method="POST"> -->
                                    <form id="frmAjaxLogin" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="usuario" name="usuario" placeholder="Usuario" autocomplete="current-username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="contrasena" name="contrasena" placeholder="Contraseña" autocomplete="current-password">
                                        </div>
                                        <hr>
                                        <button id="btn-loginU" class="btn btn-primary w-100">
                                            <i class="fas fa-sign-in-alt"></i> Iniciar Sessión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- JS SWEETALERT -->
    <script src="vendor/realrashid/sweet-alert/resources/js/sweetalert.all.js"></script>

    <!-- JS LOGIN -->
    <script src="public/js/login.js"></script>

    <!-- Bootstrap core JavaScript-->
    <script src="public/assets/vendor/jquery/jquery.min.js"></script>
    <script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="public/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="public/assets/js/sb-admin-2.min.js"></script>

</body>

</html>