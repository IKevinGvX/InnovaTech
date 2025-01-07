<?php
require_once '../Model/Conexion.php';
require_once '../Controller/ClienteController.php';

$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new ClienteController($db);

if (isset($_GET['id'])) {
    $cliente_id = $_GET['id'];
    $cliente = $controller->obtenerClientePorId($cliente_id);

    if (!$cliente) {
        die('Cliente no encontrado');
    }
}

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['actualizar'])) {
        if (
            !empty($_POST['cliente_id']) &&
            !empty($_POST['usuario_id']) &&
            !empty($_POST['nombre']) &&
            !empty($_POST['apellido']) &&
            !empty($_POST['fecha_nac']) &&
            !empty($_POST['dni']) &&
            !empty($_POST['ruc']) &&
            !empty($_POST['correo']) &&
            !empty($_POST['telefono']) &&
            !empty($_POST['direccion'])
        ) {
            $controller->actualizarCliente(
                $_POST['cliente_id'],
                $_POST['usuario_id'],
                $_POST['nombre'],
                $_POST['apellido'],
                $_POST['fecha_nac'],
                $_POST['dni'],
                $_POST['ruc'],
                $_POST['correo'],
                $_POST['telefono'],
                $_POST['direccion']
            );
            $success = "Cliente actualizado correctamente";
        } else {
            $error = "Por favor, complete todos los campos";
        }
    } elseif (isset($_POST['eliminar'])) {
        $controller->eliminarCliente($_POST['cliente_id']);
        header('Location: clientes.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="Productos/producto.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1>Editar Cliente</h1>

    <div class="form-container">
        <h2>Formulario de Edición</h2>
        <form method="POST">
            <input type="hidden" name="cliente_id" value="<?= $cliente['cliente_id'] ?>">

            <div>
                <label for="usuario_id">Usuario ID</label>
                <select name="usuario_id" id="usuario_id" required>
                    <option value="4" <?= $cliente['usuario_id'] == 4 ? 'selected' : '' ?>>4</option>
                </select>
            </div>

            <div>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" value="<?= $cliente['nombre'] ?>"
                    required>
                <label for="nombre">Nombre</label>
            </div>

            <div>
                <input type="text" name="apellido" id="apellido" placeholder="Apellido"
                    value="<?= $cliente['apellido'] ?>" required>
                <label for="apellido">Apellido</label>
            </div>

            <div>
                <input type="date" name="fecha_nac" id="fecha_nac" value="<?= $cliente['fecha_nac'] ?>" required>
                <label for="fecha_nac">Fecha de Nacimiento</label>
            </div>

            <div>
                <input type="text" name="dni" id="dni" placeholder="DNI" value="<?= $cliente['dni'] ?>" required>
                <label for="dni">DNI</label>
            </div>

            <div>
                <input type="text" name="ruc" id="ruc" placeholder="RUC" value="<?= $cliente['ruc'] ?>" required>
                <label for="ruc">RUC</label>
            </div>

            <div>
                <input type="email" name="correo" id="correo" placeholder="Correo" value="<?= $cliente['correo'] ?>"
                    required>
                <label for="correo">Correo</label>
            </div>

            <div>
                <input type="text" name="telefono" id="telefono" placeholder="Teléfono"
                    value="<?= $cliente['telefono'] ?>" required>
                <label for="telefono">Teléfono</label>
            </div>

            <div>
                <input type="text" name="direccion" id="direccion" placeholder="Dirección"
                    value="<?= $cliente['direccion'] ?>" required>
                <label for="direccion">Dirección</label>
            </div>

            <div class="button-container">
                <button type="submit" name="actualizar" class="btn-fire">Actualizar</button>
                <a class="btn-fire button" href="clientes.php" class="btn-back">Atrás</a>
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
                window.location.href = 'clientes.php';
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