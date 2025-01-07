<?php
require_once '../Model/Conexion.php';
require_once '../Controller/UsuarioController.php';

$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new UsuarioController($db);

if (isset($_GET['id'])) {
    $usuario_id = $_GET['id'];
    $usuario = $controller->obtenerUsuarioPorId($usuario_id);

    if (!$usuario) {
        die('Usuario no encontrado');
    }
}

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['actualizar'])) {
        if (
            !empty($_POST['usuario_id']) &&
            !empty($_POST['email']) &&
            !empty($_POST['contrasena']) &&
            !empty($_POST['rol_id']) &&
            !empty($_POST['fecha_creacion'])
        ) {
            $actualizacion_exitosa = $controller->actualizarUsuario(
                $_POST['usuario_id'],
                $_POST['email'],
                $_POST['contrasena'],
                $_POST['rol_id'],
                $_POST['fecha_creacion']
            );

            if ($actualizacion_exitosa) {
                $success = "Usuario actualizado correctamente";
            } else {
                $error = "Error al actualizar el usuario";
            }
        } else {
            $error = "Por favor, complete todos los campos";
        }
    } elseif (isset($_POST['eliminar'])) {
        $controller->eliminarUsuario($_POST['usuario_id']);
        header('Location: usuarios.php');
        exit;
    }
}
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="Productos/producto.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1>Editar Usuario</h1>

    <div class="form-container">
        <h2>Formulario de Edición</h2>
        <form method="POST">
            <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>">
            <div>
                <input type="email" name="email" id="email" placeholder=" " value="<?= $usuario['email'] ?>" required>
                <label for="email">Email</label>
            </div>
            <div>
                <input type="text" name="contrasena" id="contrasena" placeholder=" "
                    value="<?= $usuario['contrasena'] ?>" required>
                <label for="contrasena">Contraseña</label>
            </div>
            <div>
                <select name="rol_id" id="rol_id" required>
                    <option value="1" <?= $usuario['rol_id'] == 1 ? 'selected' : '' ?>>Vendedor</option>
                    <option value="4" <?= $usuario['rol_id'] == 4 ? 'selected' : '' ?>>Cliente</option>
                    <option value="5" <?= $usuario['rol_id'] == 5 ? 'selected' : '' ?>>Proveedor</option>
                </select>
                <label for="rol_id">Rol</label>
            </div>
            <div>
                <input type="date" name="fecha_creacion" id="fecha_creacion" placeholder=" "
                    value="<?= date('Y-m-d', strtotime($usuario['fecha_creacion'])) ?>" required>
                <label for="fecha_creacion">Fecha de Creación</label>
            </div>
            <div class="button-container">
                <button type="submit" name="actualizar" class="btn-fire">Actualizar</button>
                <a class="btn-fire button" href="usuarios.php" class="btn-back">Atrás</a>
            </div>
        </form>
    </div>
    <?php if ($success): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '<?= $success ?>', // Elimina las comillas simples alrededor del PHP
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = 'usuarios.php';
            });
        </script>
    <?php endif; ?>

    <?php if ($error): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '<?= $error ?>', // Elimina las comillas simples alrededor del PHP
                confirmButtonText: 'Aceptar'
            });
        </script>
    <?php endif; ?>

</body>

</html>