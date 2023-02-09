<?php session_start();
require('files/session.php');

if($u!="" && $session==true)
{
	require_once('files/dbcon.php');
	require_once('files/ts.php');
	
	$sl = fnRowID("mt_users_login");
	$sql = "insert into `$db`.`mt_users_login` values ('$sl', '$u', '-', 'logout', '$now', 'OK');";
	mysqli_query($dbcon, $sql) or die("$sql");
	
	$u = ""; 		unset($_SESSION['userid']);
	$un = ""; 		unset($_SESSION['username']);
	$ue = ""; 		unset($_SESSION['email']);
	$um = ""; 		unset($_SESSION['mobile']);
	//$comp1 = "";	unset($_SESSION['comp1']);
	//$comp2 = "";	unset($_SESSION['comp2']);
	
	$_COOKIE['userid'] = "";		unset($_COOKIE['userid']);		setcookie('userid', null, $ts-3600, '/'); 
	$_COOKIE['usertype'] = "";		unset($_COOKIE['usertype']);	setcookie('usertype', null, $ts-3600, '/'); 
	$_COOKIE['username'] = "";		unset($_COOKIE['username']);	setcookie('username', null, $ts-3600, '/'); 
	$_COOKIE['email'] = "";			unset($_COOKIE['email']);		setcookie('email', null, $ts-3600, '/'); 
	$_COOKIE['mobile'] = "";		unset($_COOKIE['mobile']);		setcookie('mobile', null, $ts-3600, '/'); 
	$_COOKIE['propic'] = "";		unset($_COOKIE['propic']);		setcookie('propic', null, $ts-3600, '/'); 
	$_COOKIE['prots'] = "";			unset($_COOKIE['prots']);		setcookie('prots', null, $ts-3600, '/');
	$_COOKIE['email_verify'] = "";			unset($_COOKIE['email_verify']);		setcookie('email_verify', null, $ts-3600, '/');
	
	$session = false;
	mysqli_close($dbcon);
}

//fb login
if(isset($_SESSION['fbUserId']) and $_SESSION['fbUserId']!="")
{
	//include_once('rashik/fb-config.php');
	//session_destroy();
	unset($_SESSION['fbUserName']);
	unset($_SESSION['fbUserEmail']);
	unset($_SESSION['fbAccessToken']);
}
unset($_SESSION['fbUserId']);

if(isset($_SESSION['gmUserEmail']) and $_SESSION['gmUserEmail']!="")
{
	unset($_SESSION['gmUserEmail']);
	unset($_SESSION['gmUserName']);
	unset($_SESSION['gmAccessToken']);
}

die("<script>window.location='index-bn.php';</script>");
?>
