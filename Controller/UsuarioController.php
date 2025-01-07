<?php
require_once '../Model/Usuario.php';

class UsuarioController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new usuarios($db);
    }

    public function obtenerUsuarios()
    {
        return $this->model->obtenerUsuarios();
    }

    public function obtenerUsuarioPorId($usuario_id)
    {
        return $this->model->obtenerUsuarioPorId($usuario_id);
    }



    public function actualizarUsuario($usuario_id, $email, $contrasena, $rol_id, $fecha_creacion)
    {
        return $this->model->actualizarUsuario($usuario_id, $email, $contrasena, $rol_id, $fecha_creacion);
    }


    public function eliminarUsuario($usuario_id)
    {
        return $this->model->eliminarUsuario($usuario_id);
    }
}
?>