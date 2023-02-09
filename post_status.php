<?php session_start();
require('files/session.php');
if($u!="" && $session==true) {} else { die("<script>window.location='profile.php';</script>"); }

if(isset($_REQUEST['option']) && isset($_REQUEST['pid']) && isset($_REQUEST['ts']))
{
	$lng = strtolower($_REQUEST['lng']);		if($lng=='en') { $lng = ""; } else { $lng = "-bn";}
	$opt = strtolower($_REQUEST['option']);
	$pid = $_REQUEST['pid'];
	$ts0 = $_REQUEST['ts'];
	
	require('files/ts.php');
	
	if($ts-$ts0<=300 && $ts0>0 && ($opt=='sold' || $opt=='hide' || $opt=='unsold' || $opt=='unhide' || $opt=='delete'))
	{
		require('files/dbcon.php');
		
		$sl = 0;
		$sql = "select sl from `$db`.`mt_sell_car` where status in ('y', 'n') and pid='$pid' and userid='$u';";
		$r = mysqli_query($dbcon, $sql) or die($sql);
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
		{
			$sl = $row[0];
			
			if($opt=='sold') {
				$sql2 = "update `$db`.`mt_sell_car` set marksold='y', removedOn='$now' where sl='$sl' and pid='$pid' and userid='$u';";
				$msg = "Marked - SOLD -";
			}
			elseif($opt=='unsold') {
				$sql2 = "update `$db`.`mt_sell_car` set marksold='n', removedOn='$now' where sl='$sl' and pid='$pid' and userid='$u';";
				$msg = "Marked - UNSOLD -";
			}
			elseif($opt=='hide') {
				$sql2 = "update `$db`.`mt_sell_car` set hidepost='y', removedOn='$now' where sl='$sl' and pid='$pid' and userid='$u';";
				$msg = "Marked - HIDE POST -";
			}
			elseif($opt=='unhide') {
				$sql2 = "update `$db`.`mt_sell_car` set hidepost='n', removedOn='$now' where sl='$sl' and pid='$pid' and userid='$u';";
				$msg = "Marked - SHOW POST -";
			}
			elseif($opt=='delete') {
				$sold = $_REQUEST['sold'];
				$sql2 = "insert into `$db`.`mt_sell_car_deleted_by_user` values (null, '$sl', '$pid', '$u', '$sold', '$now');";
				mysqli_query($dbcon, $sql2) or die($sql2);
				
				$sql2 = "update `$db`.`mt_sell_car` set status='d', removedOn='$now' where sl='$sl' and pid='$pid' and userid='$u';";
				$msg = "Post - DELETED -";
				
				//note that, after delete POST TOKEN remain same, ex. if token available = 2, after deletion it will remain 2
			}
			mysqli_query($dbcon, $sql2) or die($sql2);
			
			echo "<script>alert('$msg done.');</script>";
		}
		
		if($sl==0) { echo "<script>alert('WARNING!!! Error in post id $pid');</script>"; }
		
		mysqli_close($dbcon);
		
		die("<script>window.location='profile".$lng.".php';</script>");
	}
	else { die("<script>window.location='profile".$lng.".php';</script>"); }
}
else { die("<script>window.location='profile".$lng.".php';</script>"); }
?>
