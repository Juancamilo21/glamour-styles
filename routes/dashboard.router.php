<?php

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    requestsGet();
}

function requestsGet()
{
    if (isset($_GET["route"])) {
        include_once(__DIR__ . "/../controllers/dashboard.controller.php");
        $dashboardController = new DashboardController();

        switch ($_GET["route"]) {
            case "statistic":
                $dashboardController->numbersOf();
                break;
        }
    }
}
