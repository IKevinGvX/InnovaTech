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
                a.productoid, 
                a.nombreproducto, 
                a.descripcion, 
                a.precio, 
                a.stock, 
                a.idcategoria, 
                b.descripcioncate 
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
        $query = "INSERT INTO productos (nombreproducto, descripcion, precio, stock, idcategoria) 
                  VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdii", $nombre, $descripcion, $precio, $stock, $idcategoria);
        return $stmt->execute();
    }

    public function obtenerProductoPorId($productoid)
    {
        $query = "SELECT * FROM productos WHERE productoid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $productoid);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizarProducto($productoid, $nombre, $descripcion, $precio, $stock, $idcategoria)
    {
        $query = "UPDATE productos 
                  SET nombreproducto = ?, descripcion = ?, precio = ?, stock = ?, idcategoria = ? 
                  WHERE productoid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssdiii", $nombre, $descripcion, $precio, $stock, $idcategoria, $productoid);
        return $stmt->execute();
    }

    public function eliminarProducto($productoid)
    {
        $query = "DELETE FROM productos WHERE productoid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $productoid);
        return $stmt->execute();
    }

    public function obtenerCategorias()
    {
        $query = "SELECT idcategoria, descripcioncate FROM categoria";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
  
    }
    
}
?>