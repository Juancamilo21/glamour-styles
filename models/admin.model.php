<?php include_once(__DIR__ . "/user.model.php");

    class AdminModel extends UserModel {

        public function __construct() {
            parent::__construct();
        }

        public function getAll() {
        }
        
        public function getById() {
            $idUser = $_SESSION["idUser"];
            $sql = "SELECT * FROM users WHERE id_user = $idUser";
    
            $connection = $this->databaseConnecion->connection();
            return $connection->query($sql);
        }

    }