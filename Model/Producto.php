<?php
class Producto
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }
    public function listarProductos()
    {
        $query = "
        SELECT 
            * from productos
    ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function obtenerProductoCategoria()
    {
        $query = "
            SELECT 
                a.producto_id, 
                a.nombre_producto, 
                a.descripcion, 
                a.precio, 
                a.stock, 
                a.idcategoria, 
                b.c_descripcion 
            FROM productos a 
            INNER JOIN categoria b 
            ON a.idcategoria = b.idcategoria
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function obtenerallproducts()
    {
        $query = "CALL obtenerallproducts()";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $result = $stmt->get_result();

        $row = $result->fetch_assoc();

        return $row['total_productos'];
    }
    public function crearProducto($nombre, $descripcion, $precio, $stock, $idcategoria)
    {
        $query = "INSERT INTO productos (nombre_producto, descripcion, precio, stock, idcategoria) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $stock, $idcategoria);
        return $stmt->execute();
    }

    public function obtenerProductoPorId($producto_id)
    {
        $query = "SELECT * FROM productos WHERE producto_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $producto_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizarProducto($producto_id, $nombre, $descripcion, $precio, $stock, $idcategoria)
    {
        $query = "UPDATE productos 
                  SET nombre_producto = ?, descripcion = ?, precio = ?, stock = ?, idcategoria = ? 
                  WHERE producto_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdiii", $nombre, $descripcion, $precio, $stock, $idcategoria, $producto_id);
        return $stmt->execute();
    }

    public function eliminarProducto($producto_id)
    {
        $query = "DELETE FROM productos WHERE producto_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $producto_id);
        return $stmt->execute();
    }

    // Obtener las categorías
    public function obtenerCategorias()
    {
        $query = "SELECT * FROM categoria";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }
}
?>