<?php session_start();
if(isset($_POST['submit']))
{
	$u = $_POST['user'];
	$p = $_POST['pass'];
	
	$c = str_rot13($p);
	$p2 = md5($p.$c);
	
	require('../files/ts.php');
	require('../files/dbcon.php');
	
	$sql = "select * from `$db`.`mt_admin_users` where userid='$u' and pass='$p2' and captcha='$c';";
	$r = mysqli_query($dbcon, $sql) or die("$sql");
	while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
	{
		$_SESSION['mta-user'] = "$u";
		$_SESSION['mta-pass'] = "$p";
		
		//echo $_SESSION['mta-user'].$_SESSION['mta-pass'];
		//die();

		$sql2 = "insert into `$db`.`mt_users_login` values (null, '$u', 'OK', 'login', '$now', 'ADMIN');";
		mysqli_query($dbcon, $sql2) or die("$sql2");

		mysqli_close($dbcon);
		
		echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=home.php\">";
		exit();
	}
	
	$sql2 = "insert into `$db`.`mt_users_login` values (null, '$u', '$p', 'login', '$now', 'ADMIN wrong');";
	mysqli_query($dbcon, $sql2) or die("$sql2");

	mysqli_close($dbcon);
	
	$flag=1;
}
?>

<html>
<head>
<?php require("head.php"); ?>
<style type="text/css">
body{
	background-color: #FFCC00;
	margin: 20 20 20 20;
}
.eng
{
	font-style : normal;
	font-weight : bold;
	font-family : verdana;
	font-size : 12px;
	color : #000000;
}
</style>
</head>

<body>
<table border=0 width="100%" height="100%" cellpadding=0 cellspacing=0 bgcolor=#F9FAFC>
	<tr>
		<td align="center">
		<img src="../images/logo.png"><br><br><br>
<?php
	if($flag==1) {	echo "<font size=3 color=#FF0000><b>Username / Password does not match.</b></font><br><br><br>"; }
?>
		<form method="POST" action="index.php" class=eng>
			Username &nbsp;<input type=text name="user" size="15" maxlength=20 required><br><br>
			Password &nbsp;<input type=password name="pass" size="15" maxlength=20 required><br><br><br>
			<input type="submit" value="Submit" name="submit">
		</form>
		</td>
	</tr>
</table>

</body>

</html>