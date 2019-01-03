<?php
require 'PHPMailer-5.2-stable/PHPMailerAutoload.php';
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'quangzetsu@gmail.com';                 // SMTP username
$mail->Password = 'Gicungduoc1';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('no-rep@gmail.com', 'Sender');
$mail->addAddress('quangvh62@wru.vn', 'Receiver');     // Add a recipient
	#$mail->addAddress('ellen@example.com');               // Name is optional
	#$mail->addReplyTo('info@example.com', 'Information');
	#$mail->addCC('cc@example.com');
	#$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	#$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'day la subject';
$mail->Body    = 'day la body';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
	return false;
} else {
	return true;
	echo('motherfucker');
}

?>
