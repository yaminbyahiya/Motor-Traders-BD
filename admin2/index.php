<?php session_start();
require_once("files/common_top.php");

$flag = 0;

//already logged in, session found
if(isset($_SESSION['mta-user']) && isset($_SESSION['mta-pass']) && isset($_SESSION['mta-ts']))
{
	die("<script>window.location='home.php';</script>");
}
elseif(isset($_POST['submitLogin']))
{
	$u = strip_tags(strtolower($_POST['username']));		$u = preg_replace("([^a-z0-9.-_])", "", $u);
	$p = strip_tags($_POST['password']);					$p = preg_replace("([^A-Za-z0-9~!@#$:,.])", "", $p);
	$p0 = $_POST['password'];
	
	$c = str_rot13($p);
	$p2 = md5($p.$c);
	
	require_once('files/ts.php');
	require_once('../files/dbcon.php');
	
	$sql = "select * from `$db`.`mt_admin_users` where userid='$u' and pass='$p2' and captcha='$c';";
	$r = mysqli_query($dbcon, $sql) or die("$sql");
	while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
	{
		$_SESSION['mta-user'] = "$u";
		$_SESSION['mta-pass'] = "$p";
		$_SESSION['mta-ts'] = "$ts";

		$sql2 = "insert into `$db`.`mt_users_login` values (null, '$u', 'OK', 'login', '$now', 'ADMIN');";
		mysqli_query($dbcon, $sql2) or die("$sql2");

		mysqli_close($dbcon);
		
		echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=home.php\">";
		exit();
	}
	
	$sql2 = "insert into `$db`.`mt_users_login` values (null, '$u', '$p0', 'login', '$now', 'ADMIN wrong');";
	mysqli_query($dbcon, $sql2) or die("$sql2");

	mysqli_close($dbcon);
	
	$flag=1;
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once("files/head.php"); ?>
<title>MT-ADMIN</title>
</head>

<body class="login-page">
<div class="login-box">
	<?php require_once("files/logo_title_dev.php"); ?>
	
	<div class="card">
		<div class="body">
			<form id="sign_in" name="frm_login" method="POST" action="">
				<div class="msg">Sign in to start your work</div>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">person</i></span>
					<div class="form-line">
						<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
					</div>
				</div>
				<div class="input-group">
					<span class="input-group-addon">
						<i class="material-icons">lock</i>
					</span>
					<div class="form-line">
						<input type="password" name="password" class="form-control" placeholder="Password" required>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-8 p-t-5">
						<input type="checkbox" name="rememberme" id="rememberme" class="filled-in chk-col-pink">
						<label for="rememberme" style='padding-left:13px;'>Remember Me</label>
					</div>
					<div class="col-xs-4">
						<button type="submit" name="submitLogin" class="btn btn-block bg-pink waves-effect">SIGN IN</button>
					</div>
				</div>
				<div class="row m-t-15 m-b--20">
					<div class="col-xs-12 align-center">
						<a href="forgot-password.html">Forgot Password?</a>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Jquery Core Js -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap Core Js -->
<script src="js/bootstrap.js"></script>
<!-- Waves Effect Plugin Js -->
<script src="js/waves.js"></script>
<!-- Validation Plugin Js -->
<script src="js/jquery.validate.js"></script>
<!-- Custom Js -->
<script src="js/admin.js"></script>
<script src="js/sign-in.js"></script>

</body>
</html>

<?php
if($flag==1) {
	echo "<script>alert('WARNING!!! Invalid userid / password.');</script>";
}
?>