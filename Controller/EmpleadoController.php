<?php
include_once '../Model/Empleado.php';

class EmpleadoController
{
    private $model;
    private $connection;

    public function __construct($db)
    {
        $this->model = new Empleado($db);
    }

    public function listarEmpleados()
    {
        return $this->model->listarEmpleados();
    }

    public function obtenerEmpleadoPorId($empleadoid)
    {
        return $this->model->obtenerEmpleadoPorId($empleadoid);
    }

    public function crearEmpleado($usuario_id, $rango, $nombre, $apellido, $fecha_nac, $dni, $correo, $telefono, $direccion)
    {
        return $this->model->crearEmpleado($usuario_id, $rango, $nombre, $apellido, $fecha_nac, $dni, $correo, $telefono, $direccion);
    }

    public function actualizarEmpleado($empleadoid, $usuario_id, $rango, $nombre, $apellido, $fecha_nac, $dni, $correo, $telefono, $direccion)
    {
        return $this->model->actualizarEmpleado($empleadoid, $usuario_id, $rango, $nombre, $apellido, $fecha_nac, $dni, $correo, $telefono, $direccion);
    }


    public function eliminarEmpleado($empleadoid)
    {
        return $this->model->eliminarEmpleado($empleadoid);
    }
}
?>