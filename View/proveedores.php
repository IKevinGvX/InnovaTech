<?php
require_once '../Model/Conexion.php';
require_once '../Controller/ProveedorController.php';

$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new ProveedorController($db);

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['crear'])) {
        if (
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
            $controller->crearProveedor(
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
            $success = "Proveedor agregado correctamente";
        } else {
            $error = "Por favor, complete todos los campos para agregar un proveedor";
        }
    } elseif (isset($_POST['eliminar'])) {
        if (!empty($_POST['proveedor_id'])) {
            $controller->eliminarProveedor($_POST['proveedor_id']);
            $success = "Proveedor eliminado correctamente";
        } else {
            $error = "Error al intentar eliminar el proveedor";
        }
    }
}

$proveedores = $controller->obtenerProveedores();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proveedores</title>
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
        <h1>Gestión de Proveedores - INNOVATECH</h1>
        <div class="header-buttons">
            <a href="principal.php">Volver</a>
        </div>
    </header>

    <main>
        <h1>CRUD de Proveedores</h1>

        <div class="form-container">
            <h2>Crear Proveedor</h2>
            <form method="POST">
                <div>
                    <label for="usuario_id">Usuario ID</label>
                    <select name="usuario_id" id="usuario_id" required>
                        <option value="6">6</option>
                    </select>
                </div>
                <div>
                    <input type="text" name="nombre" id="nombre" placeholder=" " required>
                    <label for="nombre">Nombre</label>
                </div>
                <div>
                    <input type="text" name="apellido" id="apellido" placeholder=" " required>
                    <label for="apellido">Apellido</label>
                </div>
                <div>
                    <input type="date" name="fecha_nac" id="fecha_nac" placeholder=" " required>
                    <label for="fecha_nac">Fecha de Nacimiento</label>
                </div>
                <div>
                    <input type="number" name="dni" id="dni" placeholder=" " required>
                    <label for="dni">DNI</label>
                </div>
                <div>
                    <input type="text" name="ruc" id="ruc" placeholder=" " required>
                    <label for="ruc">RUC</label>
                </div>
                <div>
                    <input type="email" name="correo" id="correo" placeholder=" " required>
                    <label for="correo">Correo</label>
                </div>
                <div>
                    <input type="text" name="telefono" id="telefono" placeholder=" " required>
                    <label for="telefono">Teléfono</label>
                </div>
                <div>
                    <input type="text" name="direccion" id="direccion" placeholder=" " required>
                    <label for="direccion">Dirección</label>
                </div>
                <button type="submit" name="crear">Crear</button>
            </form>
        </div>

        <div class="table-container">
            <h2>Lista de Proveedores</h2>
            <table id="proveedoresTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de Nacimiento</th>
                        <th>DNI</th>
                        <th>RUC</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($proveedor = $proveedores->fetch_assoc()): ?>
                        <tr>
                            <td><?= isset($proveedor['proveedor_id']) ? $proveedor['proveedor_id'] : 'Sin ID' ?></td>
                            <td><?= isset($proveedor['usuario_id']) ? $proveedor['usuario_id'] : 'Sin Usuario ID' ?></td>
                            <td><?= isset($proveedor['nombre']) ? $proveedor['nombre'] : 'Sin Nombre' ?></td>
                            <td><?= isset($proveedor['apellido']) ? $proveedor['apellido'] : 'Sin Apellido' ?></td>
                            <td><?= isset($proveedor['fecha_nac']) ? $proveedor['fecha_nac'] : 'Sin Fecha' ?></td>
                            <td><?= isset($proveedor['dni']) ? $proveedor['dni'] : 'Sin DNI' ?></td>
                            <td><?= isset($proveedor['ruc']) ? $proveedor['ruc'] : 'Sin RUC' ?></td>
                            <td><?= isset($proveedor['correo']) ? $proveedor['correo'] : 'Sin Correo' ?></td>
                            <td><?= isset($proveedor['telefono']) ? $proveedor['telefono'] : 'Sin Teléfono' ?></td>
                            <td><?= isset($proveedor['direccion']) ? $proveedor['direccion'] : 'Sin Dirección' ?></td>
                            <td>
                                <a href="editarproveedor.php?id=<?= $proveedor['proveedor_id'] ?>"
                                    class="btn-fire">Editar</a>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="proveedor_id" value="<?= $proveedor['proveedor_id'] ?>">
                                    <button type="submit" name="eliminar" class="btn-fire">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>

    <footer>
        <p>&copy; <?= date('Y') ?> INNOVATECH. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#proveedoresTable').DataTable({
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
                }
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

</html>