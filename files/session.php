<?php
date_default_timezone_set('Asia/Dhaka');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//if(isset($_SESSION['comp1']) && isset($_SESSION['comp2'])) { $comp1 = $_SESSION['comp1']; $comp2 = $_SESSION['comp2']; }
//else { $_SESSION['comp1'] = $comp1 = "1"; $_SESSION['comp2'] = $comp2 = "2"; }

//location set
if(isset($_SESSION['setLoc'])) { $setLoc = $_SESSION['setLoc']; }
elseif(isset($_REQUEST['loc'])) { $setLoc = $_REQUEST['loc']; }
else { $setLoc = "x"; }

//
$ue = $un = "";
$u = "x";
if(isset($_SESSION['userid']))
{
	$ut = $_SESSION['usertype'];
	$u = $_SESSION['userid'];
	$un = $_SESSION['username'];
	$ue = $_SESSION['email'];
	$um = $_SESSION['mobile'];
	$upic = $_SESSION['propic'];
	$uts = $_SESSION['prots'];
	$uvd = $_SESSION['vdealer'];
	$email_verify = $_SESSION['email_verify'];
	$session = true;
}
elseif(isset($_COOKIE['userid']) && isset($_COOKIE['username']))
{
	$ut = $_COOKIE['usertype'];
	$u = $_COOKIE['userid'];
	$un = $_COOKIE['username'];
	$ue = $_COOKIE['email'];
	$um = $_COOKIE['mobile'];
	$upic = $_COOKIE['propic'];
	$uts = $_COOKIE['prots'];
	$uvd = $_COOKIE['vdealer'];
	$email_verify = $_COOKIE['email_verify'];
	$session = true;
	
	$ts = time() + 3*24*60*60;
	setcookie("usertype", $ut, $ts);
	setcookie("userid", $u, $ts);
	setcookie("username", $un, $ts);
	setcookie("email", $ue, $ts);
	setcookie("mobile", $um, $ts);
	setcookie("propic", $upic, $ts);
	setcookie("prots", $uts, $ts);
	setcookie("vdealer", $uvd, $ts);
	setcookie("email_verify", $email_verify, $ts);
}
else {
	$u = "";
	$session = false;
}
