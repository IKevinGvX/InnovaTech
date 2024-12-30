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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['actualizar'])) {
        $controller->actualizarProducto(
            $_POST['producto_id'],
            $_POST['nombre'],
            $_POST['descripcion'],
            $_POST['precio'],
            $_POST['stock'],
            $_POST['idcategoria']
        );
        header('Location: productos.php'); // Redirige al listado de productos tras actualizar
        exit;
    } elseif (isset($_POST['eliminar'])) {
        $controller->eliminarProducto($_POST['producto_id']);
        header('Location: productos.php'); // Redirige al listado de productos tras eliminar
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
</head>

<body>
    <h1>Editar Producto</h1>

    <div class="form-container">
        <h2>Formulario de Edición</h2>
        <form method="POST">
            <input type="hidden" name="producto_id" value="<?= $producto['producto_id'] ?>">
            <div>
                <input type="text" name="nombre" id="nombre" placeholder=" " value="<?= $producto['nombre_producto'] ?>"
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
                            <?= $categoria['c_descripcion'] ?>
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
</body>

</html>