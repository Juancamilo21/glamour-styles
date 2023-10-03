<?php include_once(__DIR__ . "/../models/customer.model.php");

    class CustomerController {

        private $customerModel;

        public function __construct() {
            $this->customerModel = new CustomerModel();
        }

        public function headerSecurity() {
            $this->customerModel->headerSecurity();
        }

        public function getByIdCustomer() {
            $response = $this->customerModel->getById();
            return $response->fetch_assoc();
        }
    }