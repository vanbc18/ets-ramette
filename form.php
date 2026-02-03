<?php
require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
        $name = $_POST["name"];
        $business = $_POST["business"];
        $emailFrom = $_POST["email"];
        $tel = $_POST["tel"];
        $address = $_POST["adresse-postale"];
        $subject = $_POST["demande"];
        $msg = $_POST["msg"];

        $headers = "Expéditeur :".$emailFrom;
        $txt = "Vous avez reçu une demande de : ".$name. ". <br> Objet de la demande : ".$subject.". <br> Adresse postale : ".$address.". <br> Description : ".$msg."<br> Entreprise :".$business."<br> Tel : ".$tel;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->CharSet="UTF-8";
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = '	smtp.ionos.fr';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'remy.ramette@ets-ramette.fr';                 // SMTP username
$mail->Password = 'secret';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom("remy.ramette@ets-ramette.fr", $name);
$mail->addAddress('remy.ramette@ets-ramette.fr', 'Remy');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('remy.ramette@ets-ramette.fr', 'Remy Ramette');
$mail->addCC('van_cmoi@hotmail.com');
//$mail->addBCC('bcc@example.com');

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $headers;
$mail->Body    = $txt;
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Le message n\'a pas pu être envoyé';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Le message a été envoyé.';
}
