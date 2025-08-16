<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Cita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Agregar Nueva Cita</h2>
        <form action="index.php?action=store" method="POST" id="form-cita" class="mt-4 needs-validation" novalidate>
            <!-- Nombre del Paciente -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Paciente</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required
                    oninput="validarSoloLetras(this)">
                <div class="invalid-feedback">Por favor ingresa solo letras.</div>
            </div>

            <!-- Especialidad -->
            <div class="mb-3">
                <label for="especialidad" class="form-label">Especialidad</label>
                <select class="form-select" id="especialidad" name="especialidad" required>
                    <option value="" selected disabled>Seleccione una especialidad</option>
                    <option value="medicina general">Medicina General</option>
                    <option value="pediatria">Pediatría</option>
                    <option value="dermatologia">Dermatología</option>
                </select>
                <div class="invalid-feedback">Seleccione una especialidad.</div>
            </div>

            <!-- Fecha -->
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha de la Cita</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required min="<?= date('Y-m-d') ?>">
                <div class="invalid-feedback">Seleccione una fecha válida (hoy o en adelante).</div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Cita</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <script>
        // Función para validar solo letras en tiempo real
        function validarSoloLetras(input) {
            const regex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]*$/;
            if (!regex.test(input.value)) {
                input.setCustomValidity("Solo se permiten letras.");
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
            } else {
                input.setCustomValidity("");
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            }
        }

        // Validación del formulario y fecha no pasada
        (() => {
            'use strict';
            const form = document.getElementById('form-cita');
            const fechaInput = document.getElementById('fecha');

            // Evita que se seleccione fecha pasada manualmente
            form.addEventListener('submit', event => {
                const fechaSeleccionada = new Date(fechaInput.value);
                const hoy = new Date();
                hoy.setHours(0, 0, 0, 0);
                
                // Validación general de Bootstrap
                if (!form.checkValidity()) {
                    event.preventDefault(); // Evita envío si hay errores
                    event.stopPropagation();
                }else{
                   // form.reset();
                }

                form.classList.add('was-validated');
            }, false);
        })();
    </script>
</body>

</html>