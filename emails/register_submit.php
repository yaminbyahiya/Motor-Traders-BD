<?php
if($email!="")
{
	$headers = "MIME-Version: 1.0"."\r\n";
	$headers.= "Content-type:text/html;charset=UTF-8"."\r\n";
	$headers.= "From: MotorTraderBD <info@motortraderbd.com>"."\r\n";
	//$headers.= "Cc: "."\r\n";
	$headers.= "Bcc: archives@motortraderbd.com"."\r\n";
	//$headers.= "Reply-To: care@bondstein.com"."\r\n";
	$headers.= "X-Mailer: PHP/".phpversion();

	$to = "$email";
	$subject = "You have registered to MotorTraderBD, please verify your email";
	$msg = "
	Hello $name,<br>
	<br>
	Thank you for signing up with Motor Trader. We are looking forward to a great experience together but you're just one step away from completing your sign-up process.<br>
	<br>
	<br>
	Please click on the link below to <b>verify your email</b>.<br>
	<a target='_blank' href='http://motortraderbd.com/verify_email.php?data=$data&code=$code'>http://motortraderbd.com/verify_email.php?data=$data&code=$code</a><br>
	<br>
	<br>
	If you <b>did not sign-up</b> to our service, please click on the link below.<br>
	<a target='_blank' href='http://motortraderbd.com/didnot_signup.php?code=$code&data=$data'>http://motortraderbd.com/didnot_signup.php?code=$code&data=$data</a><br>
	<br>
	<br>
	Best Regards,<br>
	<br>
	<img src='http://motortraderbd.com/images/logo.png' alt='MotorTraderBD'><br>
	We have the right products to fit your needs<br>
	<br>
	<br>
	*** This is an auto generated email, please do not reply to this email ***<br>
	<br>
	<br>
	<font size=1>DISCLAIMER: This email (including any attachments) is intended only for use by the named addressee(s) and may contain private, confidential and/or privileged material. Any reliance, dissemination, distribution, review, copy or other use of this email by person(s) who are not the intended recipient is prohibited. If you have received this email in error, please notify the sender immediately by email and permanently delete the email and any copies (including print-outs). E-mail transmission cannot be guaranteed to be secure or error-free as information could be intercepted, corrupted, lost, destroyed, arrive late or incomplete, or contain viruses. The sender therefore does not accept liability for any errors or omissions in the contents of this message, which arise as a result of e-mail transmission.</font><br>
	<br>
	";

	mail($to, $subject, $msg, $headers);
}
?>
