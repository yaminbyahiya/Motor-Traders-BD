<?php session_start();
require_once("files/common_top.php");
require_once("files/session.php");
$menu = "users";
$submenu = "user-verify";

if(isset($_POST['submitVerify']) && isset($_POST['uid']) && isset($_POST['uts']))
{
	$uid = $_POST['uid'];
	$uts = $_POST['uts'];

	require('../files/dbcon.php');
	
	$sql = "update `$db`.`mt_users_nid` set status='y', verifyBy='$u', verifyOn='$now' where userid='$uid';";
	mysqli_query($dbcon, $sql) or die($sql);

	mysqli_close($dbcon);
	
	die("<script>window.location='user_verify.php';</script>");
}
elseif(isset($_POST['submitVerifyNo']) && isset($_POST['uid']) && isset($_POST['uts']))
{
	$uid = $_POST['uid'];
	$uts = $_POST['uts'];

	require('../files/dbcon.php');
	
	$sql = "update `$db`.`mt_users_nid` set status='d', verifyBy='$u', verifyOn='$now' where userid='$uid';";
	mysqli_query($dbcon, $sql) or die($sql);

	mysqli_close($dbcon);
	
	die("<script>window.location='user_verify.php';</script>");
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
<title>User Verify - MT-ADMIN</title>
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
							User Verify
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
										<th>NID Upload</th>
										<th>Front</th>
										<th>Back</th>
										<th>-</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>SL</th>
										<th>User ID / Email</th>
										<th>NID Upload</th>
										<th>Front</th>
										<th>Back</th>
										<th>-</th>
									</tr>
								</tfoot>
								<tbody>
									<?php
									require_once('../files/dbcon.php');
									
									$i = 0;
									$sql = "select t1.*, t2.ts from `$db`.`mt_users_nid` t1, `$db`.`mt_users_pass` t2 where t1.status='n' and t1.userid=t2.userid order by t1.sl;";
									$r = mysqli_query($dbcon, $sql) or die($sql);
									while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
									{
										echo "<tr><td>".++$i."</td><td>$row[1]</td><td>".$row['createdOn']."</td><td><a target=_blank href='../profile_pic/".$row['ts']."_".$row['nid1']."'><img src='images/nid_front.png' alt='NID 1'></td><td><a target=_blank href='../profile_pic/".$row['ts']."_".$row['nid2']."'><img src='images/nid_back.png' alt='NID 2'></td>";
										echo "<td><form name='frm$i' method=post action='user_verify.php' style='margin-bottom:0px;' onsubmit='return confirm(\"Are you sure ?\")'><input type=submit name='submitVerify' value='Verify Now'><input type=hidden name='uid' value='$row[1]'><input type=hidden name='uts' value='".$row['ts']."'></form></td>";
										echo "<td><form name='frm$i' method=post action='user_verify.php' style='margin-bottom:0px;' onsubmit='return confirm(\"Are you sure ?\")'><input type=submit name='submitVerifyNo' value='Deny User'><input type=hidden name='uid' value='$row[1]'><input type=hidden name='uts' value='".$row['ts']."'></form></td>";
										echo "</tr>";
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
