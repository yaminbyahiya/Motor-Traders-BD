<?php session_start();
require('files/session.php');
if($u!="" && $session==true) { die("<script>window.location='index.php?lang=En';</script>"); }

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

if(isset($_POST['submitLogin']) && isset($_POST['email']) && isset($_POST['pass']))
{
	$email = $_POST['email'];			$email = preg_replace("([^a-z0-9@.-_])", "", strtolower($email));
	$pass1 = $_POST['pass'];			$pass1 = preg_replace("([^A-Za-z0-9. -/#&(_):;,])", "", $pass1);
	if(isset($_POST['remember'])) { $remember = "yes"; } else { $remember = "no"; }
	$userid = $email;
	$userFound = 0;
	
	require_once('files/dbcon.php');
	require_once('files/ts.php');
	
	$sql = "select * from `$db`.`mt_users_pass` where userid='$email';"; 		//and status='y'
	$r = mysqli_query($dbcon, $sql) or die("$sql");
	while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
	{
		$userFound = 1;
		$name = $row['name'];
		$mobile = $row['mobile'];
		$pass2 = $row['pass'];
		$captcha = $row['captcha'];
		$utype = $row['utype'];
		$vdealer = $row['vdealer'];
		$prots = $row['ts'];
		$proPic = $row['profilePic'];
		$status = $row['status'];
	}
	
	if($userFound==1)
	{
		//email verified ?
		$email_verify = false;
		$sql = "select * from `$db`.`mt_verify_email` where userid='$email' order by sl desc limit 0,1;";
		$r = mysqli_query($dbcon, $sql) or die("$sql");
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
		{
			if($row['3']=="verify") { $email_verify = true; }
		}
		
		$pass = md5SeparateOddEven(md5($pass1.$captcha));
		
		if($pass==$pass2)
		{
			if($status=='y') { $sts = "OK"; }
			elseif($status=='b') { $sts = "BANNED"; }
			elseif($status=='t') { $sts = "TEMP. BANNED"; }
			elseif($status=='n') { $sts = "N"; }
			
			$sl = fnRowID("mt_users_login");
			$sql = "insert into `$db`.`mt_users_login` values ('$sl', '$userid', 'OK', 'login', '$now', '$sts');";
			mysqli_query($dbcon, $sql) or die("$sql");
		}
		else
		{
			$userFound = 0;
			$sl = fnRowID("mt_users_login");
			$sql = "insert into `$db`.`mt_users_login` values ('$sl', '$userid', '".$_POST['pass']."', 'login', '$now', 'wrong pwd');";
			mysqli_query($dbcon, $sql) or die("$sql");
		}
		
		mysqli_close($dbcon);
		
		if($userFound==1)
		{
			if($status=='y')
			{
				$_SESSION['fbUserId'] = "";
				$_SESSION['userid'] = $userid;
				$_SESSION['usertype'] = $utype;
				$_SESSION['username'] = $name;
				$_SESSION['email'] = $email;
				$_SESSION['mobile'] = $mobile;
				$_SESSION['vdealer'] = $vdealer;
				$_SESSION['propic'] = $proPic;
				$_SESSION['prots'] = $prots;
				$_SESSION['email_verify'] = $email_verify;
				
				//remember me
				if($remember=='yes') {
					$_COOKIE['userid'] = $userid;
					$_COOKIE['usertype'] = $utype;
					$_COOKIE['username'] = $name;
					$_COOKIE['email'] = $email;
					$_COOKIE['mobile'] = $mobile;
					$_COOKIE['vdealer'] = $vdealer;
					$_COOKIE['propic'] = $proPic;
					$_COOKIE['prots'] = $prots;
					$_COOKIE['email_verify'] = $email_verify;
				}
				
				//echo "<script>alert('Thanks for login. $remember');</script>";
				die("<script>window.location='profile.php';</script>");
			}
			elseif($status=='b')
			{
				echo "<script>alert('WARNING!!! You were permanently banned from MotorTrader website. Please contact with MotorTrader for details.'); window.location='login.php';</script>";
			}
			elseif($status=='t')
			{
				echo "<script>alert('WARNING!!! You were temporarily banned from MotorTrader website.'); window.location='login.php';</script>";
			}
			elseif($status=='n')
			{
				echo "<script>alert('ALERT!!! You were not verified yet by MotorTrader Admin.'); window.location='login.php';</script>";
			}
		}
		else {
			die("<script>alert('Login password is invalid. Please try with correct one.'); window.location='login.php';</script>");
		}
	}
	else
	{
		$sl = fnRowID("mt_users_login");
		$sql = "insert into `$db`.`mt_users_login` values ('$sl', '$userid', '".$_POST['pass']."', 'login', '$now', 'wrong uid');";
		mysqli_query($dbcon, $sql) or die("$sql");
		
		mysqli_close($dbcon);
		die("<script>alert('Userid/Email did not register with MotorTrader. Please try again.'); window.location='login.php';</script>");
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
                        <h2>Login &nbsp;Now</h2>
                    </div>
                    
                    <!--Login Form-->
                    <div class="styled-form login-form">
                        <form name='frmLogin' method="post" action="login.php">
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                                <input type="email" name="email" minlength='3' maxlength=50 value="" placeholder="Email Address *" required>
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="pass" minlength='3' maxlength=20 value="" placeholder="Enter Password *"  required>
								<!-- pattern -->
                            </div>
                            <div class="clearfix">
                                <div class="form-group pull-left">
									<input type='submit' name='submitLogin' value='LOGIN' class="theme-btn btn-style-one">
                                </div>
                                <!--
								<div class="form-group social-links-two pull-right">
                                    Or login with <a href="#" class="img-circle facebook"><span class="fa fa-facebook-f"></span></a> <a href="#" class="img-circle twitter"><span class="fa fa-twitter"></span></a> <a href="#" class="img-circle google-plus"><span class="fa fa-google-plus"></span></a>
                                </div>
								-->
								<div class="form-group submit-text pull-left">
                                	&nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" id="remember-me" name="remember" style='cursor:pointer;' value='yes'><label class="remember-me" for="remember-me">&nbsp; Remember Me</label>
                                </div>
                            </div>
							
							<a href='forgot-password.php' class='theme-btn btn-style-three' style='color:#000;'>FORGOT PASSWORD ?</a>
							
                        </form>
                    </div>
                </div>
				
				<div class="form-column column col-lg-1 col-md-1">
				</div>
				
				<div class="form-column column col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="form-title">
                        <h2>Login &nbsp;With</h2>
                    </div>
                    
                    <!--Login Form-->
                    <div class="styled-form login-form">
                        <form name='frmLogin' method="post" action="login.php">
                            <div class="form-group">
                                <a href='rashik/facebook.php'><img src='images/login_facebook.png' width=200 title='' alt='Login with Facebook'></a>
                            </div>
                            <div class="form-group">
                                <a href='rashik/gmail-callback.php'><img src='images/login_gmail.png' width=200 title='' alt='Login with Gmail'></a>
                            </div>
							<div class="form-group">
                                <a href='rashik/apple-login.php'><img src='images/login_apple.png' width=200 title='' alt='Login with Apple ID'></a>
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
