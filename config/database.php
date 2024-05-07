<?php

class DatabaseConnection
{

    private $dbHost;
    private $dbUser;
    private $dbPassword;
    private $dbName;

    public function __construct()
    {
        $this->dbHost = "";
        $this->dbUser = "";
        $this->dbPassword = "";
        $this->dbName = "";
    }

    public function connection()
    {
        try {
            $connection = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPassword, $this->dbName);
            if (!$connection) {
                throw new Exception("Error de conexión a la base de datos");
            }
            return $connection;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
