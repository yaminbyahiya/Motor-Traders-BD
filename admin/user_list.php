<?php session_start();
require("session.php");
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

<div style='padding:15px;'>
<h2>User List</h2>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>SL</td><td>User ID / Email</td><td>Type</td><td>Name</td><td>Mobile</td><td>Location</td><td>Register On</td><td>NID</td><td>Status</td><td>-</td></tr>
<?php
require('../files/dbcon.php');
require('../files/ts.php');

if((isset($_POST['submitBan']) || isset($_POST['submitTmpBan']) || isset($_POST['submitUnban'])) && isset($_POST['uid']) && isset($_POST['uts']))
{
	$uid = $_POST['uid'];
	$uts = $_POST['uts'];
	if(isset($_POST['submitBan'])) { $sub = 'b'; $dt = "9999-12-31 23:59:59"; }
	elseif(isset($_POST['submitTmpBan'])) { $sub = 't'; $dt = date('Y-m-d H:i:s', $ts+2*24*60*60); }
	else { $sub = 'y'; $dt = "1970-01-01 00:00:00"; }
	
	$rem = "-";
	
	$sql = "update `$db`.`mt_users_pass` set status='$sub' where ts='$uts' and userid='$uid';";
	mysqli_query($dbcon, $sql) or die($sql);
	
	$sl = fnRowID("mt_users_ban_log");
	$sql = "insert into `$db`.`mt_users_ban_log` values ('$sl', '$uid', '$uts', '$dt', '$sub', '$u', '$now', '$rem');";
	mysqli_query($dbcon, $sql) or die($sql);
	
	mysqli_close($dbcon);
	die("<script>window.location='user_list.php';</script>");
}

$i = 0;
$sql = "select t1.* from `$db`.`mt_users_pass` t1 where 1 order by t1.sl desc;";
$r = mysqli_query($dbcon, $sql) or die($sql);
while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
{
	echo "<tr><td>".++$i."</td>
	<td>".$row['userid']."</td>
	<td>".$row['utype']."</td>
	<td>".$row['name']."</td>
	<td>".$row['mobile']."</td>
	<td>".$row['location']."</td>
	<td>".$row['createdOn']."</td>
	<td><a target=_blank href='nid_pic.php?ts=".$row['ts']."&uid=".$row['userid']."'><img src='images/nid_front.png' alt='NID'></a></td>";
	
	if($row['status']=='y') { echo "<td>OK</td>"; }
	elseif($row['status']=='t') { echo "<td>TEMP. BANNED</td>"; }
	elseif($row['status']=='b') { echo "<td>BANNED</td>"; }
	else { echo "<td>UNVERIFIED</td>"; }

	if($row['status']=='b' || $row['status']=='t') {
		echo "<td><form name='frm$i' method=post action='' style='margin-bottom:0px;' onsubmit='return confirm(\"Are you sure you want to do that ?\");'>
		<input type=hidden name=uid value='".$row['userid']."'>
		<input type=hidden name=uts value='".$row['ts']."'>
		<input type=submit name='submitUnban' value='Unban Now'>
		</form></td>";
	}
	else {
		echo "<td><form name='frm$i' method=post action='' style='margin-bottom:0px;' onsubmit='return confirm(\"Are you sure you want to do that ?\");'>
		<input type=hidden name=uid value='".$row['userid']."'>
		<input type=hidden name=uts value='".$row['ts']."'>
		<input type=submit name='submitBan' value='Ban Now'>
		<input type=submit name='submitTmpBan' value='Temp. Ban Now'>
		</form></td>";
	}
	
	echo "</tr>";
}

mysqli_close($dbcon);
?>
</table>

</div>
</body>

</html>
