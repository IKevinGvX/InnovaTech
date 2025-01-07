<?php
require_once '../Model/Conexion.php';
require_once '../Controller/UsuarioController.php';

$db = new mysqli('localhost', 'root', '', 'tp_web');
$controller = new UsuarioController($db);

$success = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eliminar'])) {
        if (!empty($_POST['usuario_id'])) {
            $controller->eliminarUsuario($_POST['usuario_id']);
            $success = "Usuario eliminado correctamente";
        } else {
            $error = "Error al intentar eliminar el usuario";
        }
    }
}

$usuarios = $controller->obtenerUsuarios();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
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
        <h1>Gestión de Usuarios - INNOVATECH</h1>
        <div class="header-buttons">
            <a href="principal.php">Volver</a>
        </div>
    </header>

    <main>
        <div class="table-container">
            <h2>Lista de Usuarios</h2>
            <table id="usuariotable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Rol</th>
                        <th>Fecha Creación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($usuario = $usuarios->fetch_assoc()): ?>
                        <tr>
                            <td><?= $usuario['usuario_id'] ?></td>
                            <td><?= $usuario['email'] ?></td>
                            <td><?= $usuario['contrasena'] ?></td>
                            <td><?= $usuario['rol_id'] ?></td>
                            <td><?= $usuario['fecha_creacion'] ?></td>
                            <td>
                                <a href="editarusuario.php?id=<?= $usuario['usuario_id'] ?>" class="btn-fire">Editar</a>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="usuario_id" value="<?= $usuario['usuario_id'] ?>">
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
        <p>&copy; <?= date('Y') ?> Gestión de Usuarios. Todos los derechos reservados.</p>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#usuariotable').DataTable({
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