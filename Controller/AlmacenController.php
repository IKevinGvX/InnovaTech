<?php
require_once '../Model/Almacen.php';

class AlmacenController
{
    private $model;
    private $connection;

    public function __construct($db)
    {
        $this->model = new AlmacenModel($db);
    }

    public function obtenerAlmacenes()
    {
        return $this->model->obtenerAlmacenes();
    }

    public function obtenerAlmacenPorId($almacenid)
    {
        return $this->model->obtenerAlmacenPorId($almacenid);
    }
    function ContarRegistrosDetalleMovimiento()
    {
        $result = $this->model->ContarRegistrosDetalleMovimiento();
        return $result;
    }
    public function crearAlmacen($nombrealmacen, $direccionalmacen)
    {
        return $this->model->crearAlmacen($nombrealmacen, $direccionalmacen);
    }
    public function actualizarAlmacen($almacenid, $nombrealmacen, $direccionalmacen)
    {
        return $this->model->actualizarAlmacen($almacenid, $nombrealmacen, $direccionalmacen);
    }
    public function eliminarAlmacen($almacenid)
    {
        return $this->model->eliminarAlmacen($almacenid);
    }
}
?>