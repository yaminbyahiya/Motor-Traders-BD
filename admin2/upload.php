<?php
require_once("files/common_top.php");

if(!empty($_FILES))
{
	require_once('files/ts.php');
	
	$ds = DIRECTORY_SEPARATOR;
	$storeFolder = 'upload';
	$tempFile = $_FILES['file']['tmp_name'];
	$file = $_FILES['file']['name'];
	$targetPath = dirname( __FILE__ ).$ds.$storeFolder.$ds;
	$targetFile = $targetPath.$file;
	move_uploaded_file($tempFile, $targetFile);
	
	//file logs
	copy("upload/".$file, "upload/logs/".$ts."_".$file);
	
	if(isset($_SESSION['userid']) && isset($_SESSION['username'])) { $u = $_SESSION['userid']; $un = $_SESSION['username']; }
	else { $u = $un = "n/a"; }
	
	
	require_once('files/dbcon.php');
	
	$sql = "insert into `$db`.`file_upload` values ('', '$ts', '$file', '$u', '$now', NULL, NULL, NULL);";
	mysql_query($sql, $dbcon) or die($sql);
	
	mysql_close($dbcon);
}
?>
