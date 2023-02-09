<?php
//DATABASE
$server = "localhost";
$db = "motortrader_motortraderbd";
$dbuser = "motortrader_motortraderbd";
$dbpass = "motortraderbd_motortraderbd";
$dbcon = mysqli_connect($server, $dbuser, $dbpass, $db);
if($dbcon->connect_errno) { echo "Failed to connect MySQLi: (".$dbcon->connect_errno.") ".$dbcon->connect_error; die(); }
//else { echo "DBCON CONNECTED"; }

mysqli_query($dbcon, "SET CHARACTER SET 'utf8'");
mysqli_query($dbcon, "SET SESSION collation_connection = 'utf8_unicode_ci'");

function fnRowID($tbl)
{
	global $db, $dbcon;
	$rowID = $maxID = $countID = 0;
	$sql = "select MAX(sl), COUNT(sl) from `$db`.`$tbl`;";		$r = mysqli_query($dbcon,$sql) or die($sql);
	while($row = mysqli_fetch_array($r, MYSQLI_BOTH)) { $maxID = $row[0]; $countID =$row[1]; if($maxID>=$countID) { $rowID = $maxID+1; } else { $rowID = $countID+1; } }
	return $rowID;
}
 