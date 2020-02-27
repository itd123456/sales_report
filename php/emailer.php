<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'PHPMailer/vendor/autoload.php';
require('database.php');

$email = $_POST['email'];

$db = new Database();

$sql = "SELECT fname
        FROM users
        WHERE email = '$email'";

$fname = $db->returnData($sql);
$fname = $fname[0]['fname'];

$newPass = md5('Welcome1');

$sql = "UPDATE users
        SET password = '$newPass'";

//Instantiation and passing `true` enables exceptions

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.office365.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'helpdesk@gdfi.ph';                     // SMTP username
    $mail->Password   = 'Sysad04!';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Recipients
    $mail->setFrom('helpdesk@gdfi.ph', 'Mailer');
    $mail->addAddress('johndee.pandaan.velasco@gmail.com', 'Joe User');     // 

    // Content
    $mail->isHTML(true);    

    $mail->Subject = 'Password Reset';
    $mail->Body    = 'Hi,'.$fname.',<br/><br/> Your new password is <b>Welcome1</b>';

    $mail->send();
    echo 'Message has been sent';
}
catch (Exception $e) 
{
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>