<?php
    include_once(__DIR__ . "/../config/database.php");
    include_once(__DIR__ . "/../shared/base.modelController.php");

    class UserModel implements BaseModelControllers {

        private $idUser;
        private $roleId;
        private $names;
        private $lastnames;
        private $age;
        private $address;
        private $phoneNumber;
        private $salary;
        private $dci;
        private $email;
        private $password;
        private $token;
        private $timeExpireToken;

        protected $databaseConnecion;

        public function __construct() {
            $this->databaseConnecion = new DatabaseConnection();
        }

        public function getIdUser() {
            return $this->idUser;
        }

        public function setIdUser($idUser) {
            $this->idUser = $idUser;
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

        public function getAge() {
            return $this->age;
        }

        public function setAge($age) {
            $this->age = $age;
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

        public function setSalary($salry) {
            $this->salary = $salry;
        }

        public function getSalary() {
            return $this->salary;
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

        public function setToken($token) {
            $this->token = $token;
        }

        public function getToken() {
            return $this->token;
        }

        public function setTimeExpireToken($time) {
            $this->timeExpireToken = $time;
        }

        public function getTimeExpireToken() {
            return $this->timeExpireToken;
        }

        public function loginUser() {
            $email = $this->email;
            $sql = "SELECT id_user AS id, role_name AS rol, email, password FROM users u 
                    INNER JOIN roles r ON r.id_role = u.role_id 
                    WHERE u.email = '$email'";

            $connection = $this->databaseConnecion->connection();
            return $connection->query($sql);
        }

        public function findAll(){}

        public function findById(){
            $idUser = $this->getIdUser();
            $sql = "SELECT * FROM users WHERE id_user = $idUser";
            $connection = $this->databaseConnecion->connection();
            return $connection->query($sql);
        }

        public function findByRole() {
            $roleId = $this->getRoleId();
            $sql = "SELECT * FROM users WHERE role_id = $roleId";

            $connection = $this->databaseConnecion->connection();
            $result = $connection->query($sql);

            $connection->close();

            return $result;
        }
        
        public function findByEmail() {
            $email = $this->email;
            $sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";

            $connection = $this->databaseConnecion->connection();
            return $connection->query($sql);
        }

        public function findByToken() {
            $token = $this->token;
            $sql = "SELECT * FROM users WHERE token = '$token' LIMIT 1";

            $connection = $this->databaseConnecion->connection();
            $result = $connection->query($sql);

            $connection->close();

            return $result;
        }

        public function create() {}
        
        public function update() {
            $idUser = $this->idUser;
            $names = $this->names;
            $lastnames = $this->lastnames;
            $age = $this->age;
            $address = $this->address;
            $phoneNumber = $this->phoneNumber;
            $dci = $this->dci;
            $email = $this->email;

            $sql = "UPDATE users SET names = '$names', lastnames = '$lastnames', age = '$age', address = '$address', phone_number = '$phoneNumber', dci = '$dci', email = '$email' WHERE id_user = $idUser";

            $connection = $this->databaseConnecion->connection();
            $result = $connection->query($sql);

            $connection->close();

            return $result;
        }

        public function delete(){
            $idUser = $this->idUser;
            $sql = "DELETE FROM users WHERE id_user = $idUser";

            $connection = $this->databaseConnecion->connection();
            $result = $connection->query($sql);

            $connection->close();
            
            return $result;
        }

        public function updateToken() {
            $idUser = $this->idUser;
            $token = $this->token;
            $time = $this->timeExpireToken;
            $sql = "UPDATE users SET token = '$token', time_token = $time WHERE id_user = $idUser";

            $connection = $this->databaseConnecion->connection();
            $result = $connection->query($sql);

            $connection->close();

            return $result;
        }

        public function updatedPassword() {
            $idUser = $this->idUser;
            $newPassword = $this->password;
            $sql = "UPDATE users SET password = '$newPassword' WHERE id_user = $idUser";

            $connection = $this->databaseConnecion->connection();
            $result = $connection->query($sql);

            $connection->close();

            return $result;
        }
    }
