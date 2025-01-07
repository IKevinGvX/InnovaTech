<?php
class AlmacenModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function obtenerAlmacenes()
    {
        $query = "
        SELECT 
            * from almacen
    ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function ContarRegistrosDetalleMovimiento()
    {
        $query = "CALL ContarRegistrosDetalleMovimiento()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        return $row['total'];
    }
    public function obtenerAlmacenPorId($almacen_id)
    {
        $query = "SELECT * FROM almacen WHERE almacenid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $almacen_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function crearAlmacen($nombre_almacen, $direccion_almacen)
    {
        $query = "INSERT INTO almacen (nombrealmacen, direccionalmacen) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $nombre_almacen, $direccion_almacen);
        return $stmt->execute();
    }

    public function actualizarAlmacen($almacen_id, $nombre_almacen, $direccion_almacen)
    {
        $query = "UPDATE almacen SET nombrealmacen = ?, direccionalmacen = ? WHERE almacenid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $nombre_almacen, $direccion_almacen, $almacen_id);
        return $stmt->execute();
    }

    public function eliminarAlmacen($almacen_id)
    {
        $query = "DELETE FROM almacen WHERE almacenid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $almacen_id);
        return $stmt->execute();
    }
}
?>