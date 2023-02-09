<?php
require_once("files/common_top.php");
require_once("files/session.php");
?>

<!DOCTYPE html>
<html>
<head>
	<?php require_once("files/head.php"); ?>
	<link href="css/all-themes.css" rel="stylesheet" />
	<title>Home - BackOffice</title>
</head>

<body class="theme-blue">
    <?php require_once("files/page_loader.php"); ?>
    <?php require_once("files/top_bar.php"); ?>
    
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <?php require_once("files/left_bar.php"); ?>
            <?php $menu="process_trade_file"; require_once("menu.php"); ?>
			<?php require_once("files/footer_left.php"); ?>
        </aside>
        
        <?php require_once("files/right_bar.php"); ?>
    </section>

    <section class="content">
        <div class="container-fluid">
			
			<!-- Striped Rows -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Process Trade Files
                                <small>Click <code>PROCESS</code> button to start file processing.</small>
                            </h2>
							<!--
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
							-->
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
										<th>ID</th>
                                        <th>FILE NAME</th>
                                        <th>UPLOAD BY</th>
                                        <th>UPLOAD ON</th>
										<th>-</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									$i = 0;
									require_once("files/dbcon.php");
									$sql = "select * from `$db`.`file_upload` where processBy is NULL or processOn is NULL order by sl desc limit 0,10;";
									$r = mysql_query($sql, $dbcon) or die($sql);
									while($row = mysql_fetch_array($r))
									{
										$i++;
										echo "<tr>
											<th scope='row'>$row[0]</th>
											<td>$row[1]</td>
											<td>$row[2]</td>
											<td>$row[3]</td>
											<td>".date('D, d-M-Y, h:i:sa', strtotime($row[4]))."</td>
											<td>
												<form id='frm$row[1]' name='frm$row[1]' method='POST' action='process_trade_file_step2.php' onsubmit='return confirm(\"Are you sure to process this file ?\");'>
												<input type='hidden' name='sl' value='$row[0]'>
												<input type='hidden' name='ts' value='$row[1]'>
												<input type='hidden' name='file' value='$row[2]'>
												<button type='submit' name='submitProcess' class='btn btn-primary waves-effect'>PROCESS</button>
												</form>
											</td>
										</tr>";
									}
									mysql_close($dbcon);
									?>
                                </tbody>
                            </table>
							
							<?php
							if($i==0) {
								echo "<small>No file found for processing.</small>";
							}
							?>
							
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Striped Rows -->
        </div>
    </section>

    <!-- Jquery Core Js -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap Core Js -->
    <script src="js/bootstrap.js"></script>
	<!-- Waves Effect Plugin Js -->
    <script src="js/waves.js"></script>
    <!-- Select Plugin Js -->
    <script src="js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="js/jquery.slimscroll.js"></script>
    <!-- Custom Js -->
    <script src="js/admin.js"></script>
    <!-- Demo Js -->
    <script src="js/demo.js"></script>
	
</body>
</html>
