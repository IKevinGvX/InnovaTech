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
    public function mostrarProductos()
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

    public function obtenerProductoPorId($producto_id)
    {
        return $this->model->obtenerProductoPorId($producto_id);
    }

    public function actualizarProducto($producto_id, $nombre, $descripcion, $precio, $stock, $idcategoria)
    {
        return $this->model->actualizarProducto($producto_id, $nombre, $descripcion, $precio, $stock, $idcategoria);
    }

    public function eliminarProducto($producto_id)
    {
        return $this->model->eliminarProducto($producto_id);
    }

    public function obtenerCategorias()
    {
        return $this->model->obtenerCategorias();
    }





}
?>