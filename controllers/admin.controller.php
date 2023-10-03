<?php include_once(__DIR__ . "/../models/admin.model.php");

    class AdminController {

        private $adminController;

        public function __construct() {
            $this->adminController = new AdminModel();
        }

        public function headerSecurity() {
            $this->adminController->headerSecurity();
        }

        public function getByIdAdmin() {
            $response = $this->adminController->getById();
            return $response->fetch_assoc();
        }
    }