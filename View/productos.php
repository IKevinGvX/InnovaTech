<?php
include_once '../Model/Conexion.php';
include_once '../Controller/ProductoController.php';

$db = new Conexion();
$connection = $db->getConnection();
$productController = new ProductController($connection);

$productos = $productController->mostrarProductos();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IN>Products</title>
    <link rel="stylesheet" href="Productos/table.css">
    <link rel="stylesheet" href="Productos/productos.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <h1>Task Products</h1>
    <div class="form-container">
        <form method="POST" action="../Controller/ProductoController.php">
            <label for="nombre_producto">Nombre del Producto:</label>
            <input type="text" id="nombre_producto" name="nombre_producto" placeholder="Ingrese el nombre del producto"
                required>
            <label for="descripcion">Descripción del Producto:</label>
            <input type="text" id="descripcion" name="descripcion" placeholder="Ingrese la descripción" required>
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Ingrese el precio" required>
            <label for="stock">Stock:</label>
            <input type="number" id="stock" name="stock" placeholder="Ingrese el stock" required>
            <label for="categoria">Categoría:</label>
            <select id="categoria" name="categoria" required>
                <option value="">Seleccione una categoría</option>
            </select>
            <button type="submit" class="btn-fire">Registrar Producto</button>
            <a href="Principal.php" class="btn-fire">Regresar</a>

        </form>
    </div>

    <h1>Reports</h1>
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="Reports/ProductoReport?action=exportarXML" class="btn-fire">XML Report</a>
        <a href="../Controller/Reportes.php?action=generatePDF" class="btn-fire">PDF Report</a>
        <a href="../Controller/Reportes.php?action=generateExcel" class="btn-fire">Excel Report</a>
    </div>
    <div style="text-align: center; margin-bottom: 20px;">
        <input type="text" id="searchInput" class="search-input" placeholder="Buscar productos...">
    </div>
    <div class="table-container">
        <table id="productosTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $productos->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['producto_id'] . "</td>";
                    echo "<td>" . $row['nombre_producto'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>" . $row['precio'] . "</td>";
                    echo "<td>" . $row['stock'] . "</td>";
                    echo "<td>" . $row['descripcion'] . "</td>";
                    echo "<td>
                        <button class='btn-fire'>Editar</button> 
                        <button class='btn-fire delete-btn'>Eliminar</button>
                      </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="Productos/datatables.js"></script>

</html>