<?php session_start();
require("session.php");

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
		require_once('../files/dbcon.php');
		
		$userFound = 0;
		$sql = "select * from `$db`.`mt_users_pass` where userid='$email';";
		$r = mysqli_query($dbcon, $sql) or die("$sql");
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH)) { $userFound = 1; }
		
		if($userFound==0)
		{
			require('../files/ts.php');
			
			$c = fnCaptcha();
			$pass = md5SeparateOddEven(md5($p1.$c));
			$userid = $email;
			$profile_pic = ""; 
			
			if($_FILES["file1"]["error"] > 0) { echo "<script>alert('WARNING!!! Image file not found.');</script>"; }
			else {
				$allowed = array('gif', 'png', 'jpg', 'jpeg', 'bmp');
				$filename = substr($_FILES['file1']['name'],-15);
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!in_array($ext, $allowed)) {
					echo "<script>alert('WARNING!!! Image file format not supported.');</script>";
				}
				else
				{
					$profile_pic = preg_replace("([^A-Za-z0-9.])", "", $filename);
					$target = "../profile_pic/".$ts."_".$profile_pic;
					move_uploaded_file($_FILES["file1"]["tmp_name"], $target) or exit();
					
					$sl = fnRowID("mt_users_propic_log");
					$sql = "insert into `$db`.`mt_users_propic_log` values ('$sl', '$userid', '$ts', '$profile_pic', '$now');";
					mysqli_query($dbcon, $sql) or die("$sql");
				}
			}
			
			$sl = fnRowID("mt_users_pass");
			$sql = "insert into `$db`.`mt_users_pass` values ('$sl', '$userid', '$name', '$email', '$mobile', '$loc', '$pass', '$c', 'Corporate', NULL, NULL, $ts, '$profile_pic', 'y', '$now');";
			mysqli_query($dbcon, $sql) or die("$sql");
			
			$sl = fnRowID("mt_users_pass_log");
			$sql = "insert into `$db`.`mt_users_pass_log` values ('$sl', '$userid', '$name', '$email', '$mobile', '$loc', '$pass', '$c', 'Corporate', NULL, NULL, $ts, '$profile_pic', 'y', '$now', 'SIGNUP');";
			mysqli_query($dbcon, $sql) or die("$sql");
			
			
			mysqli_close($dbcon);
			die("<script>alert('Corporate user added successfully.'); window.location='user_list.php';</script>");
			
			//mobile email otp send
		}
		else
		{
			mysqli_close($dbcon);
			die("<script>alert('Userid/Email already registered with MotorTrader. Please try again.'); window.location='user_corporate_add.php';</script>");
		}
	}
	else
	{
		die("<script>alert('Password do not matched. Please try again.'); window.location='user_corporate_add.php';</script>");
	}
}
?>

<html>
<head>
<?php require_once('head.php'); ?>
</head>

<body>
<?php
//$pg = $_REQUEST['pg'];
require_once('menu.php');
?>

<h2>Add Corporate User</h2>

<script>
function validFrms()
{
	return confirm('Are you sure you want to add corporate user ?');
}
</script>

<form name='frmCorp' method="post" enctype="multipart/form-data" action="" onsubmit='return validFrms()' class=cat>

Company Name : <input type="text" name="name" class=cat size=58 minlength=3 maxlength=50 value="" placeholder="Enter Company Name *" required>
<br><br>
Company Email : <input type="email" name="email" class=cat size=59 minlength=3 maxlength=50 value="" placeholder="Enter Company Email *" required>
<br><br>
Contact Mobile : <input type="text" name="mobile" class=cat size=60 minlength=11 maxlength=11 value="" placeholder="Enter Contact Mobile *" required>
<br><br>
Company Location : <select name='location'><option>Dhaka</option><option>Chittagong</option><option>Rajshahi</option><option>Khulna</option><option>Barishal</option><option>Sylhet</option><option>Rangpur</option><option>Mymensingh</option></select>
<br><br>
Password : <input type="password" name="pass1" minlength='3' maxlength=20 value="" placeholder="Enter Password *" required><br>
Re-Password : <input type="password" name="pass2" minlength='3' maxlength=20 value="" placeholder="Re-Enter Password *" required>
<br><br>
Company Logo/Image : <input type="file" name="file1" id="file1" class=cat accept=".jpg, .jpeg, .png, .gif, .bmp" required>
<br><br>
<input type='submit' name='submitRegister' value='REGISTER' class="cat2">
</form>

</body>
</html>
