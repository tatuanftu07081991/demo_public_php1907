<?php
//PHP Mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require $_SERVER['DOCUMENT_ROOT'].'/175em/vendor/autoload.php';


$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'winboy.tt@gmail.com';
$mail->Password = 'vodanh14091991';
$mail->SMTPOptions = array(
    'ssl' => array(
    'verify_peer' => false,
    'verify_peer_name' => false,
    'allow_self_signed' => true
    )
);
$mail->SMTPSecure = 'ssl';
$mail->Port = 465;   //587
$mail->setFrom('winboy.tt@gmail.com');
$mail->isHTML(true);