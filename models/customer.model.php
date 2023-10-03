<?php
    include_once(__DIR__ . "/user.model.php");

    class CustomerModel extends UserModel {

        private $idCustomer;

        public function __construct() {
            parent::__construct();
        }

        public function getIdCustomer() {
            return $this->idCustomer;
        }

        public function setIdCustomer($idCustomer) {
            $this->idCustomer = $idCustomer;
        }

        public function getAll() {
        }
        
        public function getById() {
            $idUser = $_SESSION["idUser"];
            $sql = "SELECT * FROM customers c 
            INNER JOIN users u ON c.user_id = u.id_user
            WHERE u.id_user = $idUser";
    
            $connection = $this->databaseConnecion->connection();
            return $connection->query($sql);
        }
    }
