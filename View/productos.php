<?php
require_once '../Model/Conexion.php';
require_once '../Controller/ProductoController.php';

$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new ProductController($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['crear'])) {
        $controller->crearProducto($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['stock'], $_POST['idcategoria']);
    } elseif (isset($_POST['actualizar'])) {
        $controller->actualizarProducto($_POST['producto_id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['stock'], $_POST['idcategoria']);
    } elseif (isset($_POST['eliminar'])) {
        $controller->eliminarProducto($_POST['producto_id']);
    }
}
$productos = $controller->listarProductos();
$productos = $controller->mostrarProductos();
$categorias = $controller->obtenerCategorias();
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IN>Products</title>
    <link rel="stylesheet" href="Productos/producto.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Estilo para el buscador personalizado */
        .custom-search {
            text-align: center;
            margin: 20px 0;
        }

        .custom-search input {
            width: 50%;
            padding: 10px;
            border: 2px solid #00BFFF;
            border-radius: 20px;
            outline: none;
            font-size: 16px;
            background: #1A1A2E;
            color: white;
            transition: all 0.3s ease;
        }

        .custom-search input:focus {
            border-color: #FF4500;
            box-shadow: 0 4px 8px rgba(255, 69, 0, 0.5);
        }
    </style>
</head>

<body>
    <h1>CRUD de Productos</h1>

    <!-- Formulario para crear producto -->
    <div class="form-container">
        <h2>Crear Producto</h2>
        <form method="POST">
            <div>
                <input type="text" name="nombre" id="nombre" placeholder=" " required>
                <label for="nombre">Nombre</label>
            </div>
            <div>
                <input type="text" name="descripcion" id="descripcion" placeholder=" " required>
                <label for="descripcion">Descripción</label>
            </div>
            <div>
                <input type="number" name="precio" id="precio" placeholder=" " step="0.01" required>
                <label for="precio">Precio</label>
            </div>
            <div>
                <input type="number" name="stock" id="stock" placeholder=" " required>
                <label for="stock">Stock</label>
            </div>
            <div>
                <select name="idcategoria" id="idcategoria" required>
                    <option value="" disabled selected></option>
                    <?php if ($categorias): ?>
                        <?php while ($categoria = $categorias->fetch_assoc()): ?>
                            <option value="<?= $categoria['idcategoria'] ?>">
                                <?= $categoria['c_descripcion'] ?>
                            </option>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <option value="">No hay categorías disponibles</option>
                    <?php endif; ?>
                </select>
                <label for="idcategoria">Categoría</label>
            </div>
            <button type="submit" name="crear">Crear</button>
        </form>
    </div>

    <!-- Buscador personalizado -->
    <div class="custom-search">
        <input type="text" id="searchInput" placeholder="Buscar producto...">
    </div>

    <!-- Tabla de productos -->
    <div class="table-container">
        <h2>Lista de Productos</h2>
        <table id="productosTable" class="display">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($producto = $productos->fetch_assoc()): ?>
                    <tr>
                        <td><?= isset($producto['producto_id']) ? $producto['producto_id'] : 'Sin ID' ?></td>
                        <td><?= isset($producto['nombre_producto']) ? $producto['nombre_producto'] : 'Sin Nombre' ?></td>
                        <td><?= isset($producto['descripcion']) ? $producto['descripcion'] : 'Sin Descripción' ?></td>
                        <td><?= isset($producto['precio']) ? $producto['precio'] : 'Sin Precio' ?></td>
                        <td><?= isset($producto['stock']) ? $producto['stock'] : 'Sin Stock' ?></td>
                        <td><?= isset($producto['c_descripcion']) ? $producto['c_descripcion'] : 'Sin Categoría' ?></td>
                        <td>
                            <a href="editarproductos.php?id=<?= $producto['producto_id'] ?>" class="btn-fire">Editar</a>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="producto_id" value="<?= $producto['producto_id'] ?>">
                                <button type="submit" name="eliminar" class="btn-fire">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#productosTable').DataTable({
                responsive: true,
                language: {
                    search: "Buscar:",
                    lengthMenu: "Mostrar _MENU_ registros por página",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    }
                },
                paging: true,
                searching: true,
                pageLength: 10
            });

            // Conectar el buscador personalizado con la tabla
            $('#searchInput').on('keyup', function () {
                table.search(this.value).draw();
            });
        });
    </script>
</body>

</html>