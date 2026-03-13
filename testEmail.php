<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/vendor/autoload.php'; // make sure vendor is in your project

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'kgaugelomatshela@gmail.com';       // your Gmail email
    $mail->Password   = '0003105695088';         // Gmail App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('matshelakgaugelo@gmail.com', 'kgauza');
    $mail->addAddress('kgaugelomatshela@gmail.com', 'Kgaugelo'); // recipient

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Mail';
    $mail->Body    = 'This is a test message from PHPMailer.';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
?>
