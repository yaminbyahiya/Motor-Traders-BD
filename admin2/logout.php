<?php session_start();
require_once('files/common_top.php');

if(isset($_SESSION['mta-user']) && isset($_SESSION['mta-pass']) && isset($_SESSION['mta-ts']))
{
	require_once('files/ts.php');
	require_once('../files/dbcon.php');
	
	$u = $_SESSION['mta-user'];
	
	$sql = "insert into `$db`.`mt_users_login` values (null, '$u', '-', 'logout', '$now', 'OK');";
	mysqli_query($dbcon, $sql) or die("$sql");

	mysqli_close($dbcon);
	
	$_SESSION['mta-user'] = "";			unset($_SESSION['mta-user']);
	$_SESSION['mta-pass'] = "";			unset($_SESSION['mta-pass']);
	$_SESSION['mta-ts'] = "";			unset($_SESSION['mta-ts']);
}
else
{
	
}

die("<script>window.location='index.php';</script>");
?>
