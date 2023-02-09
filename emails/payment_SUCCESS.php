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

	$sql = "select t1.txntype, t1.title, t1.qty, t1.pid, t2.result from `$db`.`mt_transaction_log` t1, `$db`.`mt_tran_ssl_log` t2 where t1.userid='$u' and t1.invid='$invid' and t1.status='y'	and t1.invid=t2.invid and t1.userid=t2.userid and t2.tran_id='$tran_id' and t2.status='y' and t2.sessionkey is not null and t2.directPaymentURL is not null;";
	//and t1.result is null and t1.result_dt is null
	$r = mysqli_query($dbcon, $sql) or die("$sql");
	while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
	{
		$txntype = $row[0];
		
		//$sql2 = "update `$db`.`mt_tran_ssl_log` set result='SUCCESS', result_dt='$now' where invid='$invid' and userid='$u' and tran_id='$tran_id';";
		//mysqli_query($dbcon, $sql2) or die("$sql2");
		
		//$sql2 = "update `$db`.`mt_transaction_log` set result='SUCCESS', result_dt='$now' where invid='$invid' and userid='$u';";
		//mysqli_query($dbcon, $sql2) or die("$sql2");
		
		$pid = $row[3];
		
		if($txntype=="token") {
			$sql2 = "update `$db`.`mt_users_pass` set tokens=tokens+$token where userid='$u';";
			mysqli_query($dbcon, $sql2) or die("$sql2");
		}
		elseif($txntype=="boost") {
			$boostName = $row[1];
			$day = $row[2];
			
			$sql2 = "update `$db`.`mt_sell_car` set boost='y', boostName='$boostName', boostExpiry='".date('Y-m-d H:i:s', $ts + $day*24*60*60)."', invid='$invid' where userid='$u' and pid='$pid';";
			mysqli_query($dbcon, $sql2) or die("$sql2");
		}
		elseif($txntype=="mtrpt") {
			$sql2 = "select mtrpt from `$db`.`mt_sell_car_pic` where userid='$u' and pid='$pid';";
			//echo $sql2;
			$r2 = mysqli_query($dbcon, $sql2) or die("$sql2");
			while($row2 = mysqli_fetch_array($r2, MYSQLI_BOTH))
			{
				$mtrpt = "post_pic/".$pid."_".$row2[0];
				$fileName = "";
				$fileExt = "";
				$tmp = explode(".", $row2[0]);
				for($i=0; $i<count($tmp)-1; $i++) {
					$fileName.= $tmp[$i];
				}
				$fileExt = $tmp[$i];
			}
			
			$sql2 = "select name, email from `$db`.`mt_users_pass` where userid='$u';";
			$r2 = mysqli_query($dbcon, $sql2) or die("$sql2");
			while($row2 = mysqli_fetch_array($r2, MYSQLI_BOTH))
			{
				$un = $row2['name'];
				$ue = $row2['email'];
			}

			//$content = file_get_contents($mtrpt);
			//$content = chunk_split(base64_encode($content));
			// a random hash will be necessary to send mixed content
			//$separator = md5(time());
			
			require('emails/mt-report_download.php');
		}
		
		$foundPaymentInfo = true;
	}

	mysqli_close($dbcon);
	
	if($foundPaymentInfo==false)
	{
		die("<script>window.location='index.php?lang=En';</script>");
	}
	else
	{
		if($txntype=="token") {
			die("<script>alert('$token Token(s) credited successfully. You may now submit post.'); window.location='payment_after.php?uid=".str_rot13($u)."&txntype=$txntype';</script>");
		}
		elseif($txntype=="boost") {
			die("<script>alert('Post was boost successfully for $day days.'); window.location='payment_after.php?uid=".str_rot13($u)."&txntype=$txntype';</script>");
		}
		elseif($txntype=="mtrpt") {
			die("<script>alert('A download link was sent to your email address. The link is valid for 24hrs.'); window.location='payment_after.php?uid=".str_rot13($u)."&txntype=$txntype';</script>");
		}
		else { die("<script>window.location='index.php?lang=En';</script>"); }
	}
}
else { die("<script>window.location='index.php?lang=En';</script>"); }
?>
