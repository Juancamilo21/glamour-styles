<?php include_once(__DIR__ . "/../models/user.model.php");

    class UserController {

        private $userModel;

        public function __construct() {
            $this->userModel = new UserModel();
        }

        public function loginUser() {
            $email = $_POST["email"];
            $password = $_POST["password"];
            if (isset($email) && isset($password)) {
                $this->userModel->setEmail($email);
                $this->userModel->setPassword($password);
                $this->userModel->login();
            }
        }

        public function logOutUser() {
            $this->userModel->logOut();
        }
    }
