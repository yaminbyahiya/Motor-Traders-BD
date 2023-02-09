<?php
if($ue!="" && $un!="")
{
	$headers = "MIME-Version: 1.0"."\r\n";
	$headers.= "Content-type:text/html;charset=UTF-8"."\r\n";
	$headers.= "From: MotorTraderBD <info@motortraderbd.com>"."\r\n";
	//$headers.= "Cc: "."\r\n";
	$headers.= "Bcc: archives@motortraderbd.com"."\r\n";
	$headers.= "Reply-To: info@motortraderbd.com"."\r\n";
	$headers.= "X-Mailer: PHP/".phpversion();

	$to = "$ue";
	$subject = "Download MT Report ($pid)";
	$msg = "
	Hi $un,<br>
	<br>
	Here below is the MT Report of the post <a target='_blank' href='https://motortraderbd.com/vehicle_details.php?pid=$pid'>$pid</a> as per your payment.<br>
	<br>
	
	<b><a target='_blank' href='https://motortraderbd.com/$mfile'>DOWNLOAD MT REPORT</a></b><br>
	<br>
	
	Have a great day!<br>
	<br>
	Kind regards,<br>
	<br>
	MotorTraderBD Admin<br>
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
	
	$sentMailResult = mail($to, $subject, $msg, $headers);

	if($sentMailResult)
	{
		//echo "File Sent Successfully.";
	}
	else
	{
		die("Sorry but the email could not be sent. Please go back and try again!");
	}
}
?>
