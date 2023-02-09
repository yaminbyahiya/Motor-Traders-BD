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
<h2>User Verify</h2>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>SL</td><td>User ID</td><td>NID Upload</td><td>Front</td><td>Back</td><td>-</td></tr>
<?php
require('../files/dbcon.php');
$i = 0;
$sql = "select t1.*, t2.ts from `$db`.`mt_users_nid` t1, `$db`.`mt_users_pass` t2 where t1.status='n' and t1.userid=t2.userid order by t1.sl;";
$r = mysqli_query($dbcon, $sql) or die($sql);
while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
{
	echo "<tr><td>".++$i."</td><td>$row[1]</td><td>".$row['createdOn']."</td><td><a target=_blank href='../profile_pic/".$row['ts']."_".$row['nid1']."'><img src='images/nid_front.png' alt='NID 1'></td><td><a target=_blank href='../profile_pic/".$row['ts']."_".$row['nid2']."'><img src='images/nid_back.png' alt='NID 2'></td>";
	echo "<td><form name='frm$i' method=post action='user_verify_submit.php' style='margin-bottom:0px;'><input type=submit name='submitVerify' value='Verify Now'><input type=hidden name=uid value='$row[1]'><input type=hidden name=uts value='".$row['ts']."'></form></td>";
	echo "<td><form name='frm$i' method=post action='user_verify_submit_no.php' style='margin-bottom:0px;'><input type=submit name='submitVerifyNo' value='Deny User'><input type=hidden name=uid value='$row[1]'><input type=hidden name=uts value='".$row['ts']."'></form></td>";
	echo "</tr>";
}

mysqli_close($dbcon);
?>
</table>

</div>
</body>
</html>
