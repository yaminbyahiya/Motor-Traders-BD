<?php
date_default_timezone_set('Asia/Dhaka');

if(isset($_REQUEST['sname']) && isset($_REQUEST['pid1']) && isset($_REQUEST['pid2']) && isset($_REQUEST['uid']))
{
	$sname = $_REQUEST['sname'];
	$pid1 = $_REQUEST['pid1'];
	$pid2 = $_REQUEST['pid2'];
	$u = $_REQUEST['uid'];
	
	require('../files/ts.php');
	require('../files/dbcon.php');
	
	$sl = 0;
	$sql = "select sl from `$db`.`mt_compares_log` where userid='$u' and ((pid1='$pid1' and pid2='$pid2') or (pid1='$pid2' and pid2='$pid1')) and status='y';";
	$r = mysqli_query($dbcon, $sql) or die("$sql");
	while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
	{
		$sl++;
	}
	
	if($sl==0)
	{
		$sl = fnRowID("mt_compares_log");
		$sql = "insert into `$db`.`mt_compares_log` values ('$sl', '$u', '$sname', '$pid1', '$pid2', 'y', '$now', null);";
		$r = mysqli_query($dbcon, $sql) or die(file_put_contents("error.txt", "$sql"."\r\n\r\n", FILE_APPEND));
		
		$data[] = "SAVE";
		$data[] = "$sname";
	}
	else
	{
		$data[] = "FOUND";
		$data[] = "$sname";
	}
	
	mysqli_close($dbcon);

	echo json_encode($data);
}
?>
