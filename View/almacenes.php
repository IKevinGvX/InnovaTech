<?php
require_once '../Model/Conexion.php';
require_once '../Controller/AlmacenController.php';

$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new AlmacenController($db);

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['crear'])) {
        if (
            !empty($_POST['nombrealmacen']) &&
            !empty($_POST['direccionalmacen'])
        ) {
            $controller->crearAlmacen($_POST['nombrealmacen'], $_POST['direccionalmacen']);
            $success = "Almacen agregado correctamente";
        } else {
            $error = "Por favor, complete todos los campos para agregar un Almacen";
        }
    } elseif (isset($_POST['eliminar'])) {
        if (!empty($_POST['almacenid'])) {
            $controller->eliminarAlmacen($_POST['almacenid']);
            $success = "Almacen eliminado correctamente";
        } else {
            $error = "Error al intentar eliminar el Almacen";
        }
    }
}

$almacen = $controller->obtenerAlmacenes();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IN>Products</title>
    <link rel="stylesheet" href="Productos/producto.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
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
        <h1>Gestión de Almacenes - INNOVATECH</h1>
        <div class="header-buttons">
            <a href="principal.php">Volver</a>
        </div>
    </header>

    <main>
        <h1>CRUD de Almacen</h1>

        <div class="form-container">
            <h2>Crear Almacen</h2>
            <form method="POST">
                <div>
                    <input type="text" name="nombrealmacen" id="nombrealmacen" placeholder=" " required>
                    <label for="nombrealmacen">Descripcion Almacen</label>
                </div>
                <div>
                    <input type="text" name="direccionalmacen" id="direccionalmacen" placeholder=" " required>
                    <label for="direccionalmacen">Almacen Ubicacion</label>
                </div>
                <button type="submit" name="crear">Crear</button>
            </form>
        </div>

        <div class="table-container">
            <h2>Lista de Almacen</h2>
            <table id="almacentable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($almacenes = $almacen->fetch_assoc()): ?>
                        <tr>
                            <td><?= isset($almacenes['almacenid']) ? $almacenes['almacenid'] : 'Sin ID' ?></td>
                            <td><?= isset($almacenes['nombrealmacen']) ? $almacenes['nombrealmacen'] : 'Sin Nombre' ?>
                            </td>
                            <td><?= isset($almacenes['direccionalmacen']) ? $almacenes['direccionalmacen'] : 'Sin Descripción' ?>
                            </td>
                            <td>
                                <a href="editaralmacen.php?id=<?= $almacenes['almacenid'] ?>" class="btn-fire">Editar</a>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="almacenid" value="<?= $almacenes['almacenid'] ?>">
                                    <button type="submit" name="eliminar" class="btn-fire">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            </section>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> Gestión de Almacenes. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#almacentable').DataTable({
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
    </script>
</body>

</html>