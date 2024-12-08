<?php
class Producto
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function obtenerProductoCategoria()
    {
        $query = "CALL obtenerproductocategoria()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->get_result();
    }
}
?>