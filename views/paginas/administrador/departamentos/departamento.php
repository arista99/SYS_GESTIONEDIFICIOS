<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Título y botón -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Gestión de Departamentos</h2>
        <!-- Bootstrap 4 - correcto -->
        <button class="btn btn-success" data-toggle="modal" data-target="#modalCrear">+ Crear nuevo</button>

    </div>

    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" id="nroDepartamento" class="form-control" placeholder="Nro Departamento">
        </div>
        <div class="col-md-4">
            <input type="text" id="estadoDepartamento" class="form-control" placeholder="Estado">
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
                <table id="tablaDatos" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Edificio</th>
                            <th>Nro de Departamento</th>
                            <th>Area M2</th>
                            <th>Tipo de Departamento</th>
                            <th>Estado de Departamento</th>
                            <th>Propietario del Edificio</th>
                            <th>Piso</th>
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

    <!-- Modal Crear -->
    <div class="modal fade" id="modalCrear" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formCrear" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nuevo Departamento</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Cerrar">X</button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="denominacion" class="form-label">Edificio</label>
                        <select name="denominacion" id="denominacion" class="form-control">
                            <option selected disabled>Seleccionar Edificio</option>
                            <?php foreach ($lista_edificios as $edificio) : ?>
                                <option value="<?php echo $edificio->idEdificio ?>"><?php echo $edificio->denominacion ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nro_departamento" class="form-label">Nro de Departamento</label>
                        <input type="text" id="nro_departamento" name="nro_departamento" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="area" class="form-label">Area M2</label>
                        <input type="text" id="area" name="area" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo_deparamento" class="form-label">Tipo de Departamento</label>
                        <select name="tipo_deparamento" id="tipo_deparamento" class="form-control">
                            <option selected disabled>Seleccionar Tipo de Departamento</option>
                            <?php foreach ($listTipoDepartamentos as $tipod) : ?>
                                <option value="<?php echo $tipod->idTipo ?>"><?php echo $tipod->descripcion ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="estado_deparamento" class="form-label">Estado de Departamento</label>
                        <select name="estado_deparamento" id="estado_deparamento" class="form-control">
                            <option selected disabled>Seleccionar Estado de Departamento</option>
                            <?php foreach ($listEstadoDepartamentos as $estadod) : ?>
                                <option value="<?php echo $estadod->idEstado ?>"><?php echo $estadod->descripcion ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="dueno_departamentos" class="form-label">Dueño de Departamentos</label>
                        <input type="text" id="dueno_departamentos" name="dueno_departamentos" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="pisos" class="form-label">Pisos</label>
                        <input type="text" id="pisos" name="pisos" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="dueno_telefono" class="form-label">Telefono de Dueño</label>
                        <input type="text" id="dueno_telefono" name="dueno_telefono" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="saveInfoButton" id="saveInfoButton" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Footer -->
</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Gestion de Activos - Transber <?php echo date("Y"); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Seleccione “Cerrar sesión” a continuación si está listo para finalizar su sesión actual.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="Close">Cerrar sesión</a>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (¡debe ir primero!) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap core JavaScript-->
<script src="public/assets/vendor/jquery/jquery.min.js"></script>
<script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="public/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="public/assets/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="public/assets/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<!-- <script src="public/assets/js/demo/chart-area-demo.js"></script>
    <script src="public/assets/js/demo/chart-pie-demo.js"></script> -->

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- Page level custom scripts -->
<script src="public/assets/js/demo/datatables-demo.js"></script>

<script src="public/js/buscarDepartamento.js"></script>

</body>

</html>