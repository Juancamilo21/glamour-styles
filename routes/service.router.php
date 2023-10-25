<?php include_once(__DIR__ . "/../controllers/service.controller.php");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        requestsPost();
    }

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        requestsGet();
    }

    function requestsPost() {
        if (isset($_POST["route"])) {
            switch ($_POST["route"]) {
                case "create":
                    $serviceController = new ServiceController();
                    $serviceController->create();
                    break;
                
                case "update":
                    $serviceController = new ServiceController();
                    $serviceController->update();
                    break;
            }
        }
    }

    function requestsGet() {
        if (isset($_GET["route"])) {
            switch ($_GET["route"]) {
                case "services":
                    $serviceController = new ServiceController();
                    $result = $serviceController->findAll();
                    $data = array();

                    foreach ($result as $row) {
                        $data[] = $row;
                    }
                    echo json_encode($data);
                    break;

                case "serviceId":
                    $serviceController = new ServiceController();
                    $result = $serviceController->findById();
                    break;

                case "delete":
                    $serviceController = new ServiceController();
                    $serviceController->delete();
                    break;
            }
        }
    }
