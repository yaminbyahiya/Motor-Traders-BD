<?php session_start();
require('files/session.php');
if($u!="" && $session==true) { die("<script>window.location='login.php';</script>"); }

function md5SeparateOddEven($txt) {
	$result = "";
	for($i=0; $i<strlen($txt); $i=$i+2)
	{
		$result.= $txt[$i];
	}
	for($i=1; $i<strlen($txt); $i=$i+2)
	{
		$result.= $txt[$i];
	}
	return $result;
}
function fnCaptcha() {
	$set[0] = "ABCDEFGHIJKLMONPQRSTUVWXYZ";
	$set[1] = "abcdefghijklmnopqrstuvwxyz";
	$set[2] = "0123456789";
	
	$rand0 = rand(0,2);
	if($rand0==0) { $rand1 = rand(1,2); if($rand1==1) { $rand2 = 2; } else { $rand2 = 1; } }
	elseif($rand0==1) { $rand1 = rand(2,3); if($rand1==2) { $rand2 = 0; } else { $rand1 = 0; $rand2 = 2; } }
	elseif($rand0==2) { $rand1 = rand(0,1); if($rand1==1) { $rand2 = 0; } else { $rand2 = 1; } }

	$captcha = $set[$rand0][rand(0, strlen($set[$rand0])-1)].$set[$rand1][rand(0, strlen($set[$rand1])-1)].$set[$rand2][rand(0, strlen($set[$rand2])-1)].$set[$rand0][rand(0, strlen($set[$rand0])-1)].$set[$rand1][rand(0, strlen($set[$rand1])-1)].$set[$rand2][rand(0, strlen($set[$rand2])-1)];
	
	return $captcha;
}

if(isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['location']))
{
	$userid = strtolower($_POST['email']);		$userid = preg_replace("([^a-z0-9@.-_])", "", $userid);
	$location = $_POST['location'];				$location = preg_replace("([^A-Za-z])", "", $location);
	
	require_once('files/dbcon.php');
	require_once('files/ts.php');
	
	$found = false;
	
	$sql = "select * from `$db`.`mt_users_pass` where userid='$userid' and location='$location' and status='y';";
	$r = mysqli_query($dbcon, $sql) or die("$sql");
	while($row = mysqli_fetch_array($r, MYSQLI_BOTH)) { $found = true; }
	
	if($found==true)
	{
		//already email sent within last 15 min ?
		$sql = "select * from `$db`.`mt_forgot_pass` where userid='$userid' and status='y' order by createdOn desc limit 0,1;";
		$r = mysqli_query($dbcon, $sql) or die("$sql");
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
		{ 
			$sentOn = $row['createdOn'];
			if($ts - strtotime($sentOn) < 900) {
				mysqli_close($dbcon);
				die("<script>alert('An email was already sent to your email id. Please check your inbox/spambox.'); window.location='index.php';</script>");
			}
		}
	
		$c = fnCaptcha().fnCaptcha();
		$c2 = md5SeparateOddEven(md5($c.$ts));
		
		$sl = fnRowID("mt_forgot_pass");
		$sql = "insert into `$db`.`mt_forgot_pass` values ('$sl', '$userid', '$c', '$c2', 'y', '$now', NULL);";
		mysqli_query($dbcon, $sql) or die("$sql");
		
		mysqli_close($dbcon);
		
		//email
		$headers = "MIME-Version: 1.0"."\r\n";
		$headers.= "Content-type:text/html;charset=UTF-8"."\r\n";
		$headers.= "From: MotorTraderBD <info@motortraderbd.com>"."\r\n";
		//$headers.= "Cc: x@gmail.com"."\r\n";
		//$headers.= "Bcc: x@gmail.com"."\r\n";
		$headers.= "Reply-To: info@motortraderbd.com"."\r\n";
		$headers.= "X-Mailer: PHP/".phpversion();
		$to = "$userid";
		$subject = "Reset your password";
		$msg = "Dear Valued Client,<br>
		<br>
		Here is your password reset link for MotorTraderBD panel.<br><br>
		<a href='http://motortraderbd.com/forgot-password-reset.php?token=".$c."&userid=".$userid."&session=".$c2."' target='_blank'><b>Reset your password</b></a><br><br>
		We would like to take this opportunity to thank you for choosing our service.<br>
		<br>
		<br>
		Sincerely,<br>
		<br>
		<b>Help Desk | MotorTraderBD</b><br>
		<br>
		<br>
		<i>This is a system generated mail. Please do not reply to this message. Replies to this message are routed to an unmonitored mailbox.</i><br>
		<br>
		<br>
		<font size=1>DISCLAIMER: This email (including any attachments) is intended only for use by the named addressee(s) and may contain private, confidential and/or privileged material. Any reliance, dissemination, distribution, review, copy or other use of this email by person(s) who are not the intended recipient is prohibited. If you have received this email in error, please notify the sender immediately by email and permanently delete the email and any copies (including print-outs). E-mail transmission cannot be guaranteed to be secure or error-free as information could be intercepted, corrupted, lost, destroyed, arrive late or incomplete, or contain viruses. The sender therefore does not accept liability for any errors or omissions in the contents of this message, which arise as a result of e-mail transmission.</font><br>
		<br>
		powered by <a href='http://motortraderbd.com/' target=_blank>motortraderbd.com</a>
		";
		mail($to, $subject, $msg, $headers) or die("Email not send.");
		//email
		
		die("<script>alert('An email was sent to your email id for reset password. Please check your inbox/spambox.'); window.location='login.php';</script>");
	}
	else
	{
		$sl = fnRowID("mt_forgot_pass");
		$sql = "insert into `$db`.`mt_forgot_pass` values ('$sl', '$userid', 'x', NULL, 'x', '$now', NULL);";
		mysqli_query($dbcon, $sql) or die("$sql");
		
		mysqli_close($dbcon);
		die("<script>alert('Userid/Email did not register with MotorTrader. Please try again.'); window.location='forgot-password.php';</script>");
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<?php require('files/head.php'); ?>
</head>

<body>
<div class="page-wrapper">
 	
    <!-- Preloader -->
    <div class="preloader"></div>
 	
    <?php $menu='login'; require('files/header.php'); ?>
    
    <!--Register Section-->
    <section class="register-section">
        <div class="auto-container">
            <div class="row clearfix">
                
                <!--Form Column-->
                <div class="form-column column col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="form-title">
                        <h2>Forgot Password</h2>
                    </div>
                    
                    <!--Login Form-->
                    <div class="styled-form login-form">
                        <form name='frmLogin' method="post" action="" onsubmit="return confirm('Are you sure you want to reset your password ?');">
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                                <input type="email" name="email" minlength='3' maxlength=50 value="" placeholder="Email Address *" required>
                            </div>
                            <div class="form-group">
                                <select name='location' required><option value="" disabled selected>Select Your Location</option><option>Dhaka</option><option>Chittagong</option><option>Rajshahi</option><option>Khulna</option><option>Barishal</option><option>Sylhet</option><option>Rangpur</option><option>Mymensingh</option></select>
                            </div>
                            <div class="clearfix">
                                <div class="form-group pull-left">
									<input type='submit' name='submit' value='SUBMIT' class="theme-btn btn-style-one">
                                </div>
								<div class="form-group pull-right">
                                	<a href='login.php' class='theme-btn btn-style-three' style='color:#000;'>&larr; LOGIN</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Register Section-->
    
    <?php require('files/footer.php'); ?>
    
</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-up"></span></div>

<script src="js/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>
<script src="js/owl.js"></script>
<script src="js/appear.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/wow.js"></script>
<script src="js/script.js"></script>

</body>
</html>
