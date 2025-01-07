<?php
require_once '../Model/Conexion.php';
require_once '../Controller/ProductoController.php';

$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new ProductController($db);

if (isset($_GET['id'])) {
    $producto_id = $_GET['id'];
    $producto = $controller->obtenerProductoPorId($producto_id);
    $categorias = $controller->obtenerCategorias();

    if (!$producto) {
        die('Producto no encontrado');
    }
}

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['actualizar'])) {
        if (
            !empty($_POST['productoid']) &&
            !empty($_POST['nombre']) &&
            !empty($_POST['descripcion']) &&
            !empty($_POST['precio']) &&
            !empty($_POST['stock']) &&
            !empty($_POST['idcategoria'])
        ) {
            $controller->actualizarProducto(
                $_POST['productoid'],
                $_POST['nombre'],
                $_POST['descripcion'],
                $_POST['precio'],
                $_POST['stock'],
                $_POST['idcategoria']
            );
            $success = "Producto actualizado correctamente";
        } else {
            $error = "Por favor, complete todos los campos";
        }
    } elseif (isset($_POST['eliminar'])) {
        $controller->eliminarProducto($_POST['productoid']);
        header('Location: productos.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="Productos/producto.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <h1>Editar Producto</h1>

    <div class="form-container">
        <h2>Formulario de Edición</h2>
        <form method="POST">
            <input type="hidden" name="productoid" value="<?= $producto['productoid'] ?>">
            <div>
                <input type="text" name="nombre" id="nombre" placeholder=" " value="<?= $producto['nombreproducto'] ?>"
                    required>
                <label for="nombre">Nombre</label>
            </div>
            <div>
                <input type="text" name="descripcion" id="descripcion" placeholder=" "
                    value="<?= $producto['descripcion'] ?>" required>
                <label for="descripcion">Descripción</label>
            </div>
            <div>
                <input type="number" name="precio" id="precio" placeholder=" " step="0.01"
                    value="<?= $producto['precio'] ?>" required>
                <label for="precio">Precio</label>
            </div>
            <div>
                <input type="number" name="stock" id="stock" placeholder=" " value="<?= $producto['stock'] ?>" required>
                <label for="stock">Stock</label>
            </div>
            <div>
                <select name="idcategoria" id="idcategoria" required>
                    <option value="" disabled>Selecciona una Categoría</option>
                    <?php while ($categoria = $categorias->fetch_assoc()): ?>
                        <option value="<?= $categoria['idcategoria']
                            ?>" <?= $categoria['idcategoria'] == $producto['idcategoria'] ? 'selected' : '' ?>>
                            <?= $categoria['descripcioncate'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <label for="idcategoria">Categoría</label>
            </div>
            <div class="button-container">
                <button type="submit" name="actualizar" class="btn-fire">Actualizar</button>
                <a class="btn-fire button" href="productos.php" class="btn-back">Atrás</a>
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
                window.location.href = 'productos.php';
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