<?php

require './phpMailer/Exception.php';
require './phpMailer/PHPMailer.php';
require './phpMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if($_SERVER['REQUEST_METHOD']=='POST'){
	$datos=json_decode(file_get_contents("php://input"),true);

	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->Host = "smtp.titan.email";
	$mail->Port = 587;
	$mail->SMTPSecure = true;
	$mail->SMTPDebug = 2;

	$mail->SMTPAuth = true;
	$mail->Username = "bmarquez@megaproductosfamiliares.com";
	$mail->Password = "3003Joker";

	$mail->setFrom("bmarquez@megaproductosfamiliares.com", "Contacto Brian Marquez");
	$mail->addAddress("brianmarquez3003@gmail.com", "Brian Marquez");
	$mail->Subject = "Nueva Solicitud de Contacto";
	$mail->msgHTML("<h3>Nombre: </h3>" . $_POST['name'] . "<br/><h3>Correo: </h3>" . $_POST['email'] . "<br/><h3>Message: </h3>" . $_POST['message'], dirname(__FILE__));

	if (!$mail->send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
        header("Location: /?send=false");
	} else {
		echo "Message sent!";
        header("Location: /?send=true");
	}
}
?>