<?php
include_once '../Model/Producto.php';

class ProductController
{
    private $model;
    private $connection;
    public function __construct($db)
    {
        $this->model = new Producto($db);
    }
    public function listarProductos()
    {
        return $this->model->listarProductos();
    }
    function obtenerallproducts()
    {
        $result = $this->model->obtenerallproducts();
        return $result;
    }
    public function obtenerProductoCategoria()
    {
        return $this->model->obtenerProductoCategoria();
    }
  
    
    public function obtenerTotalProductos()
    {
        return $this->model->obtenerallproducts();
    }

    public function crearProducto($nombre, $descripcion, $precio, $stock, $idcategoria)
    {
        return $this->model->crearProducto($nombre, $descripcion, $precio, $stock, $idcategoria);
    }

    public function obtenerProductoPorId($productoid)
    {
        return $this->model->obtenerProductoPorId($productoid);
    }

    public function actualizarProducto($productoid, $nombre, $descripcion, $precio, $stock, $idcategoria)
    {
        return $this->model->actualizarProducto($productoid, $nombre, $descripcion, $precio, $stock, $idcategoria);
    }

    public function eliminarProducto($productoid)
    {
        return $this->model->eliminarProducto($productoid);
    }
    public function tenertodo()
    {
        return $this->model->tenertodo();
    }
    public function obtenerCategorias()
    {
        return $this->model->obtenerCategorias();
    }





}
?>