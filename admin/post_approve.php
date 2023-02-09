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
<h2>Post Approve</h2>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>SL</td><td>User ID</td><td>Post ID</td><td>Brand / Model</td><td>Submit on</td><td colspan=2>-</td></tr>
<?php
require('../files/dbcon.php');
$i = 0;
$sql = "select * from `$db`.`mt_sell_car` where status='n' order by sl;";
$r = mysqli_query($dbcon, $sql) or die($sql);
while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
{
	echo "<tr><td>".++$i."</td><td>".$row['userid']."</td><td><a target='_blank' href='../vehicle_details.php?pid=".$row['pid']."'>".$row['pid']."</a></td><td>".$row['brand']." - ".$row['model']."</td><td>".$row['createdOn']."</td>";
	
	echo "<td><form name='frm$i' method='post' action='post_approve_yes.php' style='margin-bottom:0px;'><input type=submit name='submitApprove' value='Approve Now'><input type=hidden name=pid value='".$row['pid']."'><input type=hidden name=userid value='".$row['userid']."'></form></td>";
	
	echo "<td><form name='frm$i' method='post' action='post_approve_no.php' style='margin-bottom:0px;'><input type=submit name='submitDeny' value='Deny Post'><input type=hidden name=pid value='".$row['pid']."'><input type=hidden name=userid value='".$row['userid']."'></form></td>";
	
	echo "</tr>";
}

mysqli_close($dbcon);
?>
</table>

</div>
</body>
</html>
