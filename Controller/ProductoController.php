<?php
include_once '../Model/Producto.php';

class ProductController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new Producto($db);
    }

    public function mostrarProductos()
    {
        $productos = $this->model->obtenerProductoCategoria();
        return $productos;
    }
}
?>