<?php
if(isset($_REQUEST['eml']) && isset($_REQUEST['uid']) && isset($_REQUEST['name']) && isset($_REQUEST['pid']))
{
	$email = "admin@motortraderbd.com";
	$uid = $_REQUEST['uid'];
	$ueml = $_REQUEST['eml'];
	$name = $_REQUEST['name'];
	$pid = $_REQUEST['pid'];
	
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
		$subject = "Request for MT Report from $uid ($pid)";
		$msg = "
		Hello,<br>
		<br>
		This request was came from user <b>$name</b> ($ueml)<br>for the MT Report of this <a target='_blank' href='https://motortraderbd.com/vehicle_details.php?pid=$pid'>POST # $pid</a>.<br>
		<br>
		Please take the proper action on this regards.<br>
		<br>
		MotorTraderBD Admin<br>
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

		mail($to, $subject, $msg, $headers);
	}
}
?>
