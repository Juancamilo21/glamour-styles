<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once(__DIR__ . "/PHPMailer.php");
include_once(__DIR__ . "/SMTP.php");
include_once(__DIR__ . "/Exception.php");

class EmailSender
{

    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
    }

    public function sendEmail($emailAddress, $userNames, $token)
    {

        try {
            //$this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $this->mail->CharSet = "UTF-8";                    //Enable verbose debug output
            $this->mail->isSMTP();                                            //Send using SMTP
            $this->mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $this->mail->Username   = 'glamourstylessalon@gmail.com';                     //SMTP username
            $this->mail->Password   = 'ffzfbtjpzcfrbwnj';                               //SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $this->mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $this->mail->setFrom('glamourstylessalon@gmail.com', 'Glamour Styles Nueva Contraseña');
            $this->mail->addAddress($emailAddress, $userNames);     //Add a recipient

            $this->mail->isHTML(true);                                  //Set email format to HTML
            $this->mail->Subject = 'Recuperación de la Cuenta - Nueva Contraseña';
            $this->mail->Body    = "
            <article style='width: 500px; min-height:500px; border: 1px solid #EEEEEE;'>
                <div style='background-color: #BB006F; padding: 15px;'>
                    <h1 style='color: #fff; font-size: 25px; font-weght: bold;'>Hola, $userNames </h1>
                </div>
                <div style='padding: 15px;'>
                    <p style='font-size: 14px'>
                        Sr(a). <strong>$userNames</strong>, usted ha solicidato un cambio de contraseña para su cuenta del sitio Glamour Styles.
                        <br><br>
                        Por favor acceda al siguiente enlace para crear una nueva contraseña para su cuenta: <a href='http://localhost/glamour-styles/views/recover/forgot.password.php?token=$token'>Recuperar contraseña</a>
                    </p>

                    <p style='font-size: 14px'>
                        <strong>Nota:</strong> Este enlace solo es valido por 30 minutos desde el momento en que fue realizada la solicitud.
                    </p>

                    <p style='font-size: 14px'>
                        Si no ha sido usted, puede que alguien más esté intentado acceder a su cuenta.
                    </p>
                </div>
            
            </article>
            ";

            return $this->mail->send();
        } catch (Exception $e) {
            echo "Error: {$this->mail->ErrorInfo}";
        }
    }
}
