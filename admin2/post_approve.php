<?php session_start();
require_once("files/common_top.php");
require_once("files/session.php");
$menu = "posts";
$submenu = "post-approve";

if(isset($_POST['submitApprove']) && isset($_POST['pid']) && isset($_POST['userid']))
{
	$pid = $_POST['pid'];
	$userid = $_POST['userid'];
	
	require('../files/dbcon.php');
	
	$sql = "update `$db`.`mt_sell_car` set status='y', verifyBy='$u', verifyOn='$now' where userid='$userid' and pid='$pid' and status='n';";
	mysqli_query($dbcon, $sql) or die($sql);

	//email
	if(file_get_contents("../files/location.txt")=="server")
	{
		$sql = "select name, email from `$db`.`mt_users_pass` where userid='$userid';";
		$r = mysqli_query($dbcon, $sql) or die("$sql");
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
		{
			$name = $row[0];
			$email = $row[1];
			
			require('../emails/post_approve_admin.php');
		}
	}
	
	mysqli_close($dbcon);
	
	die("<script>window.location='post_approve.php';</script>");
}
elseif(isset($_POST['submitDeny']) && isset($_POST['pid']) && isset($_POST['userid']))
{
	$pid = $_POST['pid'];
	$userid = $_POST['userid'];
	
	require('../files/dbcon.php');
	
	$sql = "update `$db`.`mt_sell_car` set status='d', verifyBy='$u', verifyOn='$now' where userid='$userid' and pid='$pid' and status='n';";
	mysqli_query($dbcon, $sql) or die($sql);

	//email
	
	mysqli_close($dbcon);
	
	die("<script>window.location='post_approve.php';</script>");
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once("files/head.php"); ?>
<!-- JQuery DataTable Css -->
<link href="plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="css/all-themes.css" rel="stylesheet">
<title>Post Approve - MT-ADMIN</title>
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
							Post Approve
						</h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<i class="material-icons">more_vert</i>
								</a>
								<ul class="dropdown-menu pull-right">
									<li><a href="javascript:void(0);">Action</a></li>
									<li><a href="javascript:void(0);">Another action</a></li>
									<li><a href="javascript:void(0);">Something else here</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th>SL</th>
										<th>User ID / Email</th>
										<th>Post ID</th>
										<th>Brand / Model</th>
										<th>Submit On</th>
										<th>-</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>SL</th>
										<th>User ID / Email</th>
										<th>Post ID</th>
										<th>Brand / Model</th>
										<th>Submit On</th>
										<th>-</th>
									</tr>
								</tfoot>
								<tbody>
									<?php
									require_once('../files/dbcon.php');
									
									$i = 0;
									$sql = "select * from `$db`.`mt_sell_car` where status='n' order by sl;";
									$r = mysqli_query($dbcon, $sql) or die($sql);
									while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
									{
										echo "<tr><td>".++$i."</td><td>".$row['userid']."</td><td><a target='_blank' href='../vehicle_details.php?pid=".$row['pid']."'>".$row['pid']."</a></td><td>".$row['brand']." - ".$row['model']."</td><td>".$row['createdOn']."</td>";
										echo "<td><form name='frm$i' method='post' action='post_approve.php' style='margin-bottom:0px;' onsubmit='return confirm(\"Are you sure ?\")'><input type='submit' name='submitApprove' value='Approve'><input type='submit' name='submitDeny' value='Deny'><input type='hidden' name='pid' value='".$row['pid']."'><input type='hidden' name='userid' value='".$row['userid']."'></form></td></tr>";
									}
									?>
								</tbody>
							</table>
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
<!-- Jquery DataTable Plugin Js -->
<script src="plugins/jquery-datatable/jquery.dataTables.js"></script>
<script src="plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script src="plugins/jquery-datatable/jquery-datatable.js"></script>
<!-- Custom Js -->
<script src="js/admin.js"></script>
<!-- Demo Js -->
<script src="js/demo.js"></script>

</body>
</html>
