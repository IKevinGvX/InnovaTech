<?php
require_once '../Model/Conexion.php';
require_once '../Controller/ProductoController.php';

$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new ProductController($db);

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['crear'])) {
        if (
            !empty($_POST['nombre']) &&
            !empty($_POST['descripcion']) &&
            !empty($_POST['precio']) &&
            !empty($_POST['stock']) &&
            !empty($_POST['idcategoria'])
        ) {
            $controller->crearProducto($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['stock'], $_POST['idcategoria']);
            $success = "Producto agregado correctamente";
        } else {
            $error = "Por favor, complete todos los campos para agregar un producto";
        }
    } elseif (isset($_POST['eliminar'])) {
        if (!empty($_POST['productoid'])) {
            $controller->eliminarProducto($_POST['productoid']);
            $success = "Producto eliminado correctamente";
        } else {
            $error = "Error al intentar eliminar el producto";
        }
    }
}
$productos = $controller->obtenerProductoCategoria();
$categorias = $controller->obtenerCategorias();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IN>Products</title>
    <link rel="stylesheet" href="Productos/producto.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #1A1A2E;
            color: #FFFFFF;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        header h1 {
            margin: 0;
            font-size: 2rem;
        }

        .header-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 10px;
        }

        .custom-search {
            display: flex;
            justify-content: center;
            align-items: center;
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

        .filter-card {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            z-index: 1000;
            width: 300px;
            text-align: center;
        }

        .filter-card h2 {
            margin: 0 0 15px;
        }

        .filter-card ul {
            list-style: none;
            padding: 0;
            margin: 10px 0;
        }

        .filter-card li {
            margin: 5px 0;
        }

        .header-buttons a {
            text-decoration: none;
            color: white;
            background-color: #FF4500;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .header-buttons a:hover {
            background-color: #FF6347;
        }

        footer {
            background-color: #1A1A2E;
            color: #FFFFFF;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0px -4px 8px rgba(0, 0, 0, 0.2);
        }

        footer p {
            margin: 0;
            font-size: 14px;
        }

        footer a {
            color: #FF4500;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
    <header>
        <h1>Gestión de Productos - INNOVATECH</h1>
        <div class="header-buttons">
            <a href="principal.php">Volver</a>
            <a href="reporte.php">Reporte Gráfico</a>
            <a href="#" id="filter-button">Ver Precios con Filtros</a>
            <a href="#" id="categorize-button">Categorizar por Categoría</a>
        </div>
    </header>

    <main>
        <h1>CRUD de Productos</h1>

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
                        <option value="" disabled selected>Seleccionar categoría</option>
                        <?php if ($categorias): ?>
                            <?php while ($categoria = $categorias->fetch_assoc()): ?>
                                <option value="<?= $categoria['idcategoria'] ?>">
                                    <?= $categoria['descripcioncate'] ?>
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
                            <td><?= isset($producto['productoid']) ? $producto['productoid'] : 'Sin ID' ?></td>
                            <td><?= isset($producto['nombreproducto']) ? $producto['nombreproducto'] : 'Sin Nombre' ?>
                            </td>
                            <td><?= isset($producto['descripcion']) ? $producto['descripcion'] : 'Sin Descripción' ?>
                            </td>
                            <td><?= isset($producto['precio']) ? $producto['precio'] : 'Sin Precio' ?></td>
                            <td><?= isset($producto['stock']) ? $producto['stock'] : 'Sin Stock' ?></td>
                            <td><?= isset($producto['descripcioncate']) ? $producto['descripcioncate'] : 'Sin Categoría' ?>
                            </td>
                            </td>
                            <td>
                                <a href="editarproductos.php?id=<?= $producto['productoid'] ?>" class="btn-fire">Editar</a>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="productoid" value="<?= $producto['productoid'] ?>">
                                    <button type="submit" name="eliminar" class="btn-fire">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <div id="category-card" class="filter-card" style="display: none;">
            <h2 style="color: #FFA500; font-size: 1.8rem; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);">Filtrar por
                Categoría</h2>
            <div id="category-filters">
                <select id="category-select"
                    style="width: 100%; padding: 10px; border: 2px solid #FF4500; border-radius: 10px;">
                    <option value="" disabled selected>Seleccionar categoría</option>
                    <?php if (!empty($categorias)): ?>
                        <?php foreach ($categorias as $categoria): ?>
                            <option value="<?= htmlspecialchars($categoria['descripcioncate'], ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars($categoria['descripcioncate'], ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="">No hay categorías disponibles</option>
                    <?php endif; ?>
                </select>
            </div>
            <div id="category-results" style="margin-top: 20px;">
            </div>
            <button id="close-category-card"
                style="background: linear-gradient(135deg, #FF4500, #FF6347); border: none; color: white; padding: 10px 20px; border-radius: 25px; font-weight: bold; transition: all 0.3s ease; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3); cursor: pointer;">
                Cerrar
            </button>
        </div>

        <div id="filter-card" class="filter-card" style="display: none;">
            <h2 style="color: #FFA500; font-size: 1.8rem; text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);">Filtros
                Avanzados</h2>
            <div id="category-filters">

            </div>
            <div id="price-filters">
                <h3 style="color: #00FF00; font-size: 1.2rem;">Precios</h3>
                <ul style="list-style: none; padding: 0;">
                    <li><span style="color: #00FF00; font-weight: bold;">0 - 300 soles:</span> <span
                            id="price-low"></span></li>
                    <li><span style="color: #FFFF00; font-weight: bold;">500 - 1500 soles:</span> <span
                            id="price-mid"></span>
                    </li>
                    <li><span style="color: #FFA500; font-weight: bold;">1500 - 50000 soles:</span> <span
                            id="price-high"></span></li>
                </ul>
            </div>
            <div id="stock-filters">
                <h3 style="color: #00FF00; font-size: 1.2rem;">Stock</h3>
                <ul style="list-style: none; padding: 0;">
                    <li><span style="color: #FF0000; font-weight: bold;">0 - 30:</span> <span id="stock-low"></span>
                    </li>
                    <li><span style="color: #FFFF00; font-weight: bold;">30 - 100:</span> <span id="stock-mid"></span>
                    </li>
                    <li><span style="color: #00FF00; font-weight: bold;">100 - 1000:</span> <span
                            id="stock-high"></span></li>
                </ul>
            </div>
            <button id="close-filter-card"
                style="background: linear-gradient(135deg, #FF4500, #FF6347); border: none; color: white; padding: 10px 20px; border-radius: 25px; font-weight: bold; transition: all 0.3s ease; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.3); cursor: pointer;">
                Cerrar
            </button>
        </div>

    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> INNOVATECH. Todos los derechos reservados. <a href="#">Términos de uso</a> | <a
                href="#">Política de privacidad</a></p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function () {
            // Inicializar DataTable
            var table = $('#productosTable').DataTable({
                dom: 'Bfrtip', // Activa los botones de exportación
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
                pageLength: 10,
                buttons: [
                    {
                        extend: 'csvHtml5',
                        text: 'Exportar CSV',
                        title: 'Reporte de Productos',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluir la última columna (acciones)
                        },
                        className: 'btn btn-primary'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Exportar Excel',
                        title: 'Reporte de Productos',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluir la última columna (acciones)
                        },
                        className: 'btn btn-success'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Exportar PDF',
                        title: 'Reporte de Productos',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluir la última columna (acciones)
                        },
                        className: 'btn btn-danger'
                    },
                    {
                        extend: 'print',
                        text: 'Imprimir',
                        exportOptions: {
                            columns: ':not(:last-child)' // Excluir la última columna (acciones)
                        },
                        className: 'btn btn-info'
                    }
                ],
                createdRow: function (row, data) {
                    // Personalización de colores según el precio y stock
                    var price = parseFloat(data[3]);
                    var stock = parseInt(data[4]);

                    // Precio
                    if (price > 0 && price <= 300) {
                        $('td', row).eq(3).css('background-color', '#E6F7E6').css('color', '#006400');
                    } else if (price > 500 && price <= 1500) {
                        $('td', row).eq(3).css('background-color', '#FFF9E6').css('color', '#8B8000');
                    } else if (price > 1500) {
                        $('td', row).eq(3).css('background-color', '#FDEEE6').css('color', '#A94400');
                    }

                    // Stock
                    if (stock > 0 && stock <= 30) {
                        $('td', row).eq(4).css('background-color', '#FEECEC').css('color', '#8B0000');
                    } else if (stock > 30 && stock <= 100) {
                        $('td', row).eq(4).css('background-color', '#FFF9E6').css('color', '#8B8000');
                    } else if (stock > 100) {
                        $('td', row).eq(4).css('background-color', '#E6F7E6').css('color', '#006400');
                    }
                }
            });

            // Agregar botones al contenedor de DataTable
            table.buttons().container().appendTo('#productosTable_wrapper .col-md-6:eq(0)');

            // Filtro por categoría
            $('#category-select').on('change', function () {
                const selectedCategory = $(this).val();
                if (selectedCategory) {
                    table.column(5).search(selectedCategory).draw(); // Filtro por la columna de categorías
                } else {
                    table.column(5).search('').draw(); // Mostrar todo si no se selecciona categoría
                }
            });

            // Mostrar tarjeta de filtro por categoría
            $('#categorize-button').on('click', function () {
                $('#category-card').fadeIn();
            });
            $('#close-category-card').on('click', function () {
                $('#category-card').fadeOut();
            });
            $('#filter-button').on('click', function () {
                let priceLow = 0, priceMid = 0, priceHigh = 0;
                let stockLow = 0, stockMid = 0, stockHigh = 0;
                table.rows().every(function () {
                    var data = this.data();
                    var price = parseFloat(data[3]);
                    var stock = parseInt(data[4]);
                    if (price > 0 && price <= 300) priceLow++;
                    else if (price > 500 && price <= 1500) priceMid++;
                    else if (price > 1500) priceHigh++;
                    if (stock > 0 && stock <= 30) stockLow++;
                    else if (stock > 30 && stock <= 100) stockMid++;
                    else if (stock > 100) stockHigh++;
                });

                $('#price-low').text(priceLow);
                $('#price-mid').text(priceMid);
                $('#price-high').text(priceHigh);
                $('#stock-low').text(stockLow);
                $('#stock-mid').text(stockMid);
                $('#stock-high').text(stockHigh);

                $('#filter-card').fadeIn();
            });
            $('#close-filter-card').on('click', function () {
                $('#filter-card').fadeOut();
            });
            <?php if ($success): ?>
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '<?= $success ?>',
                    confirmButtonText: 'Aceptar'
                });
            <?php endif; ?>

            <?php if ($error): ?>
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: '<?= $error ?>',
                    confirmButtonText: 'Aceptar'
                });
            <?php endif; ?>
        });
    </script>

</body>
<style>
    .filter-card {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #1A1A2E;
        border: 2px solid #FF4500;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        padding: 25px;
        z-index: 1000;
        width: 320px;
        text-align: center;
    }

    .filter-card h2 {
        margin: 0 0 15px;
    }

    .filter-card ul {
        list-style: none;
        padding: 0;
        margin: 10px 0;
    }

    .filter-card li {
        margin: 5px 0;
    }

    .filter-card button:hover {
        background: linear-gradient(135deg, #FF6347, #FF4500);
        transform: scale(1.1);
        box-shadow: 0px 6px 8px rgba(0, 0, 0, 0.4);
    }
</style>

</html>