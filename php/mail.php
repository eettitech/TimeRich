<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../js/mailer/Exception.php';
require '../js/mailer/PHPMailer.php';
require '../js/mailer/SMTP.php';

// $name = $_POST['name'];
// $email = $_POST['email'];
// $subject = $_POST['subject'];
// $message = $_POST['message'];

$name = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['name']);
$email = preg_replace('/[^-a-zA-Z0-9_@.]/', '', $_POST['email']);
$subject = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['subject']);
$message = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['message']);

try {
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->CharSet = "UTF-8";
	$mail->SMTPAuth = true;

	$mail->Host = 'smtp.gmail.com';
	$mail->Username = 'timerich.service@gmail.com';
	$mail->Password = 'TimeRich@321';
    $mail->SMTPOptions = array(
     'ssl' => array(
         'verify_peer' => false,
         'verify_peer_name' => false,
         'allow_self_signed' => true
     )
 );
	$mail->Port = 587;
	// $mail->Port = 993;
	$mail->setFrom('timerich.service@gmail.com', 'Time Rich');

	$mail->addAddress('timerich.service@gmail.com');

	$mail->isHTML(true);
	$mail->Subject = 'Get In Touch Form';
	$mail->Body = 'Client name - ' . $name . '<br>' . 'Email - ' . $email . '<br>' . 'Looking For - ' . $subject . '<br>' . 'Message - ' . $message;
	echo $mail->send();
} catch (Exception $e) {
	echo("error");
    echo $mail->ErrorInfo;
}
