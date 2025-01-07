<?php
class Empleado
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function listarEmpleados()
    {
        $query = "
        SELECT 
            * FROM empleados
    ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function obtenerEmpleadoPorId($empleadoid)
    {
        $query = "SELECT * FROM empleados WHERE empleadoid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $empleadoid);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function crearEmpleado($usuario_id, $rango, $nombre, $apellido, $fecha_nac, $dni, $correo, $telefono, $direccion)
    {
        $query = "INSERT INTO empleados (usuario_id, rango, nombre, apellido, fecha_nac, dni, correo, telefono, direccion) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issssssss", $usuario_id, $rango, $nombre, $apellido, $fecha_nac, $dni, $correo, $telefono, $direccion);
        return $stmt->execute();
    }

    public function actualizarEmpleado($empleadoid, $usuario_id, $rango, $nombre, $apellido, $fecha_nac, $dni, $correo, $telefono, $direccion)
    {
        $query = "UPDATE empleados 
              SET usuario_id = ?, rango = ?, nombre = ?, apellido = ?, fecha_nac = ?, dni = ?, correo = ?, telefono = ?, direccion = ? 
              WHERE empleadoid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issssssssi", $usuario_id, $rango, $nombre, $apellido, $fecha_nac, $dni, $correo, $telefono, $direccion, $empleadoid);
        return $stmt->execute();
    }


    public function eliminarEmpleado($empleadoid)
    {
        $query = "DELETE FROM empleados WHERE empleadoid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $empleadoid);
        return $stmt->execute();
    }
}
?>