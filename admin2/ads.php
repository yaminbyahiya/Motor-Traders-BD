<?php session_start();
require_once("files/common_top.php");
require_once("files/session.php");
$menu = "ads";
$submenu = "ads-list";

require_once('../files/dbcon.php');

if(isset($_POST['submitup']))
{
	//$c = $_POST['caption'];
	$t = date('ymdhis', $ts);
	
	$allowed = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'png12', 'png24', 'gif', 'bmp');
	
	if($_FILES["file1"]["error"] > 0) {}
	else {
		$filename = strtolower(substr($_FILES['file1']['name'],-15));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$target = "../files/jssor-slider/".$t.".jpg";
			move_uploaded_file($_FILES["file1"]["tmp_name"], $target) or exit();
		}
	}
	
	$sql2 = "insert into `$db`.`mt_ads` values (null, '$t', null, 'y', '$u', '$now', null, null);";
	mysqli_query($dbcon, $sql2) or die($sql2);
	
	mysqli_close($dbcon);
	?>
	<script type='text/javascript'>alert("Image uploaded."); window.location='ads.php';</script>
	<?php
}

if(isset($_POST['submitdel']))
{
	$id = $_POST['id'];
	$sql2 = "update `$db`.`mt_ads` set status='n', removedBy='$u', removedOn='$now' where id='$id';";
	mysqli_query($dbcon, $sql2) or die($sql2);
	?>
	<script type='text/javascript'>alert("Image removed.")</script>
	<?php
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
<title>Manage Ads - MT-ADMIN</title>
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
							Manage Ads
						</h2>
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
								
								return confirm('Are you sure you want to add ?');
							}
							</script>
							
							<form name='frmimgup' method="post" action="" enctype="multipart/form-data" onsubmit='return validFrms()' style='margin-bottom:0px;' >
							
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<label>Upload Image (980x380)</label> <input type="file" name="file1" id="file1" class="form-control" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp" required>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line-XXX">
										<input type='submit' name='submitup' value='SUBMIT' class="btn bg-green btn-lg waves-effect">
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
							Current Ads
						</h2>
					</div>
					<div class="body">
						<div class="row clearfix">
							<?php
							$i=1;
							$sql = "select * from `$db`.`mt_ads` where status='y' order by id desc limit 0,10;";
							$result = mysqli_query($dbcon, $sql) or die($sql);
							while($row = mysqli_fetch_array($result))
							{
								$id = $row['id'];
								?>
								<div class="col-sm-6">
									<form name="frmdel<?php echo $i; ?>" method='post' action="ads.php" onsubmit="return confirm('Are you sure you want to delete ?')">
										<?php echo $i; ?>. <img src="../files/jssor-slider/<?php echo $id; ?>.jpg" border=1 width=325 height=115>
										<input type='hidden' name='id' value="<?php echo $id; ?>">
										<input type='submit' name='submitdel' value="Delete">
									</form>
								</div>
								<?php
								$i++;
							}
							mysqli_free_result($result);

							mysqli_close($dbcon);
							?>
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
