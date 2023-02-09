<?php session_start();
require("session.php");

if(isset($_POST['submitDeny']) && isset($_POST['nid']) && isset($_POST['userid']))
{
	$nid = $_POST['nid'];
	$userid = $_POST['userid'];
}
elseif(isset($_POST['submitConfirm']) && isset($_POST['nid']) && isset($_POST['userid']))
{
	$nid = $_POST['nid'];
	$userid = $_POST['userid'];
	
	require('../files/ts.php');
	require('../files/dbcon.php');
	
	$sql = "update `$db`.`mt_news` set status='d', verifyBy='$u', verifyOn='$now' where userid='$userid' and nid='$nid' and status='n';";
	mysqli_query($dbcon, $sql) or die($sql);

	mysqli_close($dbcon);
	
	die("<script>window.location='news_approve.php';</script>");
}
else { die("<script>window.location='news_approve.php';</script>"); }
?>

<html>
<head>
<?php require_once('head.php'); ?>
</head>

<body>
<br>

<center>
<form name='frmVerify' method=post action='' style=''>
Are you sure you want to disapprove/deny this news/article ?<br><?php echo $nid; ?><br><br>
<input type=submit name='submitConfirm' value='DENY NEWS'>
<input type=hidden name=nid value='<?php echo $nid; ?>'>
<input type=hidden name=userid value='<?php echo $userid; ?>'>
</form>
</center>

</body>

</html>
