<?php
require_once '../Model/Conexion.php';
require_once '../Controller/EmpleadoController.php';

$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new EmpleadoController($db);

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['crear'])) {
        if (
            !empty($_POST['usuario_id']) &&
            !empty($_POST['rango']) &&
            !empty($_POST['nombre']) &&
            !empty($_POST['apellido']) &&
            !empty($_POST['fecha_nac']) &&
            !empty($_POST['dni']) &&
            !empty($_POST['correo']) &&
            !empty($_POST['telefono']) &&
            !empty($_POST['direccion'])
        ) {
            $controller->crearEmpleado(
                $_POST['usuario_id'],
                $_POST['rango'],
                $_POST['nombre'],
                $_POST['apellido'],
                $_POST['fecha_nac'],
                $_POST['dni'],
                $_POST['correo'],
                $_POST['telefono'],
                $_POST['direccion']
            );
            $success = "Empleado agregado correctamente.";
        } else {
            $error = "Por favor, complete todos los campos para agregar un empleado.";
        }
    } elseif (isset($_POST['eliminar'])) {
        if (!empty($_POST['empleadoid'])) {
            $controller->eliminarEmpleado($_POST['empleadoid']);
            $success = "Empleado eliminado correctamente.";
        } else {
            $error = "Error al intentar eliminar el empleado. Falta el ID del empleado.";
        }
    }
}

$empleados = $controller->listarEmpleados();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
    <link rel="stylesheet" href="Productos/producto.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <header>
        <h1>Gestión de Empleados - INNOVATECH</h1>
        <div class="header-buttons">
            <a href="principal.php">Volver</a>
        </div>
    </header>
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
    <main>
        <h1>CRUD de Empleados</h1>

        <!-- Formulario para crear empleado -->
        <div class="form-container">
            <h2>Crear Empleado</h2>
            <form method="POST">
                <div>
                    <label for="usuario_id">Usuario ID</label>
                    <select name="usuario_id" id="usuario_id" required>
                        <option value="1">1</option>
                    </select>
                </div>
                <div>
                    <label for="rango">Rango</label>
                    <input type="text" name="rango" id="rango" placeholder="Rango del empleado" required>
                </div>
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre del empleado" required>
                </div>
                <div>
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" placeholder="Apellido del empleado" required>
                </div>
                <div>
                    <label for="fecha_nac">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nac" id="fecha_nac" required>
                </div>
                <div>
                    <label for="dni">DNI</label>
                    <input type="number" name="dni" id="dni" placeholder="Número de identificación" required>
                </div>
                <div>
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" id="correo" placeholder="Correo electrónico" required>
                </div>
                <div>
                    <label for="telefono">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" placeholder="Teléfono del empleado" required>
                </div>
                <div>
                    <label for="direccion">Dirección</label>
                    <input type="text" name="direccion" id="direccion" placeholder="Dirección del empleado" required>
                </div>
                <button type="submit" name="crear">Crear</button>
            </form>
        </div>

        <div class="table-container">
            <h2>Lista de Empleados</h2>
            <table id="empleadosTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario ID</th>
                        <th>Rango</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Fecha de Nacimiento</th>
                        <th>DNI</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($empleado = $empleados->fetch_assoc()): ?>
                        <tr>
                            <td><?= $empleado['empleadoid'] ?? 'Sin ID' ?></td>
                            <td><?= $empleado['usuario_id'] ?? 'Sin Usuario ID' ?></td>
                            <td><?= $empleado['rango'] ?? 'Sin Rango' ?></td>
                            <td><?= $empleado['nombre'] ?? 'Sin Nombre' ?></td>
                            <td><?= $empleado['apellido'] ?? 'Sin Apellido' ?></td>
                            <td><?= $empleado['fecha_nac'] ?? 'Sin Fecha de Nacimiento' ?></td>
                            <td><?= $empleado['dni'] ?? 'Sin DNI' ?></td>
                            <td><?= $empleado['correo'] ?? 'Sin Correo' ?></td>
                            <td><?= $empleado['telefono'] ?? 'Sin Teléfono' ?></td>
                            <td><?= $empleado['direccion'] ?? 'Sin Dirección' ?></td>
                            <td>
                                <a href="editarempleados.php?id=<?= $empleado['empleadoid'] ?>" class="btn-fire">Editar</a>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="empleadoid" value="<?= $empleado['empleadoid'] ?>">
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
            $('#empleadosTable').DataTable({
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
                Swal.fire('¡Éxito!', '<?= $success ?>', 'success');
            <?php elseif ($error): ?>
                Swal.fire('¡Error!', '<?= $error ?>', 'error');
            <?php endif; ?>
        });
    </script>
</body>

</html>