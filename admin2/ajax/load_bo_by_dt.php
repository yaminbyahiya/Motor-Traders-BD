<?php
file_put_contents("test.txt", time(), FILE_APPEND);

require('../files/dbcon.php');
$y = $_REQUEST['y'];
$m = $_REQUEST['m'];
$d = $_REQUEST['d'];

$data = [];

$sql = "select distinct(ClientCode) from `$db`.`trades` where Date='$y$m$d' and Action='EXEC' order by ClientCode;";
$r = mysql_query($sql, $dbcon) or die($sql);
while($row = mysql_fetch_array($r)) {
	$data[] = $row[0];
}

mysql_close($dbcon);

echo json_encode($data);
?>
