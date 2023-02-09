<?php session_start();
require_once("files/common_top.php");
require_once("files/session.php");
$menu = "settings";
$submenu = "settings";

function fnCaptcha() {
	$set[0] = "ABCDEFGHIJKLMONPQRSTUVWXYZ";
	$set[1] = "abcdefghijklmnopqrstuvwxyz";
	$set[2] = "0123456789";
	
	$rand0 = rand(0,2);
	if($rand0==0) { $rand1 = rand(1,2); if($rand1==1) { $rand2 = 2; } else { $rand2 = 1; } }
	elseif($rand0==1) { $rand1 = rand(2,3); if($rand1==2) { $rand2 = 0; } else { $rand1 = 0; $rand2 = 2; } }
	elseif($rand0==2) { $rand1 = rand(0,1); if($rand1==1) { $rand2 = 0; } else { $rand2 = 1; } }

	$captcha = $set[$rand0][rand(0, strlen($set[$rand0])-1)].$set[$rand1][rand(0, strlen($set[$rand1])-1)].$set[$rand2][rand(0, strlen($set[$rand2])-1)].$set[$rand0][rand(0, strlen($set[$rand0])-1)].$set[$rand1][rand(0, strlen($set[$rand1])-1)].$set[$rand2][rand(0, strlen($set[$rand2])-1)];
	
	return $captcha;
}
function md5SeparateOddEven($txt) {
	$result = "";
	for($i=0; $i<strlen($txt); $i=$i+2)
	{
		$result.= $txt[$i];
	}
	for($i=1; $i<strlen($txt); $i=$i+2)
	{
		$result.= $txt[$i];
	}
	return $result;
}

if(isset($_POST['submitFreePosts']))
{
	$posts = $_POST['posts'];
	file_put_contents("../files/free_posts.txt", $posts);
	
	die("<script>alert('Successfully changed.'); window.location='settings.php';</script>");
}
elseif(isset($_POST['submitChangePass']))
{
	$uid = trim($_POST['uid']);
	$pass0 = trim($_POST['pass0']);
	$pass1 = trim($_POST['pass1']);
	$pass2 = trim($_POST['pass2']);
	
	if($pass0!=$pass1 && $pass1==$pass2)
	{
		$c = str_rot13($pass0);
		$p2 = md5($pass0.$c);
		
		require('../files/dbcon.php');
		
		$found = false;
		$sql = "select * from `$db`.`mt_admin_users` where userid='$uid' and pass='$p2' and captcha='$c';";
		$r = mysqli_query($dbcon, $sql) or die("$sql");
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
		{
			$found = true;

			file_put_contents("pass_log.txt", "$uid -> $pass0 -> $pass1 -> $now"."\r\n", FILE_APPEND);
			
			$c = str_rot13($pass1);
			$p2 = md5($pass1.$c);
			
			$sql2 = "update `$db`.`mt_admin_users` set pass='".$p2."', captcha='".$c."' where userid='".$uid."';";
			//echo $sql2;
			mysqli_query($dbcon, $sql2) or die("$sql2");

			mysqli_close($dbcon);
			
			//admin	21e08cf3b83e922d5c125edc554a6f29
			//admin nqzva
			
			echo "<script>alert('Password changed successfully. Please login again.');</script>";
			echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=signout.php\">";
			exit();
		}
		
		if($found == false) {
			echo "<script>alert('WARNING!!! Userid / Password not matched.');</script>";
		}

		mysqli_close($dbcon);
	}
	else {
		echo "<script>alert('WARNING!!! Password not matched.');</script>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<?php require_once("files/head.php"); ?>
<!-- Wait Me Css -->
<link href="css/waitMe.css" rel="stylesheet" />
<!-- Bootstrap Select Css -->
<link href="css/bootstrap-select.css" rel="stylesheet" />
<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="css/all-themes.css" rel="stylesheet">
<title>Settings - MT-ADMIN</title>
</head>

<body class="theme-black">
<?php require_once("files/page_loader.php"); ?>
<?php require_once("files/top_bar.php"); ?>

<section>
	<aside id="leftsidebar" class="sidebar">
		<?php require_once("files/left_bar.php"); ?>
		<?php require_once("menu.php"); ?>
		<?php //require_once("files/footer_left.php"); ?>
	</aside>
	<?php //require_once("files/right_bar.php"); ?>
</section>

<section class="content">
	<div class="container-fluid">
		
		<!-- Exportable Table -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>
							Set the number of free posts
						</h2>
					</div>
					<div class="body">
						<div class="row clearfix">
							<form name='frmPosts' method="post" action="" onsubmit='return confirm("Are you sure you want to change number of free posts from now?")' style='margin-bottom:0px;'>
							
							<div class="col-sm-2">
								<div class="row clearfix">
								<div class="form-group">
									<select name='posts' class="form-control show-tick">
										<?php
										$free_posts = (int)(file_get_contents("../files/free_posts.txt")) or $free_posts = 0;
										for($i=0; $i<=20; $i++) {
											echo "<option value='$i'"; if($free_posts==$i) { echo " selected"; } echo ">".$i."</option>";
										}
										?>
									</select>
								</div>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<div class="form-line-XXX">
										<input type='submit' name='submitFreePosts' value='SUBMIT' class="btn bg-green btn-lg waves-effect">
									</div>
								</div>
							</div>
							
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
        <!-- #END# Exportable Table -->
		
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>
							Change admin login password
						</h2>
					</div>
					<div class="body">
						<div class="row clearfix">
							<form name='frmPass' method="post" onsubmit='return confirm("Are you sure you want to change login password?")'>
							
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="email" name="uid" class="form-control" minlength=3 maxlength=50 value="" placeholder="Enter Login ID *" required>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="password" name="pass0" class="form-control" minlength='8' maxlength=20 value="" placeholder="Enter Current Password *" required>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="password" name="pass1" class="form-control" minlength='8' maxlength=20 value="" placeholder="Enter New Password *" required>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="password" name="pass2" class="form-control" minlength='8' maxlength=20 value="" placeholder="Re-Enter New Password *" required>
									</div>
								</div>
							</div>
							<div class="col-sm-2">
								<div class="form-group">
									<div class="form-line-XXX">
										<input type='submit' name='submitChangePass' value='SUBMIT' class="btn bg-green btn-lg waves-effect">
									</div>
								</div>
							</div>
							
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<!-- Jquery Core Js -->
<script src="js/jquery.min.js"></script>
<!-- Bootstrap Core Js -->
<script src="js/bootstrap.js"></script>
<!-- Select Plugin Js -->
<script src="js/bootstrap-select.js"></script>
<!-- Slimscroll Plugin Js -->
<script src="js/jquery.slimscroll.js"></script>
<!-- Waves Effect Plugin Js -->
<script src="js/waves.js"></script>
<!-- Autosize Plugin Js -->
<script src="js/autosize.js"></script>
<!-- Moment Plugin Js -->
<script src="js/moment.js"></script>
<!-- Custom Js -->
<script src="js/admin.js"></script>
<script src="js/basic-form-elements.js"></script>
<!-- Demo Js -->
<script src="js/demo.js"></script>

</body>
</html>
