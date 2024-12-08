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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="Productos/producto.css">
</head>

<body>
    <h1>Task Products</h1>
    <style>
        table {
            width: 90%;
            margin: 30px auto;
            border-collapse: collapse;
            background-color: #2F3A3D;
            color: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            animation: tableGlow 1.5s infinite alternate;
        }

        @keyframes tableGlow {
            0% {
                box-shadow: 0 0 10px #00FFFF, 0 0 20px #00FFFF, 0 0 30px #00FFFF;
            }

            50% {
                box-shadow: 0 0 15px #00BFFF, 0 0 30px #00BFFF, 0 0 45px #00BFFF;
            }

            100% {
                box-shadow: 0 0 20px #00FFFF, 0 0 40px #00FFFF, 0 0 60px #00FFFF;
            }
        }

        table thead {
            background-color: #1F6B72;
            color: white;
        }

        table thead th {
            padding: 15px;
            font-size: 18px;
            text-align: center;
        }

        table tbody td {
            padding: 10px 15px;
            text-align: center;
            border: 1px solid #00BFFF;
            transition: transform 0.3s ease-in-out, background-color 0.3s ease;
        }

        table tbody tr:hover {
            background-color: #1F6B72;
            transform: scale(1.02);
        }

        table tbody td:hover {
            background-color: #4CAF50;
            transform: scale(1.05);
        }

        table tbody td button {
            background: linear-gradient(90deg, #8B0000, #330033);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            margin-right: 10px;
        }

        table tbody td button:hover {
            box-shadow: 0 0 20px #FF4500;
            transform: scale(1.1);
        }

        table tbody td button.delete-btn {
            background: linear-gradient(90deg, #ff4e00, #cc3300);
        }

        table tbody td button.delete-btn:hover {
            background: linear-gradient(90deg, #ff6600, #b32d00);
        }
    </style>
    <div class="form-container">
        <form method="POST" action="../Controller/ProductoController.php"><label for="productName">Nombre del
                Producto:</label><input type="text" id="nombre_producto" name="nombre_producto"
                placeholder="Ingrese el nombre del producto" required><label for="descripcion">Descripcion del
                Producto:</label><input type="text" id="descripcion" name="descripcion"
                placeholder="Ingrese el nombre del producto" required><label for="precio">Precio del
                Producto:</label><input type="number" id="precio" name="precio"
                placeholder="Ingrese el precio del producto" required><label for="stock">Stock del
                Producto:</label><input type="number" id="stock" name="stock"
                placeholder="Ingrese el stock del producto" required><label for="descripcion">Categoría:</label><select
                id="descripcion" name="descripcion" required>
                <option value="descripcion">Seleccione una categoría</option>
            </select><label for="productPrice">Precio:</label><input type="number" id="productPrice" name="productPrice"
                placeholder="Ingrese el precio del producto" required><br><button type="submit"
                class="btn-fire">Register Products</button></form>
    </div>
    <h1>Reports
    </h1>
    <div style="text-align: center; margin-bottom: 20px;">
        <a href="Reports/ProductoReport?action=exportarXML" class="btn-fire" style="margin: 0 10px;"> XML
            Report</a>
        <a href="../Controller/Reportes.php?action=generatePDF" class="btn-fire" style="margin: 0 10px;"> PDF
            Report</a>
        <a href="../Controller/Reportes.php?action=generateExcel" class="btn-fire" style="margin: 0 10px;">
            Excel Report</a>
    </div>
    <table>
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
        <tbody><?php
        while ($row = $productos->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['producto_id'] . "</td>";
            echo "<td>" . $row['nombre_producto'] . "</td>";
            echo "<td>" . $row['descripcion'] . "</td>";
            echo "<td>" . $row['precio'] . "</td>";
            echo "<td>" . $row['stock'] . "</td>";
            echo "<td>" . $row['descripcion'] . "</td>";
            echo "<td><button class='btn-fire'>Editar</button> <button class='btn-fire'>Eliminar</button></td>";
            echo "</tr>";
        }
        ?> </tbody>
    </table>
</body>

</html>