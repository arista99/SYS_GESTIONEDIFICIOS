<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Filtro de búsqueda -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" id="filtro" class="form-control" placeholder="Buscar por nombre, código, etc.">
        </div>
        <div class="col-md-2">
            <button id="btnBuscar" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="table-responsive">
                <table id="tablaDatos" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Fecha</th>
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