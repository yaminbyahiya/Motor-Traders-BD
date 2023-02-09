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
<h2>News Approve</h2>
<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;'>
<tr><td>SL</td><td>User ID</td><td>News ID</td><td>Title</td><td>Submit on</td><td colspan=2>-</td></tr>
<?php
require('../files/dbcon.php');
$i = 0;
$sql = "select * from `$db`.`mt_news` where status='n' order by sl;";
$r = mysqli_query($dbcon, $sql) or die($sql);
while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
{
	echo "<tr><td>".++$i."</td><td>".$row['userid']."</td><td><a target='_blank' href='../news_details.php?nid=".$row['nid']."'>".$row['nid']."</a></td><td>".$row['title']."</td><td>".$row['createdOn']."</td>";
	echo "<td><form name='frm$i' method=post action='news_approve_yes.php' style='margin-bottom:0px;'><input type=submit name='submitApprove' value='Approve Now'><input type=hidden name=nid value='".$row['nid']."'><input type=hidden name=userid value='".$row['userid']."'></form></td>";
	
	echo "<td><form name='frm$i' method=post action='news_approve_no.php' style='margin-bottom:0px;'><input type=submit name='submitDeny' value='Deny News'><input type=hidden name=nid value='".$row['nid']."'><input type=hidden name=userid value='".$row['userid']."'></form></td>";
	
	echo "</tr>";
}

mysqli_close($dbcon);
?>
</table>

</div>
</body>
</html>
