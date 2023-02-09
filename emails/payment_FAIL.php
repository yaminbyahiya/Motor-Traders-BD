<?php
date_default_timezone_set('Asia/Dhaka');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('files/ts.php');

//from SSL redirect page (value setup by me)

if(isset($_REQUEST['invid']) && isset($_REQUEST['tid']) && isset($_REQUEST['uid']))
{
	$u = str_rot13($_REQUEST['uid']);
	$invid = $_REQUEST['invid'];
	$tran_id = $_REQUEST['tid'];

	require('files/dbcon.php');
	$foundPaymentInfo = false;
	$txntype = "x";

	$sql = "select t1.txntype, t1.title, t1.qty, t1.pid, t2.result from `$db`.`mt_transaction_log` t1, `$db`.`mt_tran_ssl_log` t2 where t1.userid='$u' and t1.invid='$invid' and t1.status='y' and t1.result is null and t1.result_dt is null and t1.invid=t2.invid and t1.userid=t2.userid and t2.tran_id='$tran_id' and t2.status='y' and t2.sessionkey is not null and t2.directPaymentURL is not null;";
	$r = mysqli_query($dbcon, $sql) or die("$sql");
	while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
	{
		$txntype = $row[0];
		
		$sql2 = "update `$db`.`mt_tran_ssl_log` set result='FAIL', result_dt='$now' where invid='$invid' and userid='$u' and tran_id='$tran_id';";
		mysqli_query($dbcon, $sql2) or die("$sql2");
		
		$sql2 = "update `$db`.`mt_transaction_log` set result='FAIL', result_dt='$now' where invid='$invid' and userid='$u';";
		mysqli_query($dbcon, $sql2) or die("$sql2");
		
		/*
		$boostName = $row[0];
		$day = $row[1];
		$pid = $row[2];
		
		$sql2 = "update `$db`.`mt_sell_car` set boost='y', boostName='$boostName', boostExpiry='".date('Y-m-d H:i:s', $ts + $day*24*60*60)."', invid='$invid' where userid='$u' and pid='$pid';";
		mysqli_query($dbcon, $sql2) or die("$sql2");
		*/
		
		$foundPaymentInfo = true;
	}

	mysqli_close($dbcon);
	
	if($foundPaymentInfo==false)
	{
		die("<script>window.location='index.php?lang=En';</script>");
	}
	else
	{
		die("<script>alert('WARNING !!! Error in payment procedure.'); window.location='payment_after.php?uid=".str_rot13($u)."&txntype=$txntype';</script>");
	}
}
else { die("<script>window.location='index.php?lang=En';</script>"); }
?>
