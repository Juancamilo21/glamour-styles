<?php

include_once(__DIR__ . "/../models/dashboard.model.php");

class DashboardController
{

    private $dashboardModel;

    public function __construct()
    {
        $this->dashboardModel = new DashboardModel();
    }

    public function numbersOf()
    {
        $result = $this->dashboardModel->numbersOf();

        if ($result->num_rows <= 0) {
            http_response_code(404);
            echo json_encode(array("message" => "No se pudieron obtener los resultados esperados", "number" => 0));
            return;
        }

        $data = $result->fetch_assoc();
        echo json_encode($data);
    }
}
