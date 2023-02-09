<?php session_start();
require('files/session.php');
if($u!="" && $session==true) { die("<script>window.location='index.php';</script>"); }

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

if(isset($_POST['submitRegister']) && isset($_POST['email']))
{
	$name = $_POST['name'];				$name = preg_replace("([^A-Za-z. -])", "", $name);
	$email = $_POST['email'];			$email = preg_replace("([^a-z0-9@.-_])", "", strtolower($email));
	$mobile = $_POST['mobile'];			$mobile = preg_replace("([^0-9])", "", $mobile);
	$loc = $_POST['location'];			$loc = preg_replace("([^A-Za-z])", "", $loc);
	$p1 = $_POST['pass1'];				$p1 = preg_replace("([^A-Za-z0-9. -/#&(_):;,])", "", $p1);
	$p2 = $_POST['pass2'];				$p2 = preg_replace("([^A-Za-z0-9. -/#&(_):;,])", "", $p2);
	
	if($p1==$p2)
	{
		$userFound = 0;
		
		require_once('files/dbcon.php');
		
		$sql = "select * from `$db`.`mt_users_pass` where userid='$email';";
		$r = mysqli_query($dbcon, $sql) or die("$sql");
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
		{
			$userFound = 1;
		}
		
		if($userFound==0)
		{
			require('files/ts.php');
			
			$c = fnCaptcha();
			$pass = md5SeparateOddEven(md5($p1.$c));
			$userid = $email;
			
			$free_posts = (int)(file_get_contents("files/free_posts.txt")) or $free_posts = 0;
			
			$sl = fnRowID("mt_users_pass");
			$sql = "insert into `$db`.`mt_users_pass` values ('$sl', '$userid', '$name', '$email', '$mobile', '$loc', '$pass', '$c', 'Individual', $free_posts, NULL, $ts, NULL, 'y', '$now', NULL, NULL, NULL, NULL, NULL);";
			mysqli_query($dbcon, $sql) or die("$sql");
			
			$sl = fnRowID("mt_users_pass_log");
			$sql = "insert into `$db`.`mt_users_pass_log` values ('$sl', '$userid', '$name', '$email', '$mobile', '$loc', '$pass', '$c', 'Individual', $free_posts, NULL, $ts, NULL, 'y', '$now', 'SIGNUP', NULL, NULL, NULL, NULL);";
			mysqli_query($dbcon, $sql) or die("$sql");
			
			mysqli_close($dbcon);
			
			//email
			if(file_get_contents("files/location.txt")=="server")
			{
				$str = str_rot13("$userid,$ts,$email");
				$data = base64_encode($str);
				$code = md5($str);
				
				require('emails/register_submit.php');
			}
			
			//mobile otp send
			
			die("<script>alert('Thanks for registration at MotorTrader. Please login now.'); window.location='login.php';</script>");
			
			//$step = 2;
		}
		else
		{
			mysqli_close($dbcon);
			die("<script>alert('Userid/Email already registered with MotorTrader. Please try again.'); window.location='account.php';</script>");
		}
	}
	else
	{
		die("<script>alert('Password not matched. Please try again.'); window.location='account.php';</script>");
	}
}
else
{
	die("<script>window.location='account.php';</script>");
}
?>
