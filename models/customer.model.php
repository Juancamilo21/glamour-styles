<?php
include_once(__DIR__ . "/user.model.php");

class CustomerModel extends UserModel
{

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $roleId = $this->getRoleId();
        $names = $this->getNames();
        $lastnames = $this->getLastnames();
        $age = $this->getAge();
        $address = $this->getAddress();
        $phoneNumber = $this->getPhoneNumber();
        $dci = $this->getDci();
        $email = $this->getEmail();
        $password = $this->getPassword();

        $sql = "INSERT INTO users(role_id, names, lastnames, age, address, phone_number, dci, email, password) 
            VALUES
            ($roleId, '$names', '$lastnames', $age, '$address', '$phoneNumber', '$dci', '$email', '$password')";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }
}
