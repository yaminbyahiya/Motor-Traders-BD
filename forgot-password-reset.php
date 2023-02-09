<?php session_start();
require('files/session.php');
if($u!="" && $session==true) { die("<script>window.location='index.php?lang=En';</script>"); }

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

if(isset($_POST['submitReset']) && isset($_POST['email']) && isset($_POST['pass1']) && isset($_POST['pass2']) && isset($_POST['location']))
{
	$email = $_POST['email'];			$email = preg_replace("([^a-z0-9@.-_])", "", strtolower($email));
	$loc = $_POST['location'];			$loc = preg_replace("([^A-Za-z])", "", $loc);
	$p1 = $_POST['pass1'];				$p1 = preg_replace("([^A-Za-z0-9. -/#&(_):;,])", "", $p1);
	$p2 = $_POST['pass2'];				$p2 = preg_replace("([^A-Za-z0-9. -/#&(_):;,])", "", $p2);
	
	$serial = $_POST['serial'];
	$serialtok = $_POST['serialtok'];
	
	if($p1==$p2 && $serialtok==md5($serial*2))
	{
		require_once('files/dbcon.php');
		require('files/ts.php');
		
		$c = fnCaptcha();
		$pass = md5SeparateOddEven(md5($p1.$c));
		$userid = $email;
		
		$sql = "update `$db`.`mt_users_pass` set location='$loc', pass='$pass', captcha='$c', loginWith=null where userid='$email' and status='y';";
		mysqli_query($dbcon, $sql) or die("$sql");
		
		$sl = fnRowID("mt_users_pass_log");
		$sql = "insert into `$db`.`mt_users_pass_log` values ('$sl', '$userid', '', '$email', '', '$loc', '$pass', '$c', 'Individual', null, NULL, $ts, NULL, 'y', '$now', 'PASS RESET', NULL, NULL, NULL, NULL);";
		mysqli_query($dbcon, $sql) or die("$sql");
		
		$sql = "update `$db`.`mt_forgot_pass` set status='n', resetOn='$now' where userid='$email' and status='y' and sl='$serial';";
		mysqli_query($dbcon, $sql) or die("$sql");
		$sql = "update `$db`.`mt_forgot_pass` set status='x', resetOn='$now' where userid='$email' and status='y';";
		mysqli_query($dbcon, $sql) or die("$sql");

		mysqli_close($dbcon);
		
		die("<script>alert('Your password was reset successfully. Please login now.'); window.location='login.php';</script>");
	}
	else
	{
		die("<script>alert('Password or Token not matched. Please try again.'); window.location='index.php';</script>");
	}
}
elseif(isset($_REQUEST['token']) && isset($_REQUEST['userid']) && isset($_REQUEST['session']))
{
	$userid = strtolower($_REQUEST['userid']);		$userid = preg_replace("([^a-z0-9@.-_])", "", $userid);
	$code = $_REQUEST['token'];
	$session = $_REQUEST['session'];
	
	require_once('files/dbcon.php');
	require_once('files/ts.php');
	
	$found = false; $serial = 0;
	$sql = "select * from `$db`.`mt_forgot_pass` where userid='$userid' and code='$code' and token='$session' and status='y';";
	$r = mysqli_query($dbcon, $sql) or die("$sql");
	while($row = mysqli_fetch_array($r, MYSQLI_BOTH)) { $found = true; $serial = $row[0]; }
	
	if($found==false)
	{
		mysqli_close($dbcon);
		die("<script>alert('Invalid token. Please try again.'); window.location='index.php';</script>");
	}
}
else
{
	die("<script>alert('Invalid token. Please try again.'); window.location='index.php';</script>");
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
 	
    <?php $menu='account'; require('files/header.php'); ?>
    
    <!--Register Section-->
    <section class="register-section" style="padding-top:40px;">
        <div class="auto-container">
            <div class="row clearfix">
                
                <!--Form Column-->
                <div class="form-column column col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
                    <div class="form-title">
                        <h2>Reset &nbsp;Password</h2>
                    </div>
                    
                    <!--Login Form-->
                    <div class="styled-form login-form">
                        <form name='frmLogin' method="post" action="forgot-password-reset.php">
                            
							<div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                                <input type="email" name="email" minlength='3' maxlength=50 value="" placeholder="Email Address *" required>
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-map"></span></span>
                                <select name='location'><option>Dhaka</option><option>Chittagong</option><option>Rajshahi</option><option>Khulna</option><option>Barishal</option><option>Sylhet</option><option>Rangpur</option><option>Mymensingh</option></select>
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="pass1" minlength='8' maxlength=20 value="" placeholder="Enter Password *" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            </div>
							<div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="pass2" minlength='8' maxlength=20 value="" placeholder="Re-Enter Password *" required>
                            </div>
							<div class="clearfix">
                                <div class="form-group pull-left">
									<input type='hidden' name='serial' value='<?php echo $serial; ?>'>
									<input type='hidden' name='serialtok' value='<?php echo md5($serial*2); ?>'>
									<input type='submit' name='submitReset' value='RESET PASSWORD' class="theme-btn btn-style-one">
                                </div>
                            </div>
							
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
    <!--End Register Section-->
    
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
