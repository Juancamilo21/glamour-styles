<?php 
    include_once(__DIR__ . "/../models/admin.model.php");
    include_once(__DIR__ . "/user.controller.php");

    class AdminController extends UserController {

        private $adminController;

        public function __construct() {
            $this->adminController = new AdminModel();
        }
        
        public function findAll(){}
        
        public function findById() {
            $response = $this->adminController->findById();
            return $response->fetch_assoc();
        }

        public function create(){}
        public function update(){}
        public function delete(){}
    }