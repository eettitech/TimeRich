<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$lname = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['lname']);
$lphone= preg_replace('/[^-a-zA-Z0-9_]/', '', $_POST['lphone']);
$lemail = preg_replace('/[^-a-zA-Z0-9_@.]/', '', $_POST['lemail']);
$lcompanyname = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['lcompanyname']);
$ftruck = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['ftruck']);
$cr_length = preg_replace('/[^-a-zA-Z0-9_.]/', '', $_POST['cr_length']);
$cr_breath = preg_replace('/[^-a-zA-Z0-9_.]/', '', $_POST['cr_breath']);
$cr_height = preg_replace('/[^-a-zA-Z0-9_.]/', '', $_POST['cr_height']);
$cr_weight = preg_replace('/[^-a-zA-Z0-9_.]/', '', $_POST['cr_weight']);
$cr_type = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['cr_type']);
$origin = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['origin']);
$destination = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['destination']);
$specifics = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['specifics']);
$additional_info = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['additional_info']);

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    // $mail->SMTPDebug = 2;                                // Enable verbose debug output
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    // $mail->isSMTP(); 
    $mail-> true;                                     // Set mailer to use SMTP
    $mail->Host = 'mail.ssptlogistics.com';                  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'corporate@ssptlogistics.com';             // SMTP username
    $mail->Password = 'sspt@9842';                           // SMTP password
    // $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, TLS also accepted with port 465
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('corporate@ssptlogistics.com', 'SSPT Logistics');          //This is the email your form sends From
    $mail->addAddress('corporate@ssptlogistics.com', 'SSPT Logistics'); // Add a recipient address
    //$mail->addAddress('contact@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    $ct = nl2br("Name: {$lname} \r\n Phone: {$lphone} \r\n Email: {$lemail} \r\n Comapny Name: {$lcompanyname} \r\n Truck: {$ftruck} \r\n
Cargo Dimension: \r\n  Length: {$cr_length} \r\n Breath: {$cr_breath} \r\n Height: {$cr_height} \r\n Weight: {$cr_weight} \r\n Type of cargo: {$cr_type} \r\n
Cargo information: \r\n Origin: {$origin} \r\n Destination: {$destination} \r\n Specifics: {$specifics} \r\n Additional Info: {$additional_info} \r\n");

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Freight Request - {$lname} - {$lphone}";
    $mail->Body    = '<h4>'.$ct.'</h4>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();


    // Mail to user
    $mail->clearAllRecipients(); // clear all
    //Recipients
    $mail->setFrom('corporate@ssptlogistics.com', 'SSPT Logistics');          //This is the email your form sends From

    $mail->addAddress($lemail, $lname); // Add a recipient address
    $mail->Subject = "Subject";
    $mail->Body    = "Body of the Message";
    $mail->send();



    // echo 'Message has been sent to both admin and uer';
    // echo '<h1>'.$ct.'</h1>';
    echo "<script>
            document.body.innerHTML = '';
            alert('Thanks for your Freight request. We will get back to you soon');
            window.location.href='/request_freight.html';
            </script>";
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>