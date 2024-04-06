<?php
// session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

require '../assets/packages/phpmailer/src/Exception.php';
require '../assets/packages/phpmailer/src/PHPMailer.php';
require '../assets/packages/phpmailer/src/SMTP.php';

if ($_POST) {
    $post = $_POST;
    if ($post["email"]) {
        $email = $db->real_escape_string($post["email"]);
        $result = $db->query("SELECT * from users where email='$email'");
        $result = $result->fetch_assoc();

        if ($result) {
            $otp = rand(100000, 999999);
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Enable verbose debug output
                $mail->isSMTP();
                $mail->Host = 'YOUR SMTP Server';
                $mail->SMTPAuth = true;
                $mail->Username = 'YOUR Mail ID';
                $mail->Password = 'MAIL Password';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;

                //Recipients
                $mail->setFrom('MAIL Password', 'Resume Builder');
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Forgot Password ?';
                $mail->Body = 'Your 6 Digit Verification code is : <b>' . $otp . '</b>';
                $mail->send();

                $fn->setSession('otp', $otp);
                $fn->setSession('email', $email);
                $fn->redirect("../verification.php");
            } catch (Exception $e) {
                $fn->setError($mail->ErrorInfo);
                $fn->redirect("../forgot-password.php");
            }
        }
    } else {
        $fn->redirect("../forgot-password.php");
    }

}