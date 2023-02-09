<?php session_start();
require("session.php");

if(isset($_POST['submitVerify']) && isset($_POST['uid']) && isset($_POST['uts']))
{
	$uid = $_POST['uid'];
	$uts = $_POST['uts'];
}
elseif(isset($_POST['submitConfirm']) && isset($_POST['uid']) && isset($_POST['uts']))
{
	$uid = $_POST['uid'];
	$uts = $_POST['uts'];
	
	require('../files/ts.php');
	require('../files/dbcon.php');
	
	$sql = "update `$db`.`mt_users_nid` set status='y', verifyBy='$u', verifyOn='$now' where userid='$uid';";
	mysqli_query($dbcon, $sql) or die($sql);

	mysqli_close($dbcon);
	
	die("<script>window.location='user_verify.php';</script>");
}
else { die("<script>window.location='user_verify.php';</script>"); }
?>

<html>
<head>
<?php require_once('head.php'); ?>
</head>

<body>
<br>

<center>
<form name='frmVerify' method=post action='' style=''>
Are you sure you want to verify this user ?<br><?php echo $uid; ?><br><br>
<input type=submit name='submitConfirm' value='Verify Confirm'>
<input type=hidden name=uid value='<?php echo $uid; ?>'>
<input type=hidden name=uts value='<?php echo $uts; ?>'>
</form>
</center>

</body>

</html>
