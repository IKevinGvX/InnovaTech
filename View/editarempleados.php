<?php
require_once '../Model/Conexion.php';
require_once '../Controller/EmpleadoController.php';

$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new EmpleadoController($db);

if (isset($_GET['id'])) {
    $empleado_id = $_GET['id'];
    $empleado = $controller->obtenerEmpleadoPorId($empleado_id);

    if (!$empleado) {
        die('Empleado no encontrado');
    }
}

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['actualizar'])) {
        if (
            !empty($_POST['empleadoid']) &&
            !empty($_POST['usuario_id']) &&
            !empty($_POST['rango']) &&
            !empty($_POST['nombre']) &&
            !empty($_POST['apellido']) &&
            !empty($_POST['fecha_nac']) &&
            !empty($_POST['dni']) &&
            !empty($_POST['correo']) &&
            !empty($_POST['telefono']) &&
            !empty($_POST['direccion'])
        ) {
            $controller->actualizarEmpleado(
                $_POST['empleadoid'],
                $_POST['usuario_id'],
                $_POST['rango'],
                $_POST['nombre'],
                $_POST['apellido'],
                $_POST['fecha_nac'],
                $_POST['dni'],
                $_POST['correo'],
                $_POST['telefono'],
                $_POST['direccion']
            );
            $success = "Empleado actualizado correctamente.";
        } else {
            $error = "Por favor, complete todos los campos.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado</title>
    <link rel="stylesheet" href="Productos/producto.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1>Editar Empleado</h1>

    <div class="form-container">
        <h2>Formulario de Edición</h2>
        <form method="POST">
            <input type="hidden" name="empleadoid" value="<?= $empleado['empleadoid'] ?>">
            <div>
                <label for="usuario_id">Usuario ID</label>
                <select name="usuario_id" id="usuario_id" required>
                    <option value="1" <?= $empleado['usuario_id'] == 1 ? 'selected' : '' ?>>1</option>
                </select>
            </div>
            <div>
                <input type="text" name="rango" id="rango" placeholder=" " value="<?= $empleado['rango'] ?>" required>
                <label for="rango">Rango</label>
            </div>
            <div>
                <input type="text" name="nombre" id="nombre" placeholder=" " value="<?= $empleado['nombre'] ?>"
                    required>
                <label for="nombre">Nombre</label>
            </div>
            <div>
                <input type="text" name="apellido" id="apellido" placeholder=" " value="<?= $empleado['apellido'] ?>"
                    required>
                <label for="apellido">Apellido</label>
            </div>
            <div>
                <input type="date" name="fecha_nac" id="fecha_nac" placeholder=" " value="<?= $empleado['fecha_nac'] ?>"
                    required>
                <label for="fecha_nac">Fecha de Nacimiento</label>
            </div>
            <div>
                <input type="number" name="dni" id="dni" placeholder=" " value="<?= $empleado['dni'] ?>" required>
                <label for="dni">DNI</label>
            </div>
            <div>
                <input type="email" name="correo" id="correo" placeholder=" " value="<?= $empleado['correo'] ?>"
                    required>
                <label for="correo">Correo</label>
            </div>
            <div>
                <input type="text" name="telefono" id="telefono" placeholder=" " value="<?= $empleado['telefono'] ?>"
                    required>
                <label for="telefono">Teléfono</label>
            </div>
            <div>
                <input type="text" name="direccion" id="direccion" placeholder=" " value="<?= $empleado['direccion'] ?>"
                    required>
                <label for="direccion">Dirección</label>
            </div>
            <div class="button-container">
                <button type="submit" name="actualizar" class="btn-fire">Actualizar</button>
                <a class="btn-fire button" href="empleados.php" class="btn-back">Atrás</a>
            </div>
        </form>
    </div>

    <?php if ($success): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '<?= $success ?>',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = 'empleados.php';
            });
        </script>
    <?php endif; ?>

    <?php if ($error): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '<?= $error ?>',
                confirmButtonText: 'Aceptar'
            });
        </script>
    <?php endif; ?>

</body>

</html>