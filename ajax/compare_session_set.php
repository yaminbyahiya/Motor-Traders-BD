<?php session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

file_put_contents("test1.txt", "OK", FILE_APPEND);

if(isset($_REQUEST['comp1']) && isset($_REQUEST['comp2']))
{
	$comp1 = $_REQUEST['comp1'];
	$comp2 = $_REQUEST['comp2'];
	
	$_SESSION['comp1'] = $comp1;
	$_SESSION['comp2'] = $comp2

	$data[] = "SAVE";
	echo json_encode($data);
}
?>
