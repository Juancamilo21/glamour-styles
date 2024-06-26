
<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    requestsPost();
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    requestsGet();
}

function requestsPost()
{
    include_once(__DIR__ . "/../controllers/user.controller.php");
    $userController = new UserController();
    if (isset($_POST["route"])) {
        switch ($_POST["route"]) {
            case "createAdmin":
                include_once(__DIR__ . "/../controllers/admin.controller.php");
                $adminController = new AdminController();
                $adminController->create();
                break;

            case "updateUser":
                $userController->update();
                break;

            case "createEmployee":
                include_once(__DIR__ . "/../controllers/employee.controller.php");
                $employeeController = new EmployeeController();
                $employeeController->create();
                break;

            case "createCustomer":
                include_once(__DIR__ . "/../controllers/customer.controller.php");
                $customerController = new CustomerController();
                $customerController->create();
                break;

            case "updateEmployee":
                include_once(__DIR__ . "/../controllers/employee.controller.php");
                $employeeController = new EmployeeController();
                $employeeController->update();
                break;

            case "updatePassword":
                $userController->updatePassword();
                break;

            case "changePassword":
                $userController->changePassword();
                break;

            case "login":
                $userController->loginUser();
                break;

            case "recoverPassword":
                $userController->recoverPassword();
                break;
        }
    }
}

function requestsGet()
{
    include_once(__DIR__ . "/../controllers/user.controller.php");
    $userController = new UserController();
    if (isset($_GET["route"])) {
        switch ($_GET["route"]) {
            case "idUser":
                $userController->getById();
                break;

            case "idEmployee":
                include_once(__DIR__ . "/../controllers/employee.controller.php");
                $employeeController = new EmployeeController();
                $employeeController->findEmployeeById();
                break;

            case "role":
                $result = $userController->findByRole($_GET["roleId"]);
                $data = array();

                foreach ($result as $row) {
                    $data[] = $row;
                }
                echo json_encode($data);
                break;

            case "employee":
                include_once(__DIR__ . "/../controllers/employee.controller.php");
                $employeeController = new EmployeeController();
                $result = $employeeController->findByRole($_GET["roleId"]);
                break;

            case "employeeService":
                include_once(__DIR__ . "/../controllers/employee.controller.php");
                $employeeController = new EmployeeController();
                $employeeController->getEmployeeService();
                break;

            case "delete":
                $userController->delete();
                break;

            case "verifyToken":
                $userController->findByToken();
                break;
        }
    }
}
