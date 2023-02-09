<?php session_start();
require('files/session.php');
if($u!="" && $session==true) {} else { die("<script>window.location='profile.php';</script>"); }

if(isset($_POST['submitNID']))
{
	require('files/dbcon.php');
	require('files/ts.php');
	
	$allowed = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'png12', 'png24', 'gif', 'bmp');
	
	if($_FILES["file1"]["error"] > 0) { $img1 = ""; }
	else {
		$filename = strtolower(substr($_FILES['file1']['name'],-15));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$filename = preg_replace("([^A-Za-z0-9.])", "", $filename);
			$target = "profile_pic/".$uts."_".$filename;
			move_uploaded_file($_FILES["file1"]["tmp_name"], $target) or exit();
			$img1 = $filename;
		}
	}
	if($_FILES["file2"]["error"] > 0) { $img2 = ""; }
	else {
		$filename = strtolower(substr($_FILES['file2']['name'],-15));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$filename = preg_replace("([^A-Za-z0-9.])", "", $filename);
			$target = "profile_pic/".$uts."_".$filename;
			move_uploaded_file($_FILES["file2"]["tmp_name"], $target) or exit();
			$img2 = $filename;
		}
	}
	
	$sl = fnRowID("mt_users_nid");
	$sql = "insert into `$db`.`mt_users_nid` values ('$sl', '$u', '$img1', '$img2', 'n', '$now', NULL, NULL);";
	mysqli_query($dbcon, $sql) or die("$sql");
	
	mysqli_close($dbcon);
	
	die("<script>alert('NID images submitted.'); window.location='profile.php';</script>");
}
else { die("<script>window.location='profile.php';</script>"); }
?>
