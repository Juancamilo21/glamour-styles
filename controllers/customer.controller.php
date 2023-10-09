<?php

    include_once(__DIR__ . "/../models/customer.model.php");
    include_once(__DIR__ . "/user.controller.php");
    include_once(__DIR__ . "/../shared/upload.file.php");

    class CustomerController extends UserController {

        private $customerModel;

        public function __construct() {
            $this->customerModel = new CustomerModel();
        }

        public function findAll() {
        }

        public function findById() {
            $this->customerModel->setIdUser($_SESSION["idUser"]);
            $response = $this->customerModel->findById();

            return $response->fetch_assoc();
        }

        public function create() {
            if (
                !isset($_POST["names"]) && !isset($_POST["lastnames"]) && !isset($_POST["age"]) && !isset($_POST["address"]) &&
                !isset($_POST["phoneNumber"]) && !isset($_POST["dci"]) && !isset($_POST["email"]) && !isset($_POST["password"])
            ) {
                return;
            }

            $this->customerModel->setEmail($_POST["email"]);
            $userByEmail = $this->customerModel->findByEmail();
            if($userByEmail->num_rows > 0){
                echo "<p class='alert'>El email: ". $_POST['email']. " ya existe</p>";
                return;
            }
            
            $photo = $_FILES["photo"];
            $photoTmp = $_FILES["photo"]["tmp_name"];
            $photoName = $_FILES["photo"]["name"];
            $photoError = $_FILES["photo"]["error"];
            
            $photoPath = pathUploadImage($photo, $photoTmp, $photoName, $photoError);

            $hashedPassword = $this->hashedPassword($_POST["password"]);
            
            $this->customerModel->setRoleId(2);
            $this->customerModel->setNames($_POST["names"]);
            $this->customerModel->setLastnames($_POST["lastnames"]);
            $this->customerModel->setAge($_POST["age"]);
            $this->customerModel->setAddress($_POST["address"]);
            $this->customerModel->setPhoneNumber($_POST["phoneNumber"]);
            $this->customerModel->setDci($_POST["dci"]);
            $this->customerModel->setEmail($_POST["email"]);
            $this->customerModel->setPassword($hashedPassword);
            $this->customerModel->setPhotoPath($photoPath);

            $response = $this->customerModel->create();
            if($response) {
                echo "<p class='alert' style='color: #007bff;'>Se ha registrado exitosamente</p>";
            }else  {
                echo "<p class='alert'>No se pudo registrar revise sus datos, intentelo nuevamente</p>";
            }
            
        }
        public function update() {
        }
        public function delete() {
        }

        
    }
