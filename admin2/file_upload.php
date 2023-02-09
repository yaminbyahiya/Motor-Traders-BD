<?php
require_once("files/common_top.php");
require_once("files/session.php");
?>

<!DOCTYPE html>
<html>
<head>
	<?php require_once("files/head.php"); ?>
	<link href="css/all-themes.css" rel="stylesheet" />
	<!-- Dropzone Css -->
    <link href="plugins/dropzone/dropzone.css" rel="stylesheet">
	<title>Trade File Upload - BackOffice</title>
</head>

<body class="theme-blue">
	<?php require_once("files/page_loader.php"); ?>
    <?php require_once("files/top_bar.php"); ?>
    
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <?php require_once("files/left_bar.php"); ?>            
            <?php $menu = "file_upload"; require_once("menu.php"); ?>
			<?php require_once("files/footer_left.php"); ?>
        </aside>
        
        <?php require_once("files/right_bar.php"); ?>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
				
				<!-- File Upload | Drag & Drop OR With Click & Choose -->
				<div class="row clearfix">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="card">
							<div class="header">
								<h2>
									FILE UPLOAD - DRAG & DROP OR WITH CLICK & CHOOSE
									<small>ex. trades300919-dse.xml</small>
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
							<div class="body">
								<div id="dropzone">
									<form action="upload.php" id="FileUpload" class="dropzone" method="post" enctype="multipart/form-data">
										<div class="dz-message">
											<div class="drag-icon-cph">
												<i class="material-icons">touch_app</i>
											</div>
											<h3>Drop files here or click to upload.</h3>
											<!--<em>(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</em>-->
										</div>
										<div class="fallback">
											<input name="file" type="file" multiple />
										</div>
									</form>
								</div>
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
	<!-- Waves Effect Plugin Js -->
    <script src="js/waves.js"></script>
    <!-- Select Plugin Js -->
    <script src="js/bootstrap-select.js"></script>
    <!-- Slimscroll Plugin Js -->
    <script src="js/jquery.slimscroll.js"></script>
	<!-- Dropzone Plugin Js -->
    <script src="plugins/dropzone/dropzone.js"></script>
    <!-- Custom Js -->
    <script src="js/admin.js"></script>
	<script src="js/advanced-form-elements.js"></script>
    <!-- Demo Js -->
    <script src="js/demo.js"></script>
	
</body>
</html>
