<?php
include_once(__DIR__ . "/../shared/base.modelController.php");
include_once(__DIR__ . "/../models/schedule.model.php");
session_start();

class ScheduleController implements BaseModelControllers
{

    private $scheduleModel;

    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
    }

    public function findAll()
    {
    }

    public function findById()
    {
        if (!isset($_GET["idSchedule"])) return;

        $this->scheduleModel->setIdSchedule($_GET["idSchedule"]);
        $result = $this->scheduleModel->findById();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "No se pudieron obtener los detalles de esta agenda"));
        }
    }

    public function findSchedulesEmployee()
    {
        if (!isset($_GET["employeeId"]) && !isset($_GET["serviceId"])) return;

        $this->scheduleModel->setEmployeeId($_GET["employeeId"]);
        $this->scheduleModel->setServiceId($_GET["serviceId"]);
        $result = $this->scheduleModel->findSchedulesEmployee();

        if ($result->num_rows <= 0) {
            http_response_code(404);
            echo json_encode(array("message" => "No se pudieron obtener los calendarios correspondientes"));
            return;
        }
        $data = array();
        foreach ($result as $row) {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    public function findSchedulesCustomer()
    {
        if (!isset($_SESSION["idUser"])) return;

        $this->scheduleModel->setCustomerId($_SESSION["idUser"]);
        $result = $this->scheduleModel->findSchedulesCustomer();

        if ($result->num_rows <= 0) {
            http_response_code(404);
            echo json_encode(array("message" => "No se pudieron obtener los calendarios correspondientes"));
            return;
        }
        $data = array();
        foreach ($result as $row) {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    public function findSchedulesEmployeeForDate()
    {
        if (!isset($_GET["employeeId"]) && !isset($_GET["serviceId"]) && !isset($_GET["date"])) return;

        $this->scheduleModel->setEmployeeId($_GET["employeeId"]);
        $this->scheduleModel->setServiceId($_GET["serviceId"]);
        $this->scheduleModel->setDateSchedules($_GET["date"]);
        $result = $this->scheduleModel->findSchedulesEmployeeForDate();

        if ($result->num_rows <= 0) {
            http_response_code(400);
            echo json_encode(array("message" => "No se pudieron obtener los calendarios correspondientes"));
            return;
        }

        $data = array();
        foreach ($result as $row) {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    public function findSchedulesCustomerForDate()
    {
        if (!isset($_SESSION["idUser"]) && !isset($_GET["date"])) return;

        $this->scheduleModel->setCustomerId($_SESSION["idUser"]);
        $this->scheduleModel->setDateSchedules($_GET["date"]);
        $result = $this->scheduleModel->findSchedulesCustomerForDate();

        if ($result->num_rows <= 0) {
            http_response_code(404);
            echo json_encode(array("message" => "No hay agendas que mostrar"));
            return;
        }

        $data = array();
        foreach ($result as $row) {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    public function create()
    {
        if (
            !isset($_SESSION["idUser"]) && !isset($_POST["employeeId"]) && !isset($_POST["serviceId"])
            && !isset($_POST["title"]) && !isset($_POST["color"]) && !isset($_POST["date"]) &&
            !isset($_POST["startTime"]) && !isset($_POST["endTime"])
        ) {
            return;
        }

        if ($_POST["endTime"] <= $_POST["startTime"]) {
            http_response_code(400);
            echo json_encode(array("message" => "El horario de finalización no debe ser menor o igual al de inicio"));
            return;
        }

        $diffInSeconds = strtotime($_POST["endTime"]) - strtotime($_POST["startTime"]);
        $minHourDifference = 60 * 60;

        if ($diffInSeconds < $minHourDifference) {
            http_response_code(400);
            echo json_encode(array("message" => "La cita debe tener una duración mínima de 1 hora"));
            return;
        }

        $this->scheduleModel->setCustomerId($_SESSION["idUser"]);
        $this->scheduleModel->setEmployeeId($_POST["employeeId"]);
        $this->scheduleModel->setServiceId($_POST["serviceId"]);
        $this->scheduleModel->setTitle($_POST["title"]);
        $this->scheduleModel->setColor($_POST["color"]);
        $this->scheduleModel->setDateSchedules($_POST["date"]);
        $this->scheduleModel->setStartTime($_POST["startTime"]);
        $this->scheduleModel->setEndTime($_POST["endTime"]);


        if (!$this->scheduleModel->verifyScheduleEmployee()) {
            http_response_code(400);
            echo json_encode(array("message" => "Este horario no está disponible, trate con otro"));
            return;
        }

        if (!$this->scheduleModel->verifyScheduleCustomer()) {
            http_response_code(400);
            echo json_encode(array("message" => "Este horario no está disponible, trate con otro"));
            return;
        }

        $result = $this->scheduleModel->create();

        if ($result) {
            echo json_encode(array("message" => "La cita se ha agendado con exito"));
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "No fue posible agendar en este horario, trate con otro"));
        }
    }

    public function update()
    {
        if (
            !isset($_POST["id"]) && !isset($_POST["employeeId"]) && !isset($_POST["customerId"]) && !isset($_POST["title"])
            && !isset($_POST["color"]) && !isset($_POST["date"]) && !isset($_POST["startTime"]) && !isset($_POST["endTime"])
        ) {
            return;
        }

        if ($_POST["endTime"] <= $_POST["startTime"]) {
            http_response_code(400);
            echo json_encode(array("message" => "El horario de finalización no debe ser menor o igual al de inicio"));
            return;
        }

        $diffInSeconds = strtotime($_POST["endTime"]) - strtotime($_POST["startTime"]);
        $minHourDifference = 60 * 60;

        if ($diffInSeconds < $minHourDifference) {
            http_response_code(400);
            echo json_encode(array("message" => "La cita debe tener una duración mínima de 1 hora"));
            return;
        }

        $this->scheduleModel->setIdSchedule($_POST["id"]);
        $this->scheduleModel->setEmployeeId($_POST["employeeId"]);
        $this->scheduleModel->setCustomerId($_POST["customerId"]);
        $this->scheduleModel->setTitle($_POST["title"]);
        $this->scheduleModel->setColor($_POST["color"]);
        $this->scheduleModel->setDateSchedules($_POST["date"]);
        $this->scheduleModel->setStartTime($_POST["startTime"]);
        $this->scheduleModel->setEndTime($_POST["endTime"]);


        if (!$this->scheduleModel->verifyScheduleEmployee() && $this->scheduleModel->verifyScheduleCustomer()) {
            http_response_code(400);
            echo json_encode(array("message" => "Este horario no está disponible, trate con otro"));
            return;
        }

        if ($this->scheduleModel->verifyScheduleEmployee() && !$this->scheduleModel->verifyScheduleCustomer()) {
            http_response_code(400);
            echo json_encode(array("message" => "Este horario no está disponible, trate con otro"));
            return;
        }

        $result = $this->scheduleModel->update();

        if ($result) {
            echo json_encode(array("message" => "La agendado se ha editado con exito"));
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "No fue posible editar la agenda en este horario, trate con otro"));
        }
    }

    public function updateAttendance()
    {
        if (!isset($_GET["id"]) && !isset($_GET["attendance"])) return;

        $this->scheduleModel->setIdSchedule($_GET["id"]);
        $this->scheduleModel->setAttendance($_GET["attendance"]);

        $result = $this->scheduleModel->updateAttendance();

        if (!$result) {
            http_response_code(400);
            echo json_encode(array("message" => "Hubo un error, intentelo de nuevo"));
        }
    }

    public function delete()
    {
        if (!isset($_GET["id"])) return;

        $this->scheduleModel->setIdSchedule($_GET["id"]);
        $result = $this->scheduleModel->delete();

        if ($result) {
            echo json_encode(array("message" => "La agenda ha sido eliminada"));
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "La agenda no pudo ser eliminada"));
        }
    }
}
