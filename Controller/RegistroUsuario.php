<?php
include_once '../Model/Usuario.php';
include_once '../Model/Conexion.php';

session_start();

$conexion = new Conexion();
$connection = $conexion->getConnection();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $contraseña = $_POST['contraseña'];
    $fecha = $_POST['fecha'];
    $rol_id = $_POST['rol_id'];


    if (!empty($email) && !empty($contraseña) && !empty($fecha)) {
        $usuariomodel = new usuarios($connection);

        if ($usuariomodel->InsertUser($email, $contraseña, $fecha, $rol_id)) {
            $_SESSION['message'] = "Usuario registrado correctamente.";
            $_SESSION['message_type'] = "success";
        } else {
            $_SESSION['message'] = "Error al registrar el usuario.";
            $_SESSION['message_type'] = "error";
        }
    } else {
        $_SESSION['message'] = "Todos los campos son obligatorios.";
        $_SESSION['message_type'] = "error";
    }

    // Redirigir de vuelta a la página de inicio de sesión
    header("Location: ../View/Registrar.php");
    exit();
}
?>