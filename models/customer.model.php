<?php
    include_once(__DIR__ . "/base.user.php");
    include_once(__DIR__ . "/../database/database.php");

    class CustomerModel extends BaseUser {

        private $idCustomer;
        private $databaseConnecion;

        public function __construct() {
            $this->databaseConnecion = new DatabaseConnection();
        
        }

        public function getIdCustomer() {
            return $this->idCustomer;
        }

        public function setIdCustomer($idCustomer) {
            $this->idCustomer = $idCustomer;
        }

        public function getAll() {

            $idUser = $_SESSION["idUser"];
            $sql = "SELECT u.names, u.lastnames, u.email FROM customers c 
                INNER JOIN users u ON c.user_id = u.id_user 
                WHERE u.id_user = $idUser";

            $connection = $this->databaseConnecion->connection();
            return $connection->query($sql)->fetch_assoc();
        }
    }
