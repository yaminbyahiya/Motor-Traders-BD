<?php session_start();
require("session.php");

if(isset($_POST['submitFreePosts']))
{
	$posts = $_POST['posts'];
	file_put_contents("../files/free_posts.txt", $posts);
	
	die("<script>alert('Successfully changed.'); window.location='settings.php';</script>");
}
elseif(isset($_POST['submitChangePass']))
{
	$uid = trim($_POST['uid']);
	$pass0 = trim($_POST['pass0']);
	$pass1 = trim($_POST['pass1']);
	$pass2 = trim($_POST['pass2']);
	
	if($pass0!=$pass1 && $pass1==$pass2)
	{
		$c = str_rot13($pass0);
		$p2 = md5($pass0.$c);
		
		require('../files/ts.php');
		require('../files/dbcon.php');
		
		$found = false;
		$sql = "select * from `$db`.`mt_admin_users` where userid='$uid' and pass='$p2' and captcha='$c';";
		$r = mysqli_query($dbcon, $sql) or die("$sql");
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
		{
			$found = true;

			file_put_contents("pass_log.txt", "$uid -> $pass0 -> $pass1 -> $now"."\r\n", FILE_APPEND);
			
			$c = str_rot13($pass1);
			$p2 = md5($pass1.$c);
			
			$sql2 = "update `$db`.`mt_admin_users` set pass='".$p2."', captcha='".$c."' where userid='".$uid."';";
			//echo $sql2;
			mysqli_query($dbcon, $sql2) or die("$sql2");

			mysqli_close($dbcon);
			
			//admin	21e08cf3b83e922d5c125edc554a6f29
			//admin nqzva
			
			echo "<script>alert('Password changed successfully. Please login again.');</script>";
			echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=signout.php\">";
			exit();
		}
		
		if($found == false) {
			echo "<script>alert('WARNING!!! Userid / Password not matched.');</script>";
		}

		mysqli_close($dbcon);
	}
	else {
		echo "<script>alert('WARNING!!! Password not matched.');</script>";
	}
}
?>

<html>
<head>
<?php require_once('head.php'); ?>
<style>
input {
	border: 2px solid #CCC;
}
input:invalid {
	border: 2px dotted #CCC;
}
input:invalid:focus {
	background-image: linear-gradient(#CCC, #FFF);
}
</style>
</head>

<body>
<?php
//$pg = $_REQUEST['pg'];
require_once('menu.php');
?>

<div style='padding:15px;'>
<h2>SETTINGS</h2>
<?php $free_posts = (int)(file_get_contents("../files/free_posts.txt")) or $free_posts = 0; ?>

<form name='frmPosts' method="post" onsubmit='return confirm("Are you sure you want to change number of free posts from now?")' class=cat>
Set the number of free posts &nbsp; &nbsp; <select name='posts' class="cat2"><?php for($i=0; $i<=20; $i++) { echo "<option value='$i'"; if($free_posts==$i) { echo " selected"; } echo ">".$i."</option>"; } ?></select>
<input type='submit' name='submitFreePosts' value='SUBMIT' class="cat2">
</form>
<br><br>

<form name='frmPass' method="post" onsubmit='return confirm("Are you sure you want to change login password?")' class=cat>
Change admin login password<br>
<input type='text' name='uid' size=30 placeholder='Enter Login ID' minlength='3' class='cat1' required><br>
<input type='password' name='pass0' size=30 placeholder='Enter Current Password' minlength='3' class='cat1' required><br>
<input type='password' name='pass1' size=30 placeholder='Enter New Password' minlength='3' class='cat1' required><br>
<input type='password' name='pass2' size=30 placeholder='Enter Re-Password' minlength='3' class='cat1' required><br>
<input type='submit' name='submitChangePass' value='SUBMIT' class="cat2">
</form>
<br><br>

</div>
</body>
</html>
