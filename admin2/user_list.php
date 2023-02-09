<?php session_start();
require_once("files/common_top.php");
require_once("files/session.php");
$menu = "users";
$submenu = "user-list";

require_once('../files/dbcon.php');
require_once('files/ts.php');

if((isset($_POST['submitBan']) || isset($_POST['submitTmpBan']) || isset($_POST['submitUnban'])) && isset($_POST['uid']) && isset($_POST['uts']))
{
	$uid = $_POST['uid'];
	$uts = $_POST['uts'];
	if(isset($_POST['submitBan'])) { $sub = 'b'; $dt = "9999-12-31 23:59:59"; }
	elseif(isset($_POST['submitTmpBan'])) { $sub = 't'; $dt = date('Y-m-d H:i:s', $ts+2*24*60*60); }
	else { $sub = 'y'; $dt = "1970-01-01 00:00:00"; }
	
	$rem = "-";
	
	$sql = "update `$db`.`mt_users_pass` set status='$sub' where ts='$uts' and userid='$uid';";
	mysqli_query($dbcon, $sql) or die($sql);
	
	$sl = fnRowID("mt_users_ban_log");
	$sql = "insert into `$db`.`mt_users_ban_log` values ('$sl', '$uid', '$uts', '$dt', '$sub', '$u', '$now', '$rem');";
	mysqli_query($dbcon, $sql) or die($sql);
	
	mysqli_close($dbcon);
	die("<script>window.location='user_list.php';</script>");
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
<title>Users List - MT-ADMIN</title>
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
							USER(S) LIST
						</h2>
					</div>
					<div class="body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th>SL</th>
										<th>User ID / Email</th>
										<th>Name / Mobile</th>
										<th>Location</th>
										<th>Register On</th>
										<th>NID</th>
										<th>Status</th>
										<th>-</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>SL</th>
										<th>User ID / Email</th>
										<th>Name / Mobile</th>
										<th>Location</th>
										<th>Register On</th>
										<th>NID</th>
										<th>Status</th>
										<th>-</th>
									</tr>
								</tfoot>
								<tbody>
									<?php
									$i = 0;
									$sql = "select t1.* from `$db`.`mt_users_pass` t1 where 1 order by t1.sl desc;";
									$r = mysqli_query($dbcon, $sql) or die($sql);
									while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
									{
										echo "<tr><td>".++$i."</td>
										<td>".$row['userid']."</td>
										<td>".$row['name']."<br>".$row['mobile']."</td>
										<td>".$row['location']."</td>
										<td>".$row['createdOn']."</td>
										<td><a target='_blank' href='nid_pic.php?ts=".$row['ts']."&uid=".$row['userid']."'><img src='images/nid_front.png' alt='NID'></a></td>";
										
										if($row['status']=='y') { echo "<td>OK</td>"; }
										elseif($row['status']=='t') { echo "<td>TEMP. BANNED</td>"; }
										elseif($row['status']=='b') { echo "<td>BANNED</td>"; }
										else { echo "<td>UNVERIFIED</td>"; }
										
										if($row['status']=='b' || $row['status']=='t') {
											echo "<td><form name='frm$i' method='post' action='' style='margin-bottom:0px;' onsubmit='return confirm(\"Are you sure you want to do that ?\");'>
											<input type='hidden' name='uid' value='".$row['userid']."'>
											<input type='hidden' name='uts' value='".$row['ts']."'>
											<input type='submit' name='submitUnban' value='Unban Now'>
											</form></td>";
										}
										else {
											echo "<td><form name='frm$i' method='post' action='' style='margin-bottom:0px;' onsubmit='return confirm(\"Are you sure you want to do that ?\");'>
											<input type='hidden' name='uid' value='".$row['userid']."'>
											<input type='hidden' name='uts' value='".$row['ts']."'>
											<input type='submit' name='submitBan' value='Ban Now'>
											<input type='submit' name='submitTmpBan' value='Temp. Ban Now'>
											</form></td>";
										}
										
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

<?php mysqli_close($dbcon); ?>

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
