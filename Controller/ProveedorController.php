<?php
require_once '../Model/Proveedor.php';

class ProveedorController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new ProveedorModel($db);
    }

    public function obtenerProveedores()
    {
        return $this->model->obtenerProveedores();
    }

    public function obtenerProveedorPorId($proveedor_id)
    {
        return $this->model->obtenerProveedorPorId($proveedor_id);
    }
    public function crearProveedor($usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion)
    {
        return $this->model->crearProveedor($usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion);
    }

    public function actualizarProveedor($proveedor_id, $usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion)
    {
        return $this->model->actualizarProveedor($proveedor_id, $usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion);
    }


    public function eliminarProveedor($proveedor_id)
    {
        return $this->model->eliminarProveedor($proveedor_id);
    }
}
?>