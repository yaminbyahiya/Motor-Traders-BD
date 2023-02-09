<?php
//DATABASE
$server = "localhost";
$user = "delta185";
$pass = "sCbu!#53&6";
$db = "deltacapitalbd_mysqldb";
$dbcon = mysql_connect($server, $user, $pass);
if(!$dbcon) die('Could not connect : ' . mysql_error());
mysql_select_db($db, $dbcon);
