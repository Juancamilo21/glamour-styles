<?php
    include_once(__DIR__ . "/../database/database.php");
    include_once(__DIR__ . "/base.model.php");

    class UserModel implements BaseModel {

        private $idUser;
        private $roleId;
        private $names;
        private $lastnames;
        private $address;
        private $phoneNumber;
        private $dci;
        private $email;
        private $password;
        private $photoPath;

        protected $databaseConnecion;

        public function __construct() {
            $this->databaseConnecion = new DatabaseConnection();
        }

        public function getIdUser() {
            return $this->idUser;
        }

        public function setRoleId($roleId) {
            $this->roleId = $roleId;
        }

        public function getRoleId() {
            return $this->roleId;
        }

        public function setNames($names) {
            $this->names = $names;
        }

        public function getNames() {
            return $this->names;
        }

        public function setLastnames($lastnames) {
            $this->lastnames = $lastnames;
        }

        public function getLastnames() {
            return $this->lastnames;
        }

        public function setAddress($address) {
            $this->address = $address;
        }

        public function getAddress() {
            return $this->address;
        }

        public function setPhoneNumber($phoneNumber) {
            $this->phoneNumber = $phoneNumber;
        }

        public function getPhoneNumber() {
            return $this->phoneNumber;
        }

        public function setDci($dci) {
            $this->dci = $dci;
        }

        public function getDci() {
            return $this->dci;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPhotoPath($photoPath)
        {
            $this->photoPath = $photoPath;
        }

        public function getPhotoPath()
        {
            return $this->photoPath;
        }

        public function login() {
            $email = $this->email;
            $password = $this->password;
            $sql = "SELECT id_user AS id, role_name AS rol, email, password FROM users u 
                    INNER JOIN roles r ON r.id_role = u.role_id 
                    WHERE u.email = '$email'";

            $connection = $this->databaseConnecion->connection();
            $row = $connection->query($sql)->fetch_assoc();

            if ($row["email"] !== $email) {
                echo "<p class='alert'>El correo ingresado es incorrecto</p>";
                return;
            }

            if ($row["password"] !== $password) {
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

        public function logOut() {
            session_start();
            session_destroy();
            echo "<script>location.href = '../index.php'</script>";
        }

        public function headerSecurity() {
            session_start();
            if (!isset($_SESSION["email"])) {
                header("location: ../index.php");
            }
        }

        function getAll(){}
        function getById(){}
        function create(){}
        function update(){}
        function delete(){}
    }
