<?php
include_once(__DIR__ . "/../models/user.model.php");
include_once(__DIR__ . "/../shared/base.modelController.php");
include_once(__DIR__ . "/../shared/token.php");
include_once(__DIR__ . "/../PHPMailer/email.php");

class UserController implements BaseModelControllers
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function loginUser()
    {

        if (!isset($_POST["email"]) && !isset($_POST["password"])) {
            return;
        }
        $email = $_POST["email"];
        $password = $_POST["password"];

        $this->userModel->setEmail($email);

        $row = $this->userModel->loginUser()->fetch_assoc();

        if (!isset($row["email"])) {
            http_response_code(401);
            echo json_encode(array("message" => "El email ingresado no está registrado"));
            return;
        }

        if ($row["rol"] === "Employee") {
            http_response_code(401);
            echo json_encode(array("message" => "Este usuario no tiene permisos de acceso"));
            return;
        }

        $verifyPasswordHash = $this->verifyPassword($password, $row["password"]);
        if (!$verifyPasswordHash) {
            http_response_code(401);
            echo json_encode(array("message" => "La contraseña ingresada es incorrecta"));
            return;
        }
        session_start();
        $_SESSION["rol"] = $row["rol"];
        $_SESSION["idUser"] = $row["id"];
        $_SESSION["email"] = $row["email"];

        echo json_encode(array("role" => $row["rol"]));
    }

    public function logOutUser()
    {
        session_start();
        session_destroy();
        echo "<script>location.href = '../index.php'</script>";
    }

    public function header()
    {
        session_start();
        if (!isset($_SESSION["email"])) {
            header("location: ../../index.php");
        }
    }

    public function hashedPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 15]);
    }

    public function verifyPassword($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function findAll()
    {
    }

    public function findById()
    {
        $response = null;
        if (isset($_SESSION["idUser"])) {
            $this->userModel->setIdUser($_SESSION["idUser"]);
            $response = $this->userModel->findById();
        }
        return $response;
    }

    public function getById()
    {

        if (!isset($_GET["id"])) return;

        $this->userModel->setIdUser($_GET["id"]);
        $result = $this->userModel->findById();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(array("message" => "No fue posible obtener los datos"));
        }
    }

    public function findByEmail()
    {
    }

    public function findByRole($roleId)
    {
        $this->userModel->setRoleId($roleId);
        $result = $this->userModel->findByRole();
        return $result;
    }

    public function create()
    {
    }

    public function update()
    {
        if (
            !isset($_POST["id"]) && !isset($_POST["names"]) && !isset($_POST["lastnames"]) && !isset($_POST["age"]) && !isset($_POST["address"]) &&
            !isset($_POST["phoneNumber"]) && !isset($_POST["dci"]) && !isset($_POST["email"])
        ) {
            return;
        }

        $this->userModel->setIdUser($_POST["id"]);
        $this->userModel->setNames($_POST["names"]);
        $this->userModel->setLastnames($_POST["lastnames"]);
        $this->userModel->setAge($_POST["age"]);
        $this->userModel->setAddress($_POST["address"]);
        $this->userModel->setPhoneNumber($_POST["phoneNumber"]);
        $this->userModel->setDci($_POST["dci"]);
        $this->userModel->setEmail($_POST["email"]);

        $response = $this->userModel->update();

        if ($response) {
            echo json_encode(array("message" => "Actualizado exitosamente"));
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "Ha ocurrido un error inesperado, intentelo nuevamente"));
        }
    }

    public function delete()
    {

        if (!isset($_GET["id"])) return;

        $this->userModel->setIdUser($_GET["id"]);
        $result = $this->userModel->delete();

        if ($result) {
            echo json_encode(array("message" => "Se ha eliminado exitosamente"));
        } else {
            http_response_code(403);
            echo json_encode(array("message" => "Error al realizar la operación"));
        }
    }

    public function changePassword()
    {

        if (!isset($_POST["password"]) && !isset($_POST["passwordConfirm"]) && !isset($_POST["id"])) {
            return;
        }

        $password = $_POST["password"];
        $passwordConfirm = $_POST["passwordConfirm"];

        if ($password !== $passwordConfirm) {
            http_response_code(400);
            echo json_encode(array("message" => "Las contraseñas no coinciden"));
            return;
        }

        $newPassword = $this->hashedPassword($password);
        $this->userModel->setPassword($newPassword);
        $this->userModel->setIdUser($_POST["id"]);
        $res = $this->userModel->updatedPassword();
        if ($res) {
            echo json_encode(array("message" => "Contraseña cambiada exitosamente"));
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "No ha posible realizar la operación"));
        }
    }

    public function updatePassword()
    {

        if (
            !isset($_POST["password"]) && !isset($_POST["passwordConfirm"]) && !isset($_POST["uid"])
            && !isset($_POST["token"])
        ) {
            return;
        }

        $password = $_POST["password"];
        $passwordConfirm = $_POST["passwordConfirm"];

        if ($password !== $passwordConfirm) {
            http_response_code(400);
            echo json_encode(array("message" => "Las contraseñas no coinciden"));
            return;
        }

        $this->userModel->setToken($_POST["token"]);
        $result = $this->userModel->findByToken();
        $row = $result->fetch_assoc();
        if (!$this->verifyToken($result, $row["time_token"])) {
            http_response_code(400);
            echo json_encode(array("message" => "No es posible realizar la operación, solicite un nuevo enlace"));
            return;
        }

        $newPassword = $this->hashedPassword($password);
        $this->userModel->setPassword($newPassword);
        $this->userModel->setIdUser($_POST["uid"]);
        $res = $this->userModel->updatedPassword();
        if ($res) {
            echo json_encode(array("message" => "Contraseña cambiada exitosamente"));
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "No es posible realizar la operación, solicite un nuevo enlace"));
        }
    }

    public function findByToken()
    {
        if (!isset($_GET["token"])) return;

        $this->userModel->setToken($_GET["token"]);
        $result = $this->userModel->findByToken();
        $row = $result->fetch_assoc();

        if (!isset($row["time_token"])) {
            http_response_code(404);
            echo json_encode(array("message" => "El recurso solicitado no tiene ningún tipo de consistencia"));
            return;
        }

        if (!$this->verifyToken($result, $row["time_token"])) {
            http_response_code(404);
            echo json_encode(array("message" => "El recurso solicitado no tiene ningún tipo de consistencia"));
            return;
        }

        echo json_encode($row);
    }

    public function verifyToken($res, $time)
    {
        if ($res->num_rows <= 0) return false;

        if (time() > $time) return false;

        return true;
    }

    public function recoverPassword()
    {
        if (!isset($_POST["email"])) {
            return;
        }

        $this->userModel->setEmail($_POST["email"]);

        $result = $this->userModel->findByEmail();

        if ($result->num_rows <= 0) {
            http_response_code(404);
            echo json_encode(array("message" => "El email ingresado no está registrado"));
            return;
        }

        $row = $result->fetch_assoc();

        if ($row["role_id"] === "3") {
            http_response_code(401);
            echo json_encode(array("message" => "Este usuario no tiene permisos de realizar esta acción"));
            return;
        }

        $token = generateToken();
        $timeExpire = time() + 1800;

        $this->userModel->setIdUser($row["id_user"]);
        $this->userModel->setToken($token);
        $this->userModel->setTimeExpireToken($timeExpire);
        $result = $this->userModel->updateToken();
        if (!$result) {
            http_response_code(400);
            echo json_encode(array("message" => "No fue posible completar esta opearión"));
            return;
        }

        $userNames = $row["names"] . " " . $row["lastnames"];

        $emailSender = new EmailSender();
        $resultSendEmail = $emailSender->sendEmail($row["email"], $userNames, $token);
        if ($resultSendEmail) {
            echo json_encode(array("message" => "Se ha enviado un correo a su dirección de email con los pasos a seguir"));
        } else {
            http_response_code(400);
            echo json_encode(array("message" => "No fue posible completar esta opearión"));
        }
    }
}
