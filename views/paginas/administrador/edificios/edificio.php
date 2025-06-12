<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Título y botón -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Gestión de Edificios</h2>
        <!-- Bootstrap 4 - correcto -->
        <button class="btn btn-success" data-toggle="modal" data-target="#modalCrearEdificio">+ Crear nuevo</button>

    </div>

    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" name="denominacion" id="denominacion" class="form-control" placeholder="Condominio">
        </div>
        <div class="col-md-2">
            <button id="btnBuscarEdificio" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>

    <hr class="mt-0 mb-4">

    <!-- Tabla -->
    <div class="row">
        <div class="col-xl-12">
            <div class="table-responsive">
                <table id="tablaDatosEdificio" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Condominio</th>
                            <th>Dirección</th>
                            <th>Nro de Pisos</th>
                            <th>Nro de Departamentos</th>
                            <th>Estado</th>
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
    <div class="modal fade" id="modalCrearEdificio" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formCrear" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nuevo Edifico</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="condominio" class="form-label">Condominio</label>
                        <input type="text" id="condominio" name="condominio" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Direccion</label>
                        <input type="text" id="direccion" name="direccion" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="nropiso" class="form-label">Nro de Pisos</label>
                        <input type="text" id="nropiso" name="nropiso" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="nrodepa" class="form-label">Nro de Departamentos</label>
                        <input type="text" id="nrodepa" name="nrodepa" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="estado_con" class="form-label">Estado de Condominios</label>
                        <input type="text" id="estado_con" name="estado_con" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal" aria-label="Cerrar">Cerrar</button>
                    <button type="submit" name="saveInfoButtonEdificio" id="saveInfoButtonEdificio" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalEditarEdificio" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEditar" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Edificio</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit_id" name="idEdificio">

                    <div class="mb-3">
                        <label for="edit_condominio" class="form-label">Condominio</label>
                        <input type="text" id="edit_condominio" name="condominio" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit_direccion" class="form-label">Dirección</label>
                        <input type="text" id="edit_direccion" name="direccion" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit_nropiso" class="form-label">Nro de Pisos</label>
                        <input type="text" id="edit_nropiso" name="nropiso" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="edit_nrodepa" class="form-label">Nro de Departamentos</label>
                        <input type="text" id="edit_nrodepa" name="nrodepa" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit_estado_con" class="form-label">Estado de Condominios</label>
                        <input type="text" id="edit_estado_con" name="edit_estado_con" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" name="updateInfoButtonEdificio" id="updateInfoButtonEdificio" class="btn btn-primary">Actualizar</button>
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

<!-- Bootstrap core JavaScript-->
<script src="public/assets/vendor/jquery/jquery.min.js"></script>
<script src="public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="public/assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="public/assets/js/sb-admin-2.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<!-- Page level custom scripts -->
<script src="public/assets/js/demo/datatables-demo.js"></script>

<!-- JS SWEETALERT -->
<script src="vendor/realrashid/sweet-alert/resources/js/sweetalert.all.js"></script>

<script src="public/js/buscarEdificio.js"></script>
<script src="public/js/JSedificio.js"></script>

</body>

</html>