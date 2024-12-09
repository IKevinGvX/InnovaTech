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

    public function mostrarProductos()
    {
        $productos = $this->model->obtenerProductoCategoria();
        return $productos;
    }
    function obtenerallproducts()
    {
        $result = $this->model->obtenerallproducts();
        return $result;
    }
}
?>