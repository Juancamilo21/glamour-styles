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

        public function findAll() {
        }
        
        public function findById() {
            $idUser = $this->getIdUser();
            $sql = "SELECT * FROM customers c 
            INNER JOIN users u ON c.user_id = u.id_user
            WHERE u.id_user = $idUser";
    
            $connection = $this->databaseConnecion->connection();
            return $connection->query($sql);
        }

        public function create() {
            $roleId = $this->getRoleId();
            $names = $this->getNames();
            $lastnames = $this->getLastnames();
            $age = $this->getAge();
            $address = $this->getAddress();
            $phoneNumber = $this->getPhoneNumber();
            $dci = $this->getDci();
            $email = $this->getEmail();
            $password = $this->getPassword();
            $photoPath = $this->getPhotoPath();

            $sql = "CALL register_customer($roleId, '$names', '$lastnames', $age, '$address', '$phoneNumber', '$dci', '$email', '$password', '$photoPath')";

            $connection = $this->databaseConnecion->connection();
            return $connection->query($sql);
        }
    }
