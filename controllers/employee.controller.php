<?php 
    include_once(__DIR__ . "/user.controller.php");
    include_once(__DIR__ . "/../models/employee.model.php");

    class EmployeeController extends UserController {

        private $employeeModel;

        public function __construct() {
            $this->employeeModel = new EmployeeModel();
        }

        public function findByRole($roleId) {
            if (!isset($_GET["idUser"])){
                http_response_code(400);
                return;
            } 
                
            $this->employeeModel->setRoleId($roleId);
            $this->employeeModel->setIdUser($_GET["idUser"]);
            $result = $this->employeeModel->findByRole();

            if ($result) {
                $data = $result->fetch_assoc();
                echo json_encode($data);
            } else {
                http_response_code(500);
            }
        }

        public function getEmployeeService() {
            if (!isset($_GET["service"])) {
                http_response_code(400);
                return;
            }

            $this->employeeModel->setServiceId($_GET["service"]);
            $result = $this->employeeModel->getEmployeeService();

            if(!$result) {
                http_response_code(500);
                return;
            }

            $data = array();
            foreach($result as $row) {
                $data[] = $row;
            }
            echo json_encode($data);
        }

        public function create() {
            if (
                !isset($_POST["names"]) && !isset($_POST["lastnames"]) && !isset($_POST["age"]) && !isset($_POST["address"]) &&
                !isset($_POST["phoneNumber"]) && !isset($_POST["salary"]) && !isset($_POST["dci"]) && !isset($_POST["email"])
                && !isset($_POST["service"])
            ) {
                return;
            }

            $this->employeeModel->setEmail($_POST["email"]);
            $userByEmail = $this->employeeModel->findByEmail();
            if($userByEmail->num_rows > 0) {
                http_response_code(400);
                echo json_encode(array("message" => "El email ingresado ya existe"));
                return;
            }

            $this->employeeModel->setRoleId(3);
            $this->employeeModel->setServiceId($_POST["service"]);
            $this->employeeModel->setNames($_POST["names"]);
            $this->employeeModel->setLastnames($_POST["lastnames"]);
            $this->employeeModel->setAge($_POST["age"]);
            $this->employeeModel->setAddress($_POST["address"]);
            $this->employeeModel->setPhoneNumber($_POST["phoneNumber"]);
            $this->employeeModel->setSalary($_POST["salary"]);
            $this->employeeModel->setDci($_POST["dci"]);
            $this->employeeModel->setEmail($_POST["email"]);

            $response = $this->employeeModel->create();

            if($response) {
                echo json_encode(array("message" => "Empleado registrado exitosamente"));
            } else  {
                http_response_code(500);
                echo json_encode(array("message" => "Ha ocurrido un error inesperado, intentelo nuevamente"));
            }
        }

        public function update() {
            if (
                !isset($_POST["id"]) && !isset($_POST["names"]) && !isset($_POST["lastnames"]) && !isset($_POST["age"]) && !isset($_POST["address"]) &&
                !isset($_POST["phoneNumber"]) && !isset($_POST["salary"]) && !isset($_POST["dci"]) && !isset($_POST["email"])
            ) {
                return;
            }

            $this->employeeModel->setIdUser($_POST["id"]);
            $this->employeeModel->setNames($_POST["names"]);
            $this->employeeModel->setLastnames($_POST["lastnames"]);
            $this->employeeModel->setAge($_POST["age"]);
            $this->employeeModel->setAddress($_POST["address"]);
            $this->employeeModel->setPhoneNumber($_POST["phoneNumber"]);
            $this->employeeModel->setSalary($_POST["salary"]);
            $this->employeeModel->setDci($_POST["dci"]);
            $this->employeeModel->setEmail($_POST["email"]);

            $response = $this->employeeModel->update();

            if($response) {
                echo json_encode(array("message" => "Empleado actualizado exitosamente"));
            } else  {
                http_response_code(500);
                echo json_encode(array("message" => "Ha ocurrido un error inesperado, intentelo nuevamente"));
            }
            
        }


    }