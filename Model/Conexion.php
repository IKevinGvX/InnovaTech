<?php
class Conexion
{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "tp_Web"; // Nombre de la base de datos
    private $connection;

    // Constructor de la clase
    public function __construct()
    {
        // Intentamos conectar a la base de datos
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Verificamos si hubo algún error en la conexión
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    // Método para obtener la conexión
    public function getConnection()
    {
        return $this->connection;
    }

    // Método para cerrar la conexión
    public function closeConnection()
    {
        $this->connection->close();
    }
}
?>