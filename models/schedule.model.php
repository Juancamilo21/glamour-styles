<?php

include_once(__DIR__ . "/../shared/base.modelController.php");
include_once(__DIR__ . "/../config/database.php");

class ScheduleModel implements BaseModelControllers {

    private $idSchedule;
    private $customerId;
    private $employeeId;
    private $serviceId;
    private $title;
    private $color;
    private $dateSchedules;
    private $startTime;
    private $endTime;
    private $attendance;

    protected $databaseConnecion;

    public function __construct() {
        $this->databaseConnecion = new DatabaseConnection();
    }

    public function getIdSchedule() {
        return $this->idSchedule;
    }

    public function setIdSchedule($idSchedule) {
        $this->idSchedule = $idSchedule;
    }

    public function getCustomerId() {
        return $this->customerId;
    }

    public function setCustomerId($customerId) {
        $this->customerId = $customerId;
    }

    public function getEmployeeId() {
        return $this->employeeId;
    }

    public function setEmployeeId($employeeId) {
        $this->employeeId = $employeeId;
    }

    public function getServiceId() {
        return $this->serviceId;
    }

    public function setServiceId($serviceId) {
        $this->serviceId = $serviceId;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getColor() {
        return $this->color;
    }

    public function setColor($color) {
        $this->color = $color;
    }

    public function getDateSchedules() {
        return $this->dateSchedules;
    }

    public function setDateSchedules($dateSchedules) {
        $this->dateSchedules = $dateSchedules;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function setStartTime($startTime) {
        $this->startTime = $startTime;
    }
    
    public function getEndTime() {
        return $this->endTime;
    }

    public function setEndTime($endTime) {
        $this->endTime = $endTime;
    }
    
    public function setAttendance($attendance) {
        $this->attendance = $attendance;
    }

    public function getAttendace() {
        return $this->attendance;
    }

    public function findAll() {
    }

    public function findById() {
        $idSchedule = $this->idSchedule;
        
        $sql = "SELECT
        sc.*,
        customer.names AS customer_names,
        customer.lastnames AS customer_lastnames,
        employee.names AS employee_names,
        employee.lastnames AS employee_lastnames,
        service.*
        FROM schedules sc 
        INNER JOIN users customer ON customer.id_user = sc.customer_id 
        INNER JOIN users employee ON employee.id_user = sc.employee_id
        INNER JOIN services service ON sc.service_id = service.id_service
        WHERE sc.id_schedules = $idSchedule";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }

    public function findSchedulesEmployee() {
        $employeeId = $this->employeeId;
        $serviceId = $this->serviceId;
        
        $sql = "SELECT DISTINCT sc.*, employee.names, employee.lastnames 
        FROM schedules sc 
        INNER JOIN users employee ON sc.employee_id = employee.id_user
        INNER JOIN users emp ON sc.service_id = emp.service_id
        WHERE sc.employee_id = $employeeId AND sc.service_id = $serviceId";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }

    public function findSchedulesCustomer() {
        $customerId = $this->customerId;
        
        $sql = "SELECT * FROM schedules WHERE customer_id = $customerId";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }

    public function findSchedulesEmployeeForDate() {
        $employeeId = $this->employeeId;
        $serviceId = $this->serviceId;
        $date = $this->dateSchedules;

        $sql = "SELECT DISTINCT
        sc.*,
        employee.names AS employee_names,
        employee.lastnames AS employee_lastnames,
        customer.names AS customer_names,
        customer.lastnames AS customer_lastnames,
        s.*
        FROM schedules sc 
        INNER JOIN users employee ON sc.employee_id = employee.id_user
        INNER JOIN users emp ON sc.service_id = emp.service_id
        INNER JOIN users customer ON sc.customer_id = customer.id_user
        INNER JOIN services s ON sc.service_id = s.id_service
        WHERE sc.employee_id = $employeeId AND sc.service_id = $serviceId AND sc.date_schedules = '$date'";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }

    public function findSchedulesCustomerForDate() {
        $customerId = $this->customerId;
        $date = $this->dateSchedules;

        $sql = "SELECT
        sc.*,
        customer.names AS customer_names,
        customer.lastnames AS customer_lastnames,
        employee.names AS employee_names,
        employee.lastnames AS employee_lastnames,
        s.*
        FROM schedules sc
        INNER JOIN users customer ON sc.customer_id = customer.id_user
        INNER JOIN users employee ON sc.employee_id = employee.id_user
        INNER JOIN services s ON sc.service_id = s.id_service
        WHERE customer.id_user = $customerId AND sc.date_schedules = '$date'";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }

    public function create() {
        $customerId = $this->customerId;
        $employeeId = $this->employeeId;
        $serviceId = $this->serviceId;
        $title = $this->title;
        $color = $this->color;
        $dateSchedules = $this->dateSchedules;
        $startTime = $this->startTime;
        $endTime = $this->endTime;
        
        $sql = "INSERT INTO schedules(customer_id, employee_id, service_id, title, color, date_schedules, start_time, end_time)
        VALUES ($customerId, $employeeId, $serviceId, '$title', '$color', '$dateSchedules', '$startTime', '$endTime')";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }

    public function update() {
        $idSchedule = $this->idSchedule;
        $title = $this->title;
        $color = $this->color;
        $dateSchedules = $this->dateSchedules;
        $startTime = $this->startTime;
        $endTime = $this->endTime;
        
        $sql = "UPDATE schedules SET title = '$title', color = '$color', date_schedules = '$dateSchedules', start_time = '$startTime', end_time = '$endTime' WHERE id_schedules = $idSchedule";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }

    public function updateAttendance() {
        $idSchedule = $this->idSchedule;
        $attendance = $this->attendance;
        $sql = "UPDATE schedules SET attendance = $attendance WHERE id_schedules = $idSchedule";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }

    public function delete() {
        $idSchedule = $this->idSchedule;
        $sql = "DELETE FROM schedules WHERE id_schedules = $idSchedule";

        $connection = $this->databaseConnecion->connection();
        $result = $connection->query($sql);

        $connection->close();

        return $result;
    }

    public function verifyScheduleEmployee() {
        $employeeId = $this->employeeId;
        $dateSchedules = $this->dateSchedules;
        $startTime = $this->startTime;
        $endTime = $this->endTime;

        $sql = "SELECT *
        FROM schedules
        WHERE employee_id = $employeeId
          AND date_schedules = '$dateSchedules'
          AND (
            (start_time <= '$startTime' AND end_time > '$startTime')
            OR (start_time < '$endTime' AND end_time >= '$endTime')
            OR (start_time >= '$startTime' AND end_time <= '$endTime')
          )";

          $connection = $this->databaseConnecion->connection();
          $result = $connection->query($sql);

          $connection->close();

         if ($result->num_rows > 0) return false;

         return true;
    }

    public function verifyScheduleCustomer() {
        $customerId = $this->customerId;
        $dateSchedules = $this->dateSchedules;
        $startTime = $this->startTime;
        $endTime = $this->endTime;

        $sql = "SELECT *
        FROM schedules
        WHERE customer_id = $customerId
          AND date_schedules = '$dateSchedules'
          AND (
            (start_time <= '$startTime' AND end_time > '$startTime')
            OR (start_time < '$endTime' AND end_time >= '$endTime')
            OR (start_time >= '$startTime' AND end_time <= '$endTime')
          )";

          $connection = $this->databaseConnecion->connection();
          $result = $connection->query($sql);

          $connection->close();

         if ($result->num_rows > 0) return false;

         return true;
    }
}
