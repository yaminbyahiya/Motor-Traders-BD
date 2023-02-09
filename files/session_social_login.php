<?php session_start();
if(isset($_SESSION['userid'])) { die("<script>window.location='../profile.php?lang=En';</script>"); }

date_default_timezone_set('Asia/Dhaka');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$userFound = 0;

if((isset($_SESSION['fbUserId']) && $_SESSION['fbUserId']!="") || (isset($_SESSION['gmUserEmail']) && $_SESSION['gmUserEmail']!=""))
{
	if(isset($_POST['remember'])) { $remember = "yes"; } else { $remember = "no"; }
	
	require_once('dbcon.php');
	require_once('ts.php');
	
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
	
	if(isset($_SESSION['fbUserId']))
	{
		$fbid = $_SESSION['fbUserId'];
		$userid = $email = $_SESSION['fbUserEmail'];
		$name = $_SESSION['fbUserName'];
		$loginWith = "facebook";
	}
	else
	{
		$userid = $email = $_SESSION['gmUserEmail'];
		$name = $_SESSION['gmUserName'];
		$loginWith = "gmail";
	}
	
	$mobile = "01234567890";
	$loc = "Dhaka";
	$pass1 = $p1 = "abc123"; 		//manual password set
	$utype = "Individual";
	
	$sql = "select * from `$db`.`mt_users_pass` where userid='$email';";
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
	
	if($userFound==0)
	{
		$c = fnCaptcha();
		$pass = md5SeparateOddEven(md5($p1.$c));
		//$userid = $email;
		
		$free_posts = (int)(file_get_contents("free_posts.txt")) or $free_posts = 0;
		
		$sl = fnRowID("mt_users_pass");
		$sql = "insert into `$db`.`mt_users_pass` values ('$sl', '$userid', '$name', '$email', '$mobile', '$loc', '$pass', '$c', '$utype', $free_posts, NULL, $ts, NULL, 'y', '$now', '$loginWith', NULL, NULL, NULL, NULL);";
		mysqli_query($dbcon, $sql) or die("$sql");
		
		$sl = fnRowID("mt_users_pass_log");
		$sql = "insert into `$db`.`mt_users_pass_log` values ('$sl', '$userid', '$name', '$email', '$mobile', '$loc', '$pass', '$c', '$utype', $free_posts, NULL, $ts, NULL, 'y', '$now', 'SIGNUP [Facebook]', NULL, NULL, NULL, NULL);";
		mysqli_query($dbcon, $sql) or die("$sql");
		
		$sql = "select * from `$db`.`mt_users_pass` where userid='$email';";
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
	}
	
	//email verified ?
	$email_verify = false;
	$sql = "select * from `$db`.`mt_verify_email` where userid='$email' order by sl desc limit 0,1;";
	$r = mysqli_query($dbcon, $sql) or die("$sql");
	while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
	{
		if($row['3']=="verify") { $email_verify = true; }
	}
	
	if($status=='y') { $sts = "OK"; }
	elseif($status=='b') { $sts = "BANNED"; }
	elseif($status=='t') { $sts = "TEMP. BANNED"; }
	elseif($status=='n') { $sts = "N"; }
	
	$sl = fnRowID("mt_users_login");
	$sql = "insert into `$db`.`mt_users_login` values ('$sl', '$userid', 'OK-FB', 'login', '$now', '$sts');";
	mysqli_query($dbcon, $sql) or die("$sql");
	
	mysqli_close($dbcon);
	
	if($userFound==1)
	{
		if($status=='y')
		{
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
			die("<script>window.location='../profile.php';</script>");
		}
		elseif($status=='b')
		{
			echo "<script>alert('WARNING!!! You were permanently banned from MotorTrader website. Please contact with MotorTrader for details.'); window.location='../contact.php';</script>";
		}
		elseif($status=='t')
		{
			echo "<script>alert('WARNING!!! You were temporarily banned from MotorTrader website.'); window.location='../index.php';</script>";
		}
		elseif($status=='n')
		{
			echo "<script>alert('ALERT!!! You were not verified yet by MotorTrader Admin.'); window.location='../contact.php';</script>";
		}
	}
	else {
		die("<script>alert('Login information is invalid. Please try with correct one.'); window.location='../login.php';</script>");
	}
}
else
{
	die("<script>window.location = '../logout.php';</script>");
}
?>
