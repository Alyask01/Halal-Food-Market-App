<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                      			    //Enable verbose debug output
    $mail->isSMTP();                                           //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                //Enable SMTP authentication
    $mail->Username   = 'alyaskhudier01@gmail.com';               //SMTP username
    $mail->Password   = 'mnaitgatuqzkvygu';                //SMTP Generated App password
    $mail->SMTPSecure = 'tls';            			    //Enable implicit TLS encryption
    $mail->Port       = 587;                             //TCP port to connect to; use 587 if you have tls

    //Recipients
    $mail->setFrom('halalfoodmarket101@gmail.com', 'Ahmad Banasaeed');
    $mail->addAddress('9177700323@tmomail.net');
    $mail->addAddress('halalfoodmarket101@gmail.com');     					//Add a recipient
                  
   
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'New Online Order Placed at Halal Food Market';
    $mail->Body    = 'Please check the admin portal, and review the customer order.</b>';
    $mail->AltBody = 'Please check the admin portal, and review the customer order.';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>php