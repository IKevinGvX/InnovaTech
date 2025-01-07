<?php
require_once '../Model/Conexion.php';
require_once '../Controller/AlmacenController.php';


$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new AlmacenController($db);

if (isset($_GET['id'])) {
    $almacenid = $_GET['id'];
    $almacen = $controller->obtenerAlmacenPorId($almacenid);

    if (!$almacen) {
        die('Almacen no encontrado');
    }
}

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['actualizar'])) {
        if (
            !empty($_POST['almacenid']) &&
            !empty($_POST['nombrealmacen']) &&
            !empty($_POST['direccionalmacen'])
        ) {
            $controller->actualizarAlmacen(
                $_POST['almacenid'],
                $_POST['nombrealmacen'],
                $_POST['direccionalmacen']
            );
            $success = "Almacen actualizado correctamente";
        } else {
            $error = "Por favor, complete todos los campos";
        }
    } elseif (isset($_POST['eliminar'])) {
        $controller->eliminarProducto($_POST['almacenid']);
        header('Location: almacenes.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Almacen</title>
    <link rel="stylesheet" href="Productos/producto.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1>Editar Almacen</h1>

    <div class="form-container">
        <h2>Formulario de Edición</h2>
        <form method="POST">
            <input type="hidden" name="almacenid" value="<?= $almacen['almacenid'] ?>">
            <div>
                <input type="text" name="nombrealmacen" id="nombrealmacen" placeholder=" "
                    value="<?= $almacen['nombrealmacen'] ?>" required>
                <label for="nombre">Nombre</label>
            </div>
            <div>
                <input type="text" name="direccionalmacen" id="direccionalmacen" placeholder=" " step="0.01"
                    value="<?= $almacen['direccionalmacen'] ?>" required>
                <label for="direccionalmacen">Direccion</label>
            </div>
            <div class="button-container">
                <button type="submit" name="actualizar" class="btn-fire">Actualizar</button>
                <a class="btn-fire button" href="almacenes.php" class="btn-back">Atrás</a>
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
                window.location.href = 'almacenes.php';
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