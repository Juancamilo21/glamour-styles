<?php
    include_once(__DIR__ . "/../config/database.php");
    include_once(__DIR__ . "/../shared/base.modelController.php");

    class ServiceModel implements BaseModelControllers {

        private $idService;
        private $serviceName;
        private $price;
        private $imagePath;

        protected $databaseConnecion;
        
        public function __construct() {
            $this->databaseConnecion = new DatabaseConnection();
        }

        public function getIdService() {
            return $this->idService;
        }
        
        public function setIdService($idService) {
            $this->idService = $idService;
        }

        public function getServiceName() {
            return $this->serviceName;
        }
        
        public function setServiceName($serviceName) {
            $this->serviceName = $serviceName;
        }

        public function getPrice() {
            return $this->price;
        }

        public function setPrice($price) {
            $this->price = $price;
        }


        public function getImagePath() {
            return $this->imagePath;
        }

        public function setImagePath($imagePath) {
            $this->imagePath = $imagePath;
        }

        public function findAll() {
            $sql = "SELECT * FROM services";

            $connection = $this->databaseConnecion->connection();
            $result = $connection->query($sql);

            $connection->close();

            return $result;
        }

        public function findById() {
            $idService = $this->idService;
            $sql = "SELECT * FROM services WHERE id_service = $idService";

            $connection = $this->databaseConnecion->connection();
            $result = $connection->query($sql);

            $connection->close();

            return $result;
        }

        public function create() {
            $serviceName = $this->serviceName;
            $price = $this->price;
            $imagePath = $this->imagePath;

            $sql = "INSERT INTO services(service_name, price, image_path)
            VALUES
            ('$serviceName', $price, '$imagePath')";

            $connection = $this->databaseConnecion->connection();
            $response = $connection->query($sql);

            $connection->close();

            return $response;
        }

        public function update() {
            $idService = $this->idService;
            $serviceName = $this->serviceName;
            $price = $this->price;
            //$imagePath = $this->imagePath;
            $sql = "UPDATE services SET service_name = '$serviceName', price = '$price' WHERE id_service = $idService";

            $connection = $this->databaseConnecion->connection();
            $result = $connection->query($sql);

            $connection->close();

            return $result;
        }

        public function delete() {
            $idService = $this->idService;
            $sql = "DELETE FROM services WHERE id_service = $idService";

            $connection = $this->databaseConnecion->connection();
            $result = $connection->query($sql);

            $connection->close();

            return $result;
        }

    }