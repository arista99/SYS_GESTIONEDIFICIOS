<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Título y botón -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Gestión de Propietarios</h2>
        <!-- Bootstrap 4 - correcto -->
        <?php if ($_SESSION["idRol"] == 4) : ?>
            <button class="btn btn-success" data-toggle="modal" data-target="#modalCrearPropietario">+ Crear nuevo</button>
        <?php endif; ?>
    </div>
    <script>
        const idRol = <?= json_encode($_SESSION['idRol']) ?>;
    </script>
    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" id="nroDni" class="form-control" placeholder="Nro DNI">
        </div>
        <div class="col-md-2">
            <button id="btnBuscar" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>

    <hr class="mt-0 mb-4">

    <!-- Tabla -->
    <div class="row">
        <div class="col-xl-12">
            <div class="table-responsive">
                <table id="tablaDatosPropietario" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombres Completo</th>
                            <th>DNI</th>
                            <th>Celular</th>
                            <th>Email</th>
                            <th>Departamento</th>
                            <th>Estado</th>
                            <th>Dueño Edificio</th>
                            <th>Acciones</th>
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


<!-- Footer -->
<?php include_once('views/modulos/footer.php'); ?>