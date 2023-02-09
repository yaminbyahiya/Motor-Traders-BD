<?php session_start();
require("session.php");

$_SESSION['mta-user'] = "";
$_SESSION['mta-pass'] = "";
unset($_SESSION['mta-user']);
unset($_SESSION['mta-pass']);

require('../files/ts.php');
require('../files/dbcon.php');

$sql = "insert into `$db`.`mt_users_login` values (null, '$u', '-', 'logout', '$now', 'OK');";
mysqli_query($dbcon, $sql) or die("$sql");

mysqli_close($dbcon);

echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=index.php\">";
exit();
?>