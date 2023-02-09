<?php session_start();
require_once("files/common_top.php");
require_once("files/session.php");
$menu = "txn";
$submenu = "txn-success";

if(isset($_REQUEST['result'])) { $result = $_REQUEST['result']; $submenu = strtolower("txn-".$result); }
else { $result = "SUCCESS"; }

if(isset($_POST['submit']))
{
	$uid = $_POST['uid'];
	$dt = $_POST['dt'];
	$invid = $_POST['invid'];
	
	$result = "";
	if($uid!="") { $result.= " and t1.userid='$uid'"; }
	if($dt!="") { $result.= " and t2.result_dt like '$dt%'"; }
	if($invid!="") { $result.= " and t1.invid like '%$invid%'"; }
	$resultTxt = "Search Filter";
}
else
{
	$resultTxt = $result;
	$result = " and t2.result='$result'";
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
<title>Transactions - MT-ADMIN</title>
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
							TRANSACTIONS - <?php echo $resultTxt; ?>
						</h2>
					</div>
					<div class="body">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th>SL</th>
										<th>User ID / Email</th>
										<th>Inv. ID</th>
										<th>Trxn. ID</th>
										<th>Trxn. Type</th>
										<th>Qty</th>
										<th>Amount</th>
										<th>Time</th>
										<th>Result</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>SL</th>
										<th>User ID / Email</th>
										<th>Inv. ID</th>
										<th>Trxn. ID</th>
										<th>Trxn. Type</th>
										<th>Qty</th>
										<th>Amount</th>
										<th>Time</th>
										<th>Result</th>
									</tr>
								</tfoot>
								<tbody>
									<?php
									require('../files/dbcon.php');

									$i = 0;
									$sql = "select t1.userid, t1.invid, t1.txntype, t1.title, t1.qty, t1.amount, t2.tran_id, t2.result, t2.result_dt from `$db`.`mt_transaction_log` t1, `$db`.`mt_tran_ssl_log` t2 where t1.invid=t2.invid and t1.userid=t2.userid".$result." order by t2.result_dt desc limit 0,30;";
									$r = mysqli_query($dbcon, $sql) or die($sql);
									while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
									{
										echo "<tr><td>".++$i."</td>
										<td>".$row['userid']."</td>
										<td>".$row['invid']."</td>
										<td>".$row['tran_id']."</td>
										<td>".$row['txntype']." - ".$row['title']."</td>
										<td align=right>".$row['qty']."</td>
										<td align=right>".$row['amount']."</td>
										<td>".$row['result_dt']."</td>
										<td>".$row['result']."</td>";
										echo "</tr>";
									}

									mysqli_close($dbcon);
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
