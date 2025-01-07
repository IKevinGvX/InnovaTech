<?php
require_once '../Model/Conexion.php';
require_once '../Controller/ProveedorController.php';

$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new ProveedorController($db);

if (isset($_GET['id'])) {
    $proveedor_id = $_GET['id'];
    $proveedor = $controller->obtenerProveedorPorId($proveedor_id);

    if (!$proveedor) {
        die('Proveedor no encontrado');
    }
}

$success = null; // Para indicar si se realizó correctamente la operación
$error = null;   // Para capturar errores al procesar el formulario

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['actualizar'])) {
        // Verificar si se completaron todos los campos
        if (
            !empty($_POST['proveedor_id']) &&
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
            $controller->actualizarProveedor(
                $_POST['proveedor_id'],
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
            $success = "Proveedor actualizado correctamente";
        } else {
            $error = "Por favor, complete todos los campos";
        }
    } elseif (isset($_POST['eliminar'])) {
        $controller->eliminarProveedor($_POST['proveedor_id']);
        header('Location: proveedores.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedor</title>
    <link rel="stylesheet" href="Productos/producto.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1>Editar Proveedor</h1>

    <div class="form-container">
        <h2>Formulario de Edición</h2>
        <form method="POST">
            <input type="hidden" name="proveedor_id" value="<?= $proveedor['proveedor_id'] ?>">
            <div>
                <input type="number" name="usuario_id" id="usuario_id" placeholder=" "
                    value="<?= $proveedor['usuario_id'] ?>" required>
                <label for="usuario_id">Usuario ID</label>
            </div>
            <div>
                <input type="text" name="nombre" id="nombre" placeholder=" " value="<?= $proveedor['nombre'] ?>"
                    required>
                <label for="nombre">Nombre</label>
            </div>
            <div>
                <input type="text" name="apellido" id="apellido" placeholder=" " value="<?= $proveedor['apellido'] ?>"
                    required>
                <label for="apellido">Apellido</label>
            </div>
            <div>
                <input type="date" name="fecha_nac" id="fecha_nac" placeholder=" "
                    value="<?= $proveedor['fecha_nac'] ?>" required>
                <label for="fecha_nac">Fecha de Nacimiento</label>
            </div>
            <div>
                <input type="number" name="dni" id="dni" placeholder=" " value="<?= $proveedor['dni'] ?>" required>
                <label for="dni">DNI</label>
            </div>
            <div>
                <input type="text" name="ruc" id="ruc" placeholder=" " value="<?= $proveedor['ruc'] ?>" required>
                <label for="ruc">RUC</label>
            </div>
            <div>
                <input type="email" name="correo" id="correo" placeholder=" " value="<?= $proveedor['correo'] ?>"
                    required>
                <label for="correo">Correo</label>
            </div>
            <div>
                <input type="text" name="telefono" id="telefono" placeholder=" " value="<?= $proveedor['telefono'] ?>"
                    required>
                <label for="telefono">Teléfono</label>
            </div>
            <div>
                <input type="text" name="direccion" id="direccion" placeholder=" "
                    value="<?= $proveedor['direccion'] ?>" required>
                <label for="direccion">Dirección</label>
            </div>
            <div class="button-container">
                <button type="submit" name="actualizar" class="btn-fire">Actualizar</button>
                <a class="btn-fire button" href="proveedores.php" class="btn-back">Atrás</a>
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
                window.location.href = 'proveedores.php';
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