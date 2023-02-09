<?php session_start();
require('files/session.php');

if(isset($_REQUEST['uid']) && isset($_REQUEST['txntype']))
{
	$u = str_rot13($_REQUEST['uid']);
	$txntype = $_REQUEST['txntype'];
	$userFound = 0;
	
	if($u=="" || $u=="x")
	{
		require_once('files/dbcon.php');
		require_once('files/ts.php');
		
		$sql = "select * from `$db`.`mt_users_pass` where userid='$u' and status='y';";
		$r = mysqli_query($dbcon, $sql) or die("$sql");
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
		{
			$userFound = 1;
			$name = $row['name'];
			$email = $row['email'];
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
			$sql = "select * from `$db`.`mt_verify_email` where userid='$u' order by sl desc limit 0,1;";
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
			$sql = "insert into `$db`.`mt_users_login` values ('$sl', '$u', 'OK', 'login', '$now', '$sts');";
			mysqli_query($dbcon, $sql) or die("$sql");
			
			mysqli_close($dbcon);
			
			$_SESSION['userid'] = $u;
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
				$_COOKIE['userid'] = $u;
				$_COOKIE['usertype'] = $utype;
				$_COOKIE['username'] = $name;
				$_COOKIE['email'] = $email;
				$_COOKIE['mobile'] = $mobile;
				$_COOKIE['vdealer'] = $vdealer;
				$_COOKIE['propic'] = $proPic;
				$_COOKIE['prots'] = $prots;
				$_COOKIE['email_verify'] = $email_verify;
			}
			
			if($txntype=="boost") { die("<script>window.location='profile.php?lang=En';</script>"); }
			elseif($txntype=="token") { die("<script>window.location='profile.php?lang=En';</script>"); }
			elseif($txntype=="mtrpt") { die("<script>window.location='buy-car.php?lang=En';</script>"); }
			else { die("<script>window.location='index.php?lang=En';</script>"); }
		}
		else
		{
			$sl = fnRowID("mt_users_login");
			$sql = "insert into `$db`.`mt_users_login` values ('$sl', '$userid', '".$_POST['pass']."', 'login', '$now', 'wrong uid ssl');";
			mysqli_query($dbcon, $sql) or die("$sql");
			
			mysqli_close($dbcon);
			die("<script>alert('Userid/Email did not register with MotorTrader. Please try again.'); window.location='login.php';</script>");
		}
	}
	else
	{
		if($txntype=="boost") { die("<script>window.location='profile.php?lang=En';</script>"); }
		elseif($txntype=="token") { die("<script>window.location='profile.php?lang=En';</script>"); }
		elseif($txntype=="mtrpt") { die("<script>window.location='buy-car.php?lang=En';</script>"); }
		else { die("<script>window.location='index.php?lang=En';</script>"); }
	}
}
else { die("<script>window.location='index.php?lang=En';</script>"); }
?>