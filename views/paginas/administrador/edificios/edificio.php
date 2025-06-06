<!-- Header -->
<?php include_once('views/modulos/head.php'); ?>

<!-- Topbar Navbar -->
<?php include_once('views/modulos/nav.php'); ?>

<div class="container-xl px-4 mt-4">
    <!-- Título y botón -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Gestión de Edificio</h2>
        <!-- Bootstrap 4 - correcto -->
        <button class="btn btn-success" data-toggle="modal" data-target="#modalCrear">+ Crear nuevo</button>

    </div>

    <!-- Filtro -->
    <div class="row mb-3">
        <div class="col-md-6">
            <input type="text" id="filtro" class="form-control" placeholder="Buscar por denominación, pisos, etc.">
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
                            <th>Denominación</th>
                            <th>Nro de Pisos</th>
                            <th>Fecha de Registro</th>
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
            <form id="formCrear" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear nuevo registro</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Cerrar">X</button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="denominacion" class="form-label">Denominación</label>
                        <input type="text" id="denominacion" name="denominacion" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="pisos" class="form-label">Nro de Pisos</label>
                        <input type="number" id="pisos" name="pisos" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha de Registro</label>
                        <input type="date" id="fecha" name="fecha" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        const tabla = $('#tablaDatos').DataTable();

        // Filtro de búsqueda
        $('#btnBuscar').click(function () {
            const valor = $('#filtro').val();
            tabla.search(valor).draw();
        });

        // Agregar nuevo registro
        $('#formCrear').submit(function (e) {
            e.preventDefault();

            const denominacion = $('#denominacion').val();
            const pisos = $('#pisos').val();
            const fecha = $('#fecha').val();

            tabla.row.add([
                denominacion,
                pisos,
                fecha,
                `
                <button class="btn btn-sm btn-warning btnEditar">Editar</button>
                <button class="btn btn-sm btn-danger btnEliminar">Eliminar</button>
                `
            ]).draw();

            $('#modalCrear').modal('hide');
            this.reset();
        });

        // Eliminar fila
        $('#tablaDatos tbody').on('click', '.btnEliminar', function () {
            if (confirm('¿Estás seguro de eliminar este registro?')) {
                tabla.row($(this).parents('tr')).remove().draw();
            }
        });

        // Editar fila (puedes abrir otro modal aquí si deseas)
        $('#tablaDatos tbody').on('click', '.btnEditar', function () {
            const fila = tabla.row($(this).parents('tr')).data();
            alert(`Editar: ${fila[0]} (${fila[1]} pisos, fecha: ${fila[2]})`);
        });
    });
</script>

<!-- Footer -->
<?php include_once('views/modulos/footer.php'); ?>
