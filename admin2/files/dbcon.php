<?php
//DATABASE
$server = "localhost";
$user = "root";
$pass = "";
$db = "delta_trades_xml";
$dbcon = mysql_connect($server, $user, $pass);
if(!$dbcon) die('Could not connect : ' . mysql_error());
mysql_select_db($db, $dbcon);
