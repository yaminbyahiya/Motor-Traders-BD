<?php
if($ue!="" && $un!="")
{
	$bodytext = "
	Hello ADMIN,<br>
	<br>
	This request was came from user <b>$un</b> ($ue)<br>for the MT Report of this <a target='_blank' href='https://motortraderbd.com/vehicle_details.php?pid=$pid'>POST # $pid</a>.<br>
	<br>
	Please take the proper action on this regards.<br>
	<br>
	MOTOR TRADER ADMIN<br>
	<br>
	<img src='http://motortraderbd.com/images/logo.png' alt='MOTO TRADER'><br>
	We have the right products to fit your needs<br>
	<br>
	<br>
	*** This is an auto generated email, please do not reply to this email ***<br>
	<br>
	<br>
	<font size=1>DISCLAIMER: This email (including any attachments) is intended only for use by the named addressee(s) and may contain private, confidential and/or privileged material. Any reliance, dissemination, distribution, review, copy or other use of this email by person(s) who are not the intended recipient is prohibited. If you have received this email in error, please notify the sender immediately by email and permanently delete the email and any copies (including print-outs). E-mail transmission cannot be guaranteed to be secure or error-free as information could be intercepted, corrupted, lost, destroyed, arrive late or incomplete, or contain viruses. The sender therefore does not accept liability for any errors or omissions in the contents of this message, which arise as a result of e-mail transmission.</font><br>
	<br>
	";
	
	//PHPMailer
	require_once("emails/php-mailer/PHPMailerAutoload.php");

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;									// Enable verbose debug output

	$mail->isSMTP();										// Set mailer to use SMTP
	$mail->Host = 'mail.motortraderbd.com';  				// Specify main and backup SMTP servers
	$mail->SMTPAuth = false;									// Enable SMTP authentication
	$mail->Username = 'info@motortraderbd.com';				// SMTP username
	$mail->Password = 'Dhaka.2021@#$';						// SMTP password
	$mail->SMTPSecure = 'ssl';								// Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;										// TCP port to connect to

	$mail->SetFrom('info@motortraderbd.com', 'Motor Trader');		// Name is optional
	$mail->AddAddress("$ue", "$un");								// Add a recipient
	//$mail->addAddress('ellen@example.com');						// Name is optional
	$mail->addReplyTo("info@motortraderbd.com", "Motor Trader");
	//$mail->addCC("ccaddress@ccdomain.com", "Some CC Name");
	$mail->addBCC("archives@motortraderbd.com", "Archives");
	
	$mail->addAttachment("$mtrpt", "MT-RPT".$fileExt);         		// Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    		// Optional name
	$mail->isHTML(true);                                  			// Set email format to HTML
	
	
	$mail->Subject = "Download MT Report ($pid)";
	$mail->Body = $bodytext;
	$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	if(!$mail->send())
	{
		echo 'Message could not be sent. ';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
	else {
		echo 'Message has been sent';
	}
}
?>
