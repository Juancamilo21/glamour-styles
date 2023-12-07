<?php
include_once(__DIR__ . "/../models/admin.model.php");
include_once(__DIR__ . "/user.controller.php");

class AdminController extends UserController
{

    private $adminMondel;

    public function __construct()
    {
        $this->adminMondel = new AdminModel();
    }

    public function create()
    {
        if (
            !isset($_POST["names"]) && !isset($_POST["lastnames"]) && !isset($_POST["age"]) && !isset($_POST["address"]) &&
            !isset($_POST["phoneNumber"]) && !isset($_POST["dci"]) && !isset($_POST["email"]) && !isset($_POST["password"])
        ) {
            return;
        }

        $this->adminMondel->setEmail($_POST["email"]);
        $userByEmail = $this->adminMondel->findByEmail();
        if ($userByEmail->num_rows > 0) {
            http_response_code(400);
            echo json_encode(array("message" => "El email ingresado ya existe"));
            return;
        }

        $hashedPassword = $this->hashedPassword($_POST["password"]);

        $this->adminMondel->setRoleId(1);
        $this->adminMondel->setNames($_POST["names"]);
        $this->adminMondel->setLastnames($_POST["lastnames"]);
        $this->adminMondel->setAge($_POST["age"]);
        $this->adminMondel->setAddress($_POST["address"]);
        $this->adminMondel->setPhoneNumber($_POST["phoneNumber"]);
        $this->adminMondel->setDci($_POST["dci"]);
        $this->adminMondel->setEmail($_POST["email"]);
        $this->adminMondel->setPassword($hashedPassword);

        $response = $this->adminMondel->create();

        if ($response) {
            echo json_encode(array("message" => "Administrador registrado exitosamente"));
        } else {
            http_response_code(500);
        }
    }
}
