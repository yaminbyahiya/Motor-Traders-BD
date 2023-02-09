<?php
date_default_timezone_set('Asia/Dhaka');

if(isset($_REQUEST['data']) && isset($_REQUEST['code']))
{
	$data = $_REQUEST['data'];
	$code = $_REQUEST['code'];
	
	$str = str_rot13(base64_decode($data));

	if($code==md5(str_rot13($str)))
	{
		$txt = explode(",", $str);
		$userid = $txt[0];
		$ts = $txt[1];
		$email = $txt[2];
		
		require('files/ts.php');
		require('files/dbcon.php');
		
		$sl = fnRowID("mt_verify_email");
		$sql = "replace into `$db`.`mt_verify_email` values ('$sl', '$userid', '$email', 'didnot', '$now');";
		mysqli_query($dbcon, $sql) or die("$sql");
		
		$sql = "delete from `$db`.`mt_users_pass` where userid='$userid' and email='$email';";
		mysqli_query($dbcon, $sql) or die("$sql");
		
		mysqli_close($dbcon);
		
		die("<script>alert('Your account has been disabled.'); window.location='index.php';</script>");
	}
	else
	{
		echo "INVALID LINK";
	}
}
else
{
	echo "INVALID LINK";
}
?>
