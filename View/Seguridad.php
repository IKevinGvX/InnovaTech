<?php
require '../Model/Conexion.php';
session_start();

$conexion = new mysqli("localhost", "root", "", "tp_Web");
if ($conexion->connect_error) {
    die("Error de conexion :" . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $conexion->real_escape_string($_POST['email']);
    $contrasena = $_POST['contrasena'];

    if (empty($email) || empty($contrasena)) {
        echo "<p style='color: red;'>Por favor, ingresa ambos campos.</p>";
        exit();
    }

    $query = "SELECT a.usuario_id, a.email, a.contrasena, e.nombre_rol 
              FROM usuario a 
              INNER JOIN roles e ON a.rol_id = e.rol_id 
              WHERE a.email = ?";

    $stmt = $conexion->prepare($query);
    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . $conexion->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if ($contrasena == $user['contrasena']) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['nombre_rol'] = $user['nombre_rol'];

            switch ($user['nombre_rol']) {
                case 'Vendedor':
                    header("Location: productos.php");
                    break;
                case 'Administrador':
                    header("Location: Principal.php");
                    break;
                case 'Sistemas':
                    header("Location: Principal.php");
                    break;
                case 'Cliente':
                    header("Location: clientes.php");
                    break;
                case 'Proveedor':
                    header("Location: proveedores.php");
                    break;
                default:
                    header("Location: RolNull.php");
            }
            exit();
        } else {
            header("Location: faultpassword.php");
            exit();
        }
    } else {
        header("Location: error.php");
        exit();
    }
}


$conexion->close();
?>