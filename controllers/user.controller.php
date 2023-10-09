<?php 
    include_once(__DIR__ . "/../models/user.model.php");
    include_once(__DIR__ . "/../shared/base.modelController.php");

    class UserController implements BaseModelControllers {

        private $userModel;

        public function __construct() {
            $this->userModel = new UserModel();
        }

        public function loginUser() {
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            if (!isset($email) && !isset($password)) {
                return;
            }

            $this->userModel->setEmail($email);

            $row = $this->userModel->loginUser()->fetch_assoc();

            if ($row["email"] !== $email) {
                echo "<p class='alert'>El email ingresado es incorrecto</p>";
                return;
            }

            $verifyPasswordHash = $this->verifyPassword($password, $row["password"]);
            if (!$verifyPasswordHash) {
                echo "<p class='alert'>Su contraseña es incorrecta</p>";
                return;
            }
            
            $this->redirectLogin($row);
        }

        private function redirectLogin($row) {
            session_start();
            $_SESSION["rol"] = $row["rol"];
            $_SESSION["idUser"] = $row["id"];
            $_SESSION["email"] = $row["email"];

            if ($_SESSION["rol"] === "Admin") {
                header("location: ./views/admin/admin.services.php");
            } else {
                header("location: ./views/customer/customer.home.php");
            }
        }

        public function logOutUser() {
            session_start();
            session_destroy();
            echo "<script>location.href = '../index.php'</script>";
        }

        public function header() {
            session_start();
            if (!isset($_SESSION["email"])) {
                header("location: ../../index.php");
            }
        }

        public function hashedPassword($password) {
            return password_hash($password, PASSWORD_DEFAULT, ['cost' => 15]);
        }

        public function verifyPassword($password, $hash) {
            return password_verify($password, $hash);
        }

        public function findAll() {}
        public function findById() {}
        public function findByEmail() {}
        public function create() {}
        public function update() {}
        public function delete() {}
    }
