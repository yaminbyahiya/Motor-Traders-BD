<?php
if($ue!="" && $un!="")
{
	$email = $ue;
	
	$content = file_get_contents($mtrpt);
	$encoded_content = chunk_split(base64_encode($content));
	
	$separator = "--".md5(time());
	
	$headers = "MIME-Version: 1.0"."\r\n";
	//$headers.= "Content-type:text/html;charset=UTF-8"."\r\n";
	$headers.= "Content-Type: multipart/mixed; boundary=\"".$separator."\""."\r\n";
    $headers.= "Content-Transfer-Encoding: 7bit"."\r\n";
    $headers.= "This is a MIME encoded message."."\r\n";
	$headers.= "From: MotorTraderBD <info@motortraderbd.com>"."\r\n";
	$headers.= "Reply-To: care@bondstein.com"."\r\n";
	//$headers.= "Cc: "."\r\n";
	$headers.= "Bcc: archives@motortraderbd.com"."\r\n";
	//$headers.= "X-Mailer: PHP/".phpversion();
	
	$to = "$email";
	$subject = "Download MT Report ($pid)";
	$msg = "
	Hello ADMIN,<br>
	<br>
	This request was came from user <b>$un</b> ($ue)<br>for the MT Report of this <a target='_blank' href='https://motortraderbd.com/vehicle_details.php?pid=$pid'>POST # $pid</a>.<br>
	<br>
	Please take the proper action on this regards.<br>
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
	
	//message
    $body = $separator."\r\n";
    $body.= "Content-Type: text/html; charset=\"iso-8859-1\""."\r\n";
    $body.= "Content-Transfer-Encoding: 8bit"."\r\n";
    $body.= $msg."\r\n";

    //attachment
    $body.= $separator."\r\n";
    $body.= "Content-Type: application/octet-stream; name=\"".$mtrpt."\"" ."\r\n";
    $body.= "Content-Transfer-Encoding: base64" ."\r\n";
    $body.= "Content-Disposition: attachment"."\r\n";
    $body.= $encoded_content."\r\n";
    $body.= $separator."--";

	//SEND Mail
    if(mail($to, $subject, $body, $headers)) {
        echo "mail send ... OK"; // or use booleans here
    } else {
        echo "mail send ... ERROR!";
        print_r( error_get_last() );
    }
}
?>
