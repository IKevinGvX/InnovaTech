<?php
class usuarios
{
    private $connexion;

    public function __construct($db)
    {
        $this->connexion = $db;
    }

    public function InsertUser($email, $contraseña, $fecha, $rol_id)
    {
        $proc = "CALL ingresar_usuario(?, ?, ?,?)";

        if ($stmt = $this->connexion->prepare($proc)) {
            $stmt->bind_param("ssss", $email, $contraseña, $fecha, $rol_id);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function obtenerUsuarios()
    {
        $query = "SELECT * FROM usuario";
        return $this->connexion->query($query);
    }

    public function obtenerUsuarioPorId($usuario_id)
    {
        $query = "SELECT * FROM usuario WHERE usuario_id = ?";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("i", $usuario_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function actualizarUsuario($usuario_id, $email, $contrasena, $rol_id, $fecha_creacion)
    {
        $query = "UPDATE usuario SET email = ?, contrasena = ?, rol_id = ?, fecha_creacion = ? WHERE usuario_id = ?";
        $stmt = $this->connexion->prepare($query);

        if (!$stmt) {
            throw new Exception("Error al preparar la consulta: " . $this->connexion->error);
        }

        $stmt->bind_param("ssisi", $email, $contrasena, $rol_id, $fecha_creacion, $usuario_id);

        if (!$stmt->execute()) {
            throw new Exception("Error al ejecutar la consulta: " . $stmt->error);
        }

        return true;
    }


    public function eliminarUsuario($usuario_id)
    {
        $query = "DELETE FROM usuario WHERE usuario_id = ?";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("i", $usuario_id);
        return $stmt->execute();
    }

}
?>