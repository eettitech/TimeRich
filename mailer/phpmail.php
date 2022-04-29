<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$fname = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['fname']);
$fphone= preg_replace('/[^-a-zA-Z0-9_]/', '', $_POST['fphone']);
$femail = preg_replace('/[^-a-zA-Z0-9_@.]/', '', $_POST['femail']);
$fticket = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['fticket']);
$fbooking = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['fbooking']);
$fdesc = preg_replace('/[^-a-zA-Z0-9_ ]/', '', $_POST['fdesc']);

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

    $ct = nl2br("Fullname: {$fname} \r\n Phone: {$fphone} \r\n Email: {$femail} \r\n Ticket type: {$fticket} \r\n Booking: {$fbooking} \r\n Decription: {$fdesc}");

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Enquiry - {$fname} - {$fphone}";
    $mail->Body    = '<h4>'.$ct.'</h4>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();


    // Mail to user
    $mail->clearAllRecipients(); // clear all
    //Recipients
    $mail->setFrom('corporate@ssptlogistics.com', 'SSPT Logistics');          //This is the email your form sends From

    $mail->addAddress($femail, $fname); // Add a recipient address
    $mail->Subject = "Subject";
    $mail->Body    = "Body of the Message";
    $mail->send();



    // echo 'Message has been sent to both admin and uer';
    // echo '<h1>'.$ct.'</h1>';
    echo "<script>
            document.body.innerHTML = '';
            alert('Thanks for your message. We will get back to you soon');
            window.location.href='/';
            </script>";
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

?>