<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    requestsPost();
}

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    requestsGet();
}

function requestsPost() {
    if (isset($_POST["route"])) {
        include_once(__DIR__ . "/../controllers/schedule.controller.php");
        $scheduleController = new ScheduleController();

        switch($_POST["route"]) {
            case "createSchedule":
                $scheduleController->create();
                break;
        }
    }
}

function requestsGet() {
    if (isset($_GET["route"])) {
        include_once(__DIR__ . "/../controllers/schedule.controller.php");
        $scheduleController = new ScheduleController();

        switch($_GET["route"]) {
            case "calendarEmployee":
                $scheduleController->findSchedulesEmployee();
                break;

            case "calendarCustomer":
                $scheduleController->findSchedulesCustomer();
                break;

            case "calendar":
                $scheduleController->findById();
                break;
            
            case "dayEmp":
                $scheduleController->findSchedulesEmployeeForDate();
                break;

            case "dayCustom":
                $scheduleController->findSchedulesCustomerForDate();
                break;
        }
    }
}
