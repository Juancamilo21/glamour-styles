<?php
include_once(__DIR__ . "/user.model.php");

class EmployeeModel extends UserModel
{

    private $serviceId;

    public function __construct()
    {
        parent::__construct();
    }

    public function getServiceId()
    {
        return $this->serviceId;
    }

    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;
    }

    public function findByRole()
    {
        $roleId = $this->getRoleId();
        $idUser = $this->getIdUser();
        $sql = "SELECT * FROM users u INNER JOIN services s ON u.service_id = s.id_service WHERE (role_id = $roleId) AND (id_user = $idUser)";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }

    public function findEmployeeById()
    {
        $idEmployee = $this->getIdUser();

        $sql = "SELECT * FROM users WHERE id_user = $idEmployee AND role_id = 3";
        $connection = $this->databaseConnecion->connection();

        $result = $connection->query($sql);

        return $result;
    }

    public function getEmployeeService()
    {
        $idService = $this->serviceId;
        $sql = "SELECT * FROM users WHERE service_id = $idService";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }

    public function create()
    {
        $roleId = $this->getRoleId();
        $serviceId = $this->getServiceId();
        $names = $this->getNames();
        $lastnames = $this->getLastnames();
        $age = $this->getAge();
        $address = $this->getAddress();
        $phoneNumber = $this->getPhoneNumber();
        $dci = $this->getDci();
        $email = $this->getEmail();
        $salary = $this->getSalary();

        $sql = "INSERT INTO users(role_id, service_id, names, lastnames, age, address, phone_number, salary, dci, email) 
            VALUES
            ($roleId, $serviceId ,'$names', '$lastnames', $age, '$address', '$phoneNumber', $salary, '$dci', '$email')";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }

    public function update()
    {
        $idUser = $this->getIdUser();
        $names = $this->getNames();
        $lastnames = $this->getLastnames();
        $age = $this->getAge();
        $address = $this->getAddress();
        $phoneNumber = $this->getPhoneNumber();
        $dci = $this->getDci();
        $email = $this->getEmail();
        $salary = $this->getSalary();

        $sql = "UPDATE users SET names = '$names', lastnames = '$lastnames', age = $age, address = '$address', phone_number = '$phoneNumber', salary = '$salary', dci = '$dci', email = '$email'
            WHERE id_user = $idUser";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }
}
