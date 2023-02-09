<?php session_start();
require("session.php");

if(isset($_POST['submitApprove']) && isset($_POST['pid']) && isset($_POST['userid']))			//from post list page
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
	
	$sql = "update `$db`.`mt_sell_car` set status='y', verifyBy='$u', verifyOn='$now' where userid='$userid' and pid='$pid' and status='n';";
	mysqli_query($dbcon, $sql) or die($sql);

	//email
	if(file_get_contents("../files/location.txt")=="server")
	{
		$sql = "select name, email from `$db`.`mt_users_pass` where userid='$userid';";
		$r = mysqli_query($dbcon, $sql) or die("$sql");
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
		{
			$name = $row[0];
			$email = $row[1];
			
			require('../emails/post_approve_admin.php');
		}
	}
	
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
Are you sure you want to approve this post ?<br><?php echo $pid; ?><br><br>
<input type=submit name='submitConfirm' value='Approve Confirm'>
<input type=hidden name='pid' value='<?php echo $pid; ?>'>
<input type=hidden name='userid' value='<?php echo $userid; ?>'>
</form>
</center>

</body>

</html>
