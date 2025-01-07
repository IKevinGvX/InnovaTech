<?php
class ClienteModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function obtenerClientes()
    {
        $query = "SELECT * FROM clientes";
        return $this->conn->query($query);
    }

    public function obtenerClientePorId($cliente_id)
    {
        $query = "SELECT * FROM clientes WHERE cliente_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $cliente_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function crearCliente($usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion)
    {
        $query = "INSERT INTO clientes (usuario_id, nombre, apellido, fecha_nac, dni, ruc, correo, telefono, direccion) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issssssss", $usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion);
        return $stmt->execute();
    }

    public function actualizarCliente($cliente_id, $usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion)
    {
        $query = "UPDATE clientes SET usuario_id = ?, nombre = ?, apellido = ?, fecha_nac = ?, dni = ?, ruc = ?, correo = ?, telefono = ?, direccion = ? WHERE cliente_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issssssssi", $usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion, $cliente_id);
        return $stmt->execute();
    }


    public function eliminarCliente($cliente_id)
    {
        $query = "DELETE FROM clientes WHERE cliente_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $cliente_id);
        return $stmt->execute();
    }
}
?>