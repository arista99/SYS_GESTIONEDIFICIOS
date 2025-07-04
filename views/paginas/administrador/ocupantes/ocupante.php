<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Título y botón -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Gestión de Ocupante</h2>
        <!-- Bootstrap 4 - correcto -->
        <?php if ($_SESSION["idRol"] == 4) : ?>
            <button class="btn btn-success" data-toggle="modal" data-target="#modalCrearOcupante">+ Crear nuevo</button>
        <?php endif; ?>
    </div>
    <script>
        const idRol = <?= json_encode($_SESSION['idRol']) ?>;
    </script>
    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" id="nrodni" class="form-control" placeholder="Nro DNI">
        </div>
        <div class="col-md-2">
            <button id="btnBuscarDni" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div>

    <hr class="mt-0 mb-4">

    <!-- Tabla -->
    <div class="row">
        <div class="col-xl-12">
            <div class="table-responsive">
                <table id="tablaDatosOcupante" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nro Departamento</th>
                            <th>Nombres Completo</th>
                            <th>Dni</th>
                            <th>Celular</th>
                            <th>Relacion</th>
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
    <div class="modal fade" id="modalCrearOcupante" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="formCrear" autocomplete="off" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nuevo Ocupante</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Cerrar">X</button>
                </div>
                <div class="modal-body">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="nombre_ocu" class="form-label">Nombre</label>
                            <input type="text" id="nombre_ocu" name="nombre_ocu" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="dni_ocu" class="form-label">Dni</label>
                            <input type="text" id="dni_ocu" name="dni_ocu" class="form-control" required>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                                <label for="apep_ocu" class="form-label">Apellido Paterno</label>
                                <input type="text" id="apep_ocu" name="apep_ocu" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apem_ocu" class="form-label">Apellido Materno</label>
                            <input type="text" id="apem_ocu" name="apem_ocu" class="form-control" required>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="celular_ocu" class="form-label">Celular</label>
                            <input type="text" id="celular_ocu" name="celular_ocu" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="estado_ocu" class="form-label">Estado</label>
                            <input type="text" id="estado_ocu" name="estado_ocu" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                            <label for="sexo_ocu" class="form-label">Sexo</label>
                            <select name="sexo_ocu" id="sexo_ocu" class="form-control">
                                <option selected disabled>Seleccionar Sexo Ocupante</option>
                                <?php foreach ($lista_sexo as $lista_s) : ?>
                                    <option value="<?php echo $lista_s->idSexo ?>"><?php echo $lista_s->descripcion ?></option>
                                <?php endforeach; ?>
                            </select>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="relacion_ocu" class="form-label">Relacion</label>
                            <select name="relacion_ocu" id="relacion_ocu" class="form-control">
                                <option selected disabled>Seleccionar Relacion</option>
                                <?php foreach ($lista_relacion as $lista_r) : ?>
                                    <option value="<?php echo $lista_r->idRelacion ?>"><?php echo $lista_r->descripcion ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="departamento_ocu" class="form-label">Departamento</label>
                            <select name="departamento_ocu" id="departamento_ocu" class="form-control">
                                <option selected disabled>Seleccionar Departamento</option>
                                <?php foreach ($lista_departamento as $lista_d) : ?>
                                    <option value="<?php echo $lista_d->idDepartamento ?>"><?php echo $lista_d->nroDepartamento ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="saveInfoButtonOcupante" id="saveInfoButtonOcupante" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditarOcupante" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="formEditarOcupante" autocomplete="off" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nuevo Ocupante</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Cerrar">X</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idOcupante" name="idOcupante">
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="edit_nombre_ocu" class="form-label">Nombre</label>
                            <input type="text" id="edit_nombre_ocu" name="edit_nombre_ocu" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_dni_ocu" class="form-label">Dni</label>
                            <input type="text" id="edit_dni_ocu" name="edit_dni_ocu" class="form-control" required>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                                <label for="edit_apep_ocu" class="form-label">Apellido Paterno</label>
                                <input type="text" id="edit_apep_ocu" name="edit_apep_ocu" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_apem_ocu" class="form-label">Apellido Materno</label>
                            <input type="text" id="edit_apem_ocu" name="edit_apem_ocu" class="form-control" required>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="edit_celular_ocu" class="form-label">Celular</label>
                            <input type="text" id="edit_celular_ocu" name="edit_celular_ocu" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_estado_ocu" class="form-label">Estado</label>
                            <input type="text" id="edit_estado_ocu" name="edit_estado_ocu" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                            <label for="edit_sexo_ocu" class="form-label">Sexo</label>
                            <select name="edit_sexo_ocu" id="edit_sexo_ocu" class="form-control">
                            </select>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label for="edit_relacion_ocu" class="form-label">Relacion</label>
                            <select name="edit_relacion_ocu" id="edit_relacion_ocu" class="form-control">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_departamento_ocu" class="form-label">Departamento</label>
                            <select name="edit_departamento_ocu" id="edit_departamento_ocu" class="form-control">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="updateInfoButtonOcupante" id="updateInfoButtonOcupante" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Footer -->
</div>
<!-- End of Main Content -->

<!-- Footer -->
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

<script src="public/js/ajaxEventosOcupante.js"></script>
<script src="public/js/ajaxSelectOcupante.js"></script>

</body>

</html>