<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Título y botón -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Gestión de Mascota</h2>
        <!-- Bootstrap 4 - correcto -->
        <?php if ($_SESSION["idRol"] == 4) : ?>
            <button class="btn btn-success" data-toggle="modal" data-target="#modalCrearMascota">+ Crear nuevo</button>
        <?php endif; ?>
    </div>
    <script>
        const idRol = <?= json_encode($_SESSION['idRol']) ?>;
    </script>
    <!-- Filtro -->
    <!-- <div class="row mb-3">
        <div class="col-md-4">
            <input type="text" id="nommascota" class="form-control" placeholder="Nro DNI">
        </div>
        <div class="col-md-2">
            <button id="btnBuscarDni" class="btn btn-primary w-100">Buscar</button>
        </div>
    </div> -->

    <hr class="mt-0 mb-4">

    <!-- Tabla -->
    <div class="row">
        <div class="col-xl-12">
            <div class="table-responsive">
                <table id="tablaDatosMascota" class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nro Departamento</th>
                            <th>Mascota</th>
                            <th>Especie</th>
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
    <div class="modal fade" id="modalCrearMascota" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
        <div class="modal-dialog">
        <!-- id="formCrearMascota" -->
            <form id="formCrearMascota" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nuevo Mascota</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="dep_mascota" class="form-label">Nro Departamento</label>
                        <select name="dep_mascota" id="dep_mascota" class="form-control">
                            <option selected disabled>Seleccionar Departamento</option>
                            <?php foreach ($lista_departamento as $lista_d) : ?>
                                <option value="<?php echo $lista_d->idDepartamento ?>"><?php echo $lista_d->nroDepartamento ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nom_mascota" class="form-label">Nombre Mascota</label>
                        <input type="text" id="nom_mascota" name="nom_mascota" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="esp_mascota" class="form-label">Especie Mascota</label>
                        <select name="esp_mascota" id="esp_mascota" class="form-control">
                            <option selected disabled>Seleccionar Especie</option>
                            <?php foreach ($lista_especiemascota as $lista_e) : ?>
                                <option value="<?php echo $lista_e->idEspecie ?>"><?php echo $lista_e->descripcion ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal" aria-label="Cerrar">Cerrar</button>
                    <button type="submit" name="saveInfoButtonMascota" id="saveInfoButtonMascota" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditarMascota" tabindex="-1" aria-labelledby="modalCrearLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEditarMascota" class="modal-content" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nuevo Mascota</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="idMascota" name="idMascota">
                    <div class="mb-3">
                        <label for="edit_dep_mascota" class="form-label">Nro Departamento</label>
                        <select class="form-control text-uppercase" id="edit_dep_mascota" name="edit_dep_mascota">
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nom_mascota" class="form-label">Nombre Mascota</label>
                        <input type="text" id="edit_nom_mascota" name="edit_nom_mascota" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="edit_esp_mascota" class="form-label">Especie Mascota</label>
                        <select class="form-control text-uppercase" id="edit_esp_mascota" name="edit_esp_mascota">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-warning" data-dismiss="modal" aria-label="Cerrar">Cerrar</button>
                    <button type="submit" name="updateInfoButtonMascota" id="updateInfoButtonMascota" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

<script src="public/js/ajaxEventosMascota.js"></script>
<script src="public/js/ajaxSelectMascota.js"></script>

</body>

</html>