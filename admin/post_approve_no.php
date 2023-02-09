<?php session_start();
require("session.php");

if(isset($_POST['submitDeny']) && isset($_POST['pid']) && isset($_POST['userid']))			//from post list page
{
	$pid = $_POST['pid'];
	$userid = $_POST['userid'];
}
elseif(isset($_POST['submitConfirm']) && isset($_POST['pid']) && isset($_POST['userid']))		//from this page
{
	$pid = $_POST['pid'];
	$userid = $_POST['userid'];
	
	require('../files/ts.php');
	require('../files/dbcon.php');
	
	$sql = "update `$db`.`mt_sell_car` set status='d', verifyBy='$u', verifyOn='$now' where userid='$userid' and pid='$pid' and status='n';";
	mysqli_query($dbcon, $sql) or die($sql);

	//email
	
	mysqli_close($dbcon);
	
	die("<script>window.location='post_approve.php';</script>");
}
else { die("<script>window.location='post_approve.php';</script>"); }
?>

<html>
<head>
<?php require_once('head.php'); ?>
</head>

<body>
<br>

<center>
<form name='frmVerify' method='post' action='' style=''>
Are you sure you want to disapprove/deny this post ?<br><?php echo $pid; ?><br><br>
<input type=submit name='submitConfirm' value='DENY THIS POST'>
<input type=hidden name='pid' value='<?php echo $pid; ?>'>
<input type=hidden name='userid' value='<?php echo $userid; ?>'>
</form>
</center>

</body>

</html>
