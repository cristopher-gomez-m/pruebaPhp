<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de Citas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>

    <div class="container mt-5 d-flex justify-content-center">
        <div style="width: 80%;">
            <h1 class="text-center mb-4">Listado de Citas</h1>
            <a href="index.php?action=create" class="btn btn-primary mb-3">Nueva Cita</a>
            <table class="table table-bordered table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Paciente</th>
                        <th>Especialidad</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($citas)): ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay datos disponibles</td>
                        </tr>
                    <?php else: ?>
                        <?php $contador = 1; ?>
                        <?php foreach ($citas as $cita): ?>
                            <tr>
                                <td><?= $contador++ ?></td>
                                <td><?= htmlspecialchars($cita->nombre) ?></td>
                                <td><?= htmlspecialchars($cita->especialidad) ?></td>
                                <td><?= htmlspecialchars(date('d-m-Y', strtotime($cita->fecha))) ?></td>
                                <td>
                                    <button class="btn btn-danger btn-sm btn-eliminar"
                                        data-id="<?= $cita->id ?>">Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>

            </table>

        </div>
    </div>

    <!-- Modal de eliminar -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="modalEliminarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEliminarLabel">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    ¿Está seguro que desea eliminar esta cita?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" class="btn btn-danger" id="btnConfirmarEliminar">Eliminar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de éxito -->
    <div class="modal fade" id="modalExito" tabindex="-1" aria-labelledby="modalExitoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalExitoLabel">Éxito</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    Cita eliminada correctamente.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        const modalEliminar = new bootstrap.Modal(document.getElementById('modalEliminar'));
        const btnConfirmarEliminar = document.getElementById('btnConfirmarEliminar');

        document.querySelectorAll('.btn-eliminar').forEach(btn => {
            btn.addEventListener('click', () => {
                const id = btn.getAttribute('data-id');
                btnConfirmarEliminar.href = `index.php?action=delete&id=${id}`;
                modalEliminar.show();
            });
        });
    </script>

    <script>
        const modalExito = new bootstrap.Modal(document.getElementById('modalExito'));

        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
            modalExito.show();
        <?php endif; ?>
    </script>

</body>

</html>