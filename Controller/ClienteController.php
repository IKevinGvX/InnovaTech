<?php
require_once '../Model/Cliente.php';

class ClienteController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new ClienteModel($db);
    }

    public function obtenerClientes()
    {
        return $this->model->obtenerClientes();
    }

    public function obtenerClientePorId($cliente_id)
    {
        return $this->model->obtenerClientePorId($cliente_id);
    }

    public function crearCliente($usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion)
    {
        return $this->model->crearCliente($usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion);
    }

    public function actualizarCliente($cliente_id, $usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion)
    {
        return $this->model->actualizarCliente($cliente_id, $usuario_id, $nombre, $apellido, $fecha_nac, $dni, $ruc, $correo, $telefono, $direccion);
    }

    public function eliminarCliente($cliente_id)
    {
        return $this->model->eliminarCliente($cliente_id);
    }
}
?>