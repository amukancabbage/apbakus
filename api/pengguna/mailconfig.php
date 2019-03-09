<?php

$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
//$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.hostinger.co.id";///your smtp host smtp.hostinger.co.id smtp.gmail.co.id mx1.hostinger.co.id
$mail->Port =587; // or 587 465
$mail->IsHTML(true);
$mail->Username = "admin@mirzayogy.com";////your username
$mail->Password = "kurniawan86";//your password
$mail->isHTML(true);
$mail->SetFrom("admin@mirzayogy.com","APBAKUS");

$mail->Body = "$message";

?>
