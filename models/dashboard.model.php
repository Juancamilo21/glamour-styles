<?php

include_once(__DIR__ . "/../config/database.php");

class DashboardModel
{

    private $databaseConnection;

    public function __construct()
    {
        $this->databaseConnection = new DatabaseConnection();
    }

    public function numbersOf()
    {
        $sql = "SELECT
        (SELECT COUNT(*) FROM users WHERE role_id = 3) AS number_employee,
        (SELECT COUNT(*) FROM services) AS number_services,
        (SELECT COUNT(*) FROM schedules) AS number_schedules";

        $connection = $this->databaseConnection->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }
}
