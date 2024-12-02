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
        $proc = "CALL ingresar_usuarios(?, ?, ?,?)"; // Nombre del procedimiento

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
}
?>