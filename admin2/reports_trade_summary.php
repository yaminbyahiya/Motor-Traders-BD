<?php
require_once("files/common_top.php");
require_once("files/session.php");

require_once("files/dbcon.php");

$selectDt = date('l d F Y', $ts);
?>

<!DOCTYPE html>
<html>
<head>
	<?php require_once("files/head.php"); ?>
	<!-- Bootstrap Material Datetime Picker Css -->
    <link href="plugins/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <!-- Bootstrap Select Css -->
    <link href="plugins/bootstrap-select/bootstrap-select.css" rel="stylesheet" />
    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
	<link href="css/all-themes.css" rel="stylesheet" />
	<title>BackOffice</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body class="theme-blue">
    <?php require_once("files/page_loader.php"); ?>
    <?php require_once("files/top_bar.php"); ?>
    
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <?php require_once("files/left_bar.php"); ?>
            <?php $menu="reports"; require_once("menu.php"); ?>
			<?php require_once("files/footer_left.php"); ?>
        </aside>
        
        <?php require_once("files/right_bar.php"); ?>
    </section>

    <section class="content">
        <div class="container-fluid">
			
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Trade Summary Report
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix" style="margin-bottom:0px;">
								<script>
								function fnBOload(dt)
								{
								}
								function xxxxxfnBOload(dt)
								{
									var tmp = dt.split(" ");
									var d = tmp[1];
									var m = tmp[2];
									var y = tmp[3];
									if(m=='January') { m='01'; } else if(m=='February') { m='02'; } else if(m=='March') { m='03'; }
									else if(m=='April') { m='04'; } else if(m=='May') { m='05'; } else if(m=='June') { m='06'; }
									else if(m=='July') { m='07'; } else if(m=='August') { m='08'; } else if(m=='September') { m='09'; }
									else if(m=='October') { m='10'; } else if(m=='November') { m='11'; } else if(m=='December') { m='12'; }
									
									var select = document.getElementById("boid");
									var length = select.options.length;
									for(i=0; i<length; i++) { select.options[i] = null; }
									for(i=0; i<10; i++) { select.options[i] = new Option(i, i); }
									
									/*
									$.ajax({
										url: 'ajax/load_bo_by_dt.php?y='+y+'&m='+m+'&d='+d,
										data: "",
										dataType: 'json',
										success: function(data)
										{
											
											var select = document.getElementById("boid");
											var length = select.options.length;
											for(i=0; i<length; i++) { select.options[i] = null; }
											
											var len = data.length;
											for(i=0; i<len; i++) { select.options[i] = new Option(i, i); }
										}
									});
									*/
									alert('done');
								}
								</script>
								
								<form name="frmTrdDummary" method="POST" action="reports_trade_summary_print.php" target='_blank'>
								<div class="col-sm-4" style="margin-bottom:0px;">
                                    <div class="form-group" style="margin-bottom:0px;">
                                        <div class="form-line">
                                            <input type="text" name='date' class="datepicker form-control" style="cursor:pointer;" value="<?php echo $selectDt; ?>" placeholder="Please choose a date..." onchange='fnBOload(this.value)' required>
                                        </div>
                                    </div>
                                </div>
                                <!--
								<div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="timepicker form-control" placeholder="Please choose a time...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="datetimepicker form-control" placeholder="Please choose date & time...">
                                        </div>
                                    </div>
                                </div>
								-->
								<div class="col-sm-4" style="margin-bottom:0px;">
									<select id='boid' name='boid' class="form-control show-tick" data-live-search="true" required>
									<?php
									$sql = "select distinct(ClientCode) from `$db`.`trades` order by ClientCode;";
									$r = mysql_query($sql, $dbcon) or die($sql);
									while($row = mysql_fetch_array($r)) {
										echo "<option>$row[0]</option>";
									}
									?>
									</select>
                                </div>
								<div class="col-sm-4" style="margin-bottom:0px;">
									<button type='submit' name='submit' class='btn btn-primary waves-effect'>SUBMIT</button>
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
    <!-- Bootstrap Material Datetime Picker Plugin Js -->
    <script src="plugins/bootstrap-material-datetimepicker/bootstrap-material-datetimepicker.js"></script>
    <!-- Custom Js -->
    <script src="js/admin.js"></script>
	<script src="js/basic-form-elements.js"></script>
	<script src="js/advanced-form-elements.js"></script>
    <!-- Demo Js -->
    <script src="js/demo.js"></script>
	
</body>
</html>

<?php
mysql_close($dbcon);
?>