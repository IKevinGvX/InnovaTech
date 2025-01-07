<?php
require_once 'Conexion.php';

class ProveedorModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function obtenerProveedores()
    {
        $query = "SELECT * FROM proveedores";
        $result = $this->conn->query($query);
        return $result;
    }

    public function obtenerProveedorPorId($proveedor_id)
    {
        $query = "SELECT * FROM proveedores WHERE proveedor_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $proveedor_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function crearProveedor($usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion)
    {
        $query = "INSERT INTO proveedores (usuario_id, nombre, apellido, fecha_nac, dni, ruc, correo, telefono, direccion)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issssssss", $usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion);
        return $stmt->execute();
    }

    public function actualizarProveedor($proveedor_id, $usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion)
    {
        $query = "UPDATE proveedores SET usuario_id = ?, nombre = ?, apellido = ?, fecha_nac = ?, dni = ?, ruc = ?, correo = ?, telefono = ?, direccion = ?
              WHERE proveedor_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issssssssi", $usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion, $proveedor_id);
        return $stmt->execute();
    }

    public function eliminarProveedor($proveedor_id)
    {
        $query = "DELETE FROM proveedores WHERE proveedor_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $proveedor_id);
        return $stmt->execute();
    }
}
?>