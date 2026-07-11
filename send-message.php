<?php

require "config.php";

require "mail-config.php";

require "vendor/autoload.php";


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



if($_SERVER["REQUEST_METHOD"] != "POST"){

    header("Location: contact.html");

    exit();

}


/*
|--------------------------------------------------------------------------
| GET FORM DATA
|--------------------------------------------------------------------------
*/


$fullname = trim($_POST["fullname"]);

$email = trim($_POST["email"]);

$phone = trim($_POST["phone"]);

$service = trim($_POST["service"]);

$message = trim($_POST["message"]);




/*
|--------------------------------------------------------------------------
| EMAIL CONTENT
|--------------------------------------------------------------------------
*/


$subject = "New Contact Message From VIP Rental Website";


$email_message = "

You have received a new message from your website.

--------------------------------

Name:
$fullname

Email:
$email

Phone:
$phone

Service:
$service

Message:

$message

--------------------------------

";



/*
|--------------------------------------------------------------------------
| SEND EMAIL USING PHPMailer
|--------------------------------------------------------------------------
*/
$mail = new PHPMailer(true);

$mail->SMTPDebug = 2;


try {


    // SMTP SETTINGS

    $mail->isSMTP();

    $mail->Host = "smtp.gmail.com";

    $mail->SMTPAuth = true;

    $mail->Username = $email_username;

    $mail->Password = $email_password;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->Port = 587;



    // EMAIL DETAILS

    $mail->setFrom(
        $email_username,
        "Raymond Kadri VIP Rentals"
    );


    $mail->addAddress($admin_email);


    $mail->addReplyTo(
        $email,
        $fullname
    );



    $mail->Subject = $subject;

    $mail->Body = $email_message;



    $mail->send();



    echo "

    <script>

    alert('Message sent successfully.');

    window.location.href='contact.html';

    </script>

    ";


}catch (Exception $e) {

    echo "Mailer Error: " . $mail->ErrorInfo;

}
// } catch (Exception $e) {


//     echo "

//     <script>

//     alert('Message could not be sent.');

//     window.location.href='contact.html';

//     </script>

//     ";


// }



?>