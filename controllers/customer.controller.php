<?php 

    include_once(__DIR__ . "/../models/customer.model.php");
    include_once(__DIR__ . "/user.controller.php");

    class CustomerController extends UserController {

        private $customerModel;

        public function __construct() {
            $this->customerModel = new CustomerModel();
        }

        public function findAll(){}
        
        public function findById() {
            $response = $this->customerModel->findById();
            
            return $response->fetch_assoc();
        }

        public function create(){}
        public function update(){}
        public function delete(){}
    }