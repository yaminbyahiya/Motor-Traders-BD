<?php session_start();
require_once("files/common_top.php");
require_once("files/session.php");
$menu = "users";
$submenu = "user-corpo-add";

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

if(isset($_POST['submitRegister']) && isset($_POST['email']))
{
	$name = $_POST['name'];				$name = preg_replace("([^A-Za-z. -])", "", $name);
	$email = $_POST['email'];			$email = preg_replace("([^a-z0-9@.-_])", "", strtolower($email));
	$mobile = $_POST['mobile'];			$mobile = preg_replace("([^0-9])", "", $mobile);
	$loc = $_POST['location'];			$loc = preg_replace("([^A-Za-z])", "", $loc);
	$p1 = $_POST['pass1'];				$p1 = preg_replace("([^A-Za-z0-9. -/#&(_):;,])", "", $p1);
	$p2 = $_POST['pass2'];				$p2 = preg_replace("([^A-Za-z0-9. -/#&(_):;,])", "", $p2);
	$vdealer = $_POST['vdealer'];		$vdealer = preg_replace("([^A-Za-z. -,0-9])", "", $vdealer);
	$address = $_POST['address'];		$address = preg_replace("([^A-Za-z.: ()/#-,0-9])", "", $address);
	
	if($p1==$p2)
	{
		require_once('../files/dbcon.php');
		
		$userFound = 0;
		$sql = "select * from `$db`.`mt_users_pass` where userid='$email';";
		$r = mysqli_query($dbcon, $sql) or die("$sql");
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH)) { $userFound = 1; }
		
		if($userFound==0)
		{
			$c = fnCaptcha();
			$pass = md5SeparateOddEven(md5($p1.$c));
			$userid = $email;
			$profile_pic = "";
			
			$allowed = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'png12', 'png24', 'gif', 'bmp');
			
			if($_FILES["file1"]["error"] > 0) { echo "<script>alert('WARNING!!! Image file not found.');</script>"; }
			else {
				$filename = strtolower(substr($_FILES['file1']['name'],-15));
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!in_array($ext, $allowed)) {
					echo "<script>alert('WARNING!!! Image file format not supported.');</script>";
				}
				else
				{
					$profile_pic = preg_replace("([^A-Za-z0-9.])", "", $filename);
					$target = "../profile_pic/".$ts."_".$profile_pic;
					move_uploaded_file($_FILES["file1"]["tmp_name"], $target) or exit();
					
					$sl = fnRowID("mt_users_propic_log");
					$sql = "insert into `$db`.`mt_users_propic_log` values ('$sl', '$userid', '$ts', '$profile_pic', '$now');";
					mysqli_query($dbcon, $sql) or die("$sql");
				}
			}
			
			//$sl = fnRowID("mt_users_pass");
			$sql = "insert into `$db`.`mt_users_pass` values (null, '$userid', '$name', '$email', '$mobile', '$loc', '$pass', '$c', 'Corporate', 1000, '$vdealer', $ts, '$profile_pic', 'y', '$now', NULL, '$address', NULL, NULL, NULL);";
			mysqli_query($dbcon, $sql) or die("$sql");
			
			//$sl = fnRowID("mt_users_pass_log");
			$sql = "insert into `$db`.`mt_users_pass_log` values (null, '$userid', '$name', '$email', '$mobile', '$loc', '$pass', '$c', 'Corporate', 1000, '$vdealer', $ts, '$profile_pic', 'y', '$now', 'SIGNUP', NULL, NULL, NULL, NULL);";
			mysqli_query($dbcon, $sql) or die("$sql");
			
			mysqli_close($dbcon);
			die("<script>alert('Corporate user added successfully.'); window.location='user_list.php';</script>");
			
			//mobile email otp send
		}
		else
		{
			mysqli_close($dbcon);
			die("<script>alert('Userid/Email already registered with MotorTrader. Please try with another one.'); window.location='user_corporate_add.php';</script>");
		}
	}
	else
	{
		die("<script>alert('Password do not matched. Please try again.'); window.location='user_corporate_add.php';</script>");
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
<title>Add Corporate User - MT-ADMIN</title>
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
							Add Corporate User
						</h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<i class="material-icons">more_vert</i>
								</a>
								<!--
								<ul class="dropdown-menu pull-right">
									<li><a href="javascript:void(0);">Action</a></li>
									<li><a href="javascript:void(0);">Another action</a></li>
									<li><a href="javascript:void(0);">Something else here</a></li>
								</ul>
								-->
							</li>
						</ul>
					</div>
					<div class="body">
						<div class="row clearfix">
							<script>
							function validFrms()
							{
								var reg = /(.*?)\.(jpg|JPG|jpeg|JPEG|png|png12|png24|gif|bmp)$/;
								
								var fileInput = document.getElementById("file1");
								if(fileInput.files.length == 0) {}						/* no file selected */
								else {
									var file = fileInput.files[0].name;					/* Capture.JPEG */
									var fileName = file.toLowerCase();					/* capture.jpeg */
									var fileExt = '.' + fileName.split('.').pop();		/* .jpeg */
									if(!fileExt.match(reg))
									{
										alert("Invalid file '"+fileName+"' selected. Please select image file extension with *.jpg|JPG|jpeg|JPEG|png|png12|png24|gif|bmp.");
										return false;
									}
								}
								
								var a = document.frmCorp.pass1.value;		if(a=="" || a==null) { return false; }
								if(a==document.frmCorp.pass2.value) {} 	else { alert('Password did not match. Please check.'); return false; }
								
								return confirm('Are you sure you want to add corporate user ?');
							}
							</script>
							
							<form name='frmCorp' method="post" action="" enctype="multipart/form-data" onsubmit='return validFrms()' style='margin-bottom:0px;' >
							
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="name" class="form-control" minlength=3 maxlength=50 value="" placeholder="Company Name *" required>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="email" name="email" class="form-control" minlength=3 maxlength=50 value="" placeholder="Company Email *" required>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="mobile" class="form-control" minlength=11 maxlength=11 value="" placeholder="Contact Mobile *" pattern="01[3-9]{1}[0-9]{8}" required>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="address" class="form-control" minlength=3 maxlength=100 value="" placeholder="Address *" required>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="row clearfix">
								<div class="form-group">
									<select name='location' class="form-control show-tick">
										<option value="">-- Please select --</option><option>Dhaka</option><option>Chittagong</option><option>Rajshahi</option><option>Khulna</option><option>Barishal</option><option>Sylhet</option><option>Rangpur</option><option>Mymensingh</option>
									</select>
								</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="vdealer" class="form-control" maxlength=50 value="" placeholder="Verified Dealer of">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="password" name="pass1" class="form-control" minlength='8' maxlength=20 value="" placeholder="Enter Password *" required>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="password" name="pass2" class="form-control" minlength='8' maxlength=20 value="" placeholder="Re-Enter Password *" required>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										Logo *<input type="file" name="file1" id="file1" class="form-control" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp" title="Company Logo *" required>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line-XXX">
										<input type='submit' name='submitRegister' value='REGISTER' class="btn bg-green btn-lg waves-effect">
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
