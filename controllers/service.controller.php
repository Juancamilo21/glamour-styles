<?php
    include_once(__DIR__ . "/../shared/base.modelController.php");
    include_once(__DIR__ . "/../shared/upload.file.php");
    include_once(__DIR__ . "/../models/service.model.php");

    class ServiceController implements BaseModelControllers {

        private $serviceModel;

        public function __construct() {
            $this->serviceModel = new ServiceModel();
        }

        public function findAll() {
            $result = $this->serviceModel->findAll();
            return $result;
        }

        public function findById() {
            if(!isset($_GET["id"])) return;
            
            $this->serviceModel->setIdService($_GET["id"]);
            $result = $this->serviceModel->findById();

            if ($result) {
                $data = $result->fetch_assoc();
                http_response_code(200);
                echo json_encode($data);
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "Error al realizar la operación", "status" => 500));
            }
            
        }

        public function create() {

            if (
                !isset($_POST["serviceName"]) && !isset($_POST["price"])
                && !isset($_FILES["image"])
            ) {
                return;
            }

            $image = $_FILES["image"];
            $imageTmp = $_FILES["image"]["tmp_name"];
            $imageName = $_FILES["image"]["name"];
            $imageError = $_FILES["image"]["error"];
            
            $imagePath = pathUploadImage($image, $imageTmp, $imageName, $imageError);

            $this->serviceModel->setServiceName($_POST["serviceName"]);
            $this->serviceModel->setPrice($_POST["price"]);
            $this->serviceModel->setImagePath($imagePath);

            $result = $this->serviceModel->create();
            if ($result) {
                http_response_code(200);
                echo json_encode(array("message" => "Registro exitoso", "status" => 200));
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "Error al crear el servicio", "status" => 500));
            }
        }

        public function update() {
            if (
                !isset($_POST["serviceName"]) && !isset($_POST["price"])
                && isset($_POST["id"])
            ) {
                return;
            }

            /*$image = $_FILES["image"];
            $imageTmp = $_FILES["image"]["tmp_name"];
            $imageName = $_FILES["image"]["name"];
            $imageError = $_FILES["image"]["error"];
            
            $imagePath = pathUploadImage($image, $imageTmp, $imageName, $imageError);*/
            
            $this->serviceModel->setIdService($_POST["id"]);
            $this->serviceModel->setServiceName($_POST["serviceName"]);
            $this->serviceModel->setPrice($_POST["price"]);
            //$this->serviceModel->setImagePath($imagePath);
            $result = $this->serviceModel->update();

            if ($result) {
                http_response_code(200);
                echo json_encode(array("message" => "Servicio actualizado exitosamente", "status" => 200));
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "Error al actualizar la operación", "status" => 500));
            }
        }

        public function delete() {
            if(!isset($_GET["id"])) return;
            
            $this->serviceModel->setIdService($_GET["id"]);
            $result = $this->serviceModel->delete();

            if ($result) {
                echo json_encode(array("message" => "Servicio eliminado exitosamente", "status" => 200));
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "Error al realizar la operación", "status" => 500));
            }
        }



    }