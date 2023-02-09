<?php session_start();
require_once("files/common_top.php");
require_once("files/session.php");

if(isset($_REQUEST['ts']) && isset($_REQUEST['uid']))
{
	$ts = $_REQUEST['ts'];
	$uid = $_REQUEST['uid'];
}
else { die("INVALID REQUEST"); }
?>

<html>
<head>
<title>NID - <?php echo $uid; ?></title>
</head>

<body>

<h2>National ID</h2>

<?php
require('../files/dbcon.php');
$i = 0;
$sql = "select * from `$db`.`mt_users_nid` where userid='$uid';";
$r = mysqli_query($dbcon, $sql) or die($sql);
while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
{
	echo "<a href='../profile_pic/".$ts."_".$row['nid1']."'><img src='../profile_pic/".$ts."_".$row['nid1']."' alt='NID FRONT' style='max-width:200px; max-height:150px'></a>";
	echo "<br><br>";
	echo "<a href='../profile_pic/".$ts."_".$row['nid2']."'><img src='../profile_pic/".$ts."_".$row['nid2']."' alt='NID FRONT' style='max-width:200px; max-height:150px'></a>";
	$i++;
}

mysqli_close($dbcon);

if($i==0)
{
	echo "NID not found.";
}
?>

</body>

</html>
