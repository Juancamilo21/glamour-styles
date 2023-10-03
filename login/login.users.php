<?php include_once(__DIR__ . "/../database/database.php");

    class LoginUsers {

        private $email;
        private $password;
        private $databaseConnecion;

        public function __construct() {
            $this->email = "";
            $this->password = "";
            $this->databaseConnecion = new DatabaseConnection();
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getPassword() {
            return $this->password;
        }

        public function setPassword($password) {
            $this->password = $password;
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
                header("location: ./admin/admin.services.php");
            } else {
                header("location: ./customer/customer.home.php");
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

    }
