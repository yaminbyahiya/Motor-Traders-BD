<?php session_start();
date_default_timezone_set('Asia/Dhaka');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//location set
if(isset($_REQUEST['loc'])) { $_SESSION['setLoc'] = $setLoc = $_REQUEST['loc']; }
else { $_SESSION['setLoc'] = $setLoc = "x"; }

die("<script>window.location = 'index.php';</script>")
?>
