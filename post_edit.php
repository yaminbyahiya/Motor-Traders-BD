<?php session_start();
require('files/session.php');
if($u!="" && $session==true) {} else { die("<script>window.location='index.php?lang=En';</script>"); }

if(isset($_POST['submitEdit']))
{
	//die("<h1>HELO</h1>");
	require('files/dbcon.php');

	$brand = $_POST['brand'];
	$model = $_POST['model'];
	$modelyr = $_POST['modelyr'];
	$regyr = $_POST['regyr'];
	$condition = $_POST['condition'];
	$type = $_POST['type'];
	$trans = $_POST['trans'];
	$fueltype = $_POST['fueltype'];
	$mileage = $_POST['mileage'];				$mileage = preg_replace("([^0-9])", "", $mileage);		if($mileage=="") { $mileage = 0; }
	$color = $_POST['color'];					$color = preg_replace("([^A-Za-z. -])", "", $color);
	$engcap = $_POST['engcap'];					$engcap = preg_replace("([^0-9])", "", $engcap);
	$door = $_POST['door'];
	$seats = $_POST['seats'];
	$papers = $_POST['papers'];
	$location = $_POST['location'];
	$price = $_POST['price'];					$price = preg_replace("([^0-9])", "", $price);			if($price=="") { $price = 0; }
	//$whtCar = $_POST['whtCar'];				$whtCar = preg_replace("([^A-Za-z0-9., -()])", "", $whtCar);
	
	$uname = $_POST['uname'];					$uname = preg_replace("([^A-Za-z. -])", "", $uname);
	$uemail = $_POST['uemail'];					$uemail = preg_replace("([^a-z0-9@.-_])", "", strtolower($uemail));
	$umobile = $_POST['umobile'];				$umobile = preg_replace("([^0-9])", "", $umobile);
	$umsg = $_POST['umsg'];						//$umsg = preg_replace("([^A-Za-z0-9. -,?/;:])", "", $umsg);
	$umsg = str_replace("\r", "", $umsg);		$umsg = str_replace("\n", "<br>", $umsg);
	
	//$pid = $uts.date('YmdHis', $ts);
	$pid = $_POST['pid'];
	
	//BACKUP OLD INFO
	$sql = "insert into `$db`.`mt_sell_car_edit_log` (select NULL, t2.* from `$db`.`mt_sell_car` t2 where t2.pid='$pid' and t2.userid='$u');";
	mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon));
	
	//UPDATE CMD
	$sql = "update `$db`.`mt_sell_car` set regyr='$regyr', trans='$trans', fueltype='$fueltype', mileage='$mileage', modelyr='$modelyr', conditions='$condition', type='$type', engcap='$engcap', door='$door', seats='$seats', papers='$papers', location='$location', color='$color', price='$price', seller_name='$uname', seller_email='$uemail', seller_mobile='$umobile', seller_msg='$umsg', status='n', verifyBy=NULL, verifyOn=NULL where pid='$pid' and userid='$u';";
	//echo $sql;
	mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon));
	
	mysqli_close($dbcon);
	
	//email
	if(file_get_contents("files/location.txt")=="server")
	{
		$email = $ue; 	//from session.php
		
		require('emails/post_submit.php');
	}
	
	die("<script>alert('Your post was submitted and pending for approval.'); window.location='profile.php';</script>");
}
elseif(isset($_REQUEST['pid'])) { $pid = $_REQUEST['pid']; }
else { die("<script>window.location='profile.php';</script>"); }

require('files/ts.php');
require('files/dbcon.php');

$found = false;
$sql = "select * from `$db`.`mt_sell_car` where status in ('y', 'n') and pid='$pid' and userid='$u';";
$r = mysqli_query($dbcon, $sql) or die("$sql");
while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
{
	$found = true;
	
	$brand = $row['brand'];
	$regyr = $row['regyr'];
	$trans = $row['trans'];
	$fueltype = $row['fueltype'];
	$mileage = $row['mileage'];
	$model = $row['model'];
	$modelyr = $row['modelyr'];
	$condition = $row['conditions'];
	$type = $row['type'];
	$engcap = $row['engcap'];
	$door = $row['door'];
	$seats = $row['seats'];
	$papers = $row['papers'];
	$location = $row['location'];
	$color = $row['color'];
	$price = $row['price'];
	
	$seller_name = $row['seller_name'];
	$seller_email = $row['seller_email'];
	$seller_mobile = $row['seller_mobile'];
	$seller_msg = $row['seller_msg'];
	
	$mark = $row['marksold'];
	$hide = $row['hidepost'];
	$clicked = $row['clicked'];
	$createdOn = $row['createdOn'];
	$uid = $row['userid'];
	$status = $row['status'];
}

if($found==false) { mysql_close($dbcon); die("<script>window.location='profile.php';</script>"); }
?>

<!DOCTYPE html>
<html>
<head>
<?php require('files/head.php'); ?>
</head>

<body>
<div class="page-wrapper">
 	
    <!-- Preloader -->
    <div class="preloader"></div>
 	
    <?php $menu='post'; require('files/header.php'); ?>
	
	<!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/buy-car.jpg);">
        <div class="auto-container">
            <h1 style="color : #000000">Sell A Car</h1>
        </div>
    </section>
    <!--End Page Title-->

    <!--Page Info-->
    <section class="page-info">
        <div class="auto-container">
            <ul class="bread-crumb">
                <li><a href="index.php?lang=En">Home</a></li>
                <li>Pages</li>
                <li class="current">Sell A Car</li>
            </ul>
        </div>
    </section>
    <!--End Page Info-->
    
    <!--Register Section-->
    <section class="register-section">
        <div class="auto-container">
            <div class="sec-title">
            	<h2>New Post (Sell A Car)</h2>
                <div class="text">Interested in selling us your vehicle? Simply enter in the vehicle information below along with your contact information and we will contact you shortly. Fields marked with (*) are required.</div>
            </div>
			
			<div class="row clearfix">
				
				<script>
				<?php require('files/vehicles.txt'); ?>
				
				function validFrmPostSubmit()
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
						
						var fileSize = fileInput.files[0].size / 1024 / 1024; 	/* in MiB */
						if(fileSize > 3) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 3 MB. Please select image file less than 3MB size.");
							return false;
						}
					}
					
					var fileInput = document.getElementById("file2");
					if(fileInput.files.length == 0) {}						/* no file selected */
					else {
						var file = fileInput.files[0].name;
						var fileName = file.toLowerCase();
						var fileExt = '.' + fileName.split('.').pop();
						if(!fileExt.match(reg))
						{
							alert("Invalid file '"+fileName+"' selected. Please select image file extension with *.jpg|JPG|jpeg|JPEG|png|png12|png24|gif|bmp.");
							return false;
						}
						
						var fileSize = fileInput.files[0].size / 1024 / 1024; 	/* in MiB */
						if(fileSize > 3) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 3 MB. Please select image file less than 3MB size.");
							return false;
						}
					}
					
					var fileInput = document.getElementById("file3");
					if(fileInput.files.length == 0) {}						/* no file selected */
					else {
						var file = fileInput.files[0].name;
						var fileName = file.toLowerCase();
						var fileExt = '.' + fileName.split('.').pop();
						if(!fileExt.match(reg))
						{
							alert("Invalid file '"+fileName+"' selected. Please select image file extension with *.jpg|JPG|jpeg|JPEG|png|png12|png24|gif|bmp.");
							return false;
						}
						
						var fileSize = fileInput.files[0].size / 1024 / 1024; 	/* in MiB */
						if(fileSize > 3) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 3 MB. Please select image file less than 3MB size.");
							return false;
						}
					}
					
					var fileInput = document.getElementById("file4");
					if(fileInput.files.length == 0) {}						/* no file selected */
					else {
						var file = fileInput.files[0].name;
						var fileName = file.toLowerCase();
						var fileExt = '.' + fileName.split('.').pop();
						if(!fileExt.match(reg))
						{
							alert("Invalid file '"+fileName+"' selected. Please select image file extension with *.jpg|JPG|jpeg|JPEG|png|png12|png24|gif|bmp.");
							return false;
						}
						
						var fileSize = fileInput.files[0].size / 1024 / 1024; 	/* in MiB */
						if(fileSize > 3) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 3 MB. Please select image file less than 3MB size.");
							return false;
						}
					}
					
					var fileInput = document.getElementById("file5");
					if(fileInput.files.length == 0) {}						/* no file selected */
					else {
						var file = fileInput.files[0].name;
						var fileName = file.toLowerCase();
						var fileExt = '.' + fileName.split('.').pop();
						if(!fileExt.match(reg))
						{
							alert("Invalid file '"+fileName+"' selected. Please select image file extension with *.jpg|JPG|jpeg|JPEG|png|png12|png24|gif|bmp.");
							return false;
						}
						
						var fileSize = fileInput.files[0].size / 1024 / 1024; 	/* in MiB */
						if(fileSize > 3) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 3 MB. Please select image file less than 3MB size.");
							return false;
						}
					}
					
					var fileInput = document.getElementById("file6");
					if(fileInput.files.length == 0) {}						/* no file selected */
					else {
						var file = fileInput.files[0].name;
						var fileName = file.toLowerCase();
						var fileExt = '.' + fileName.split('.').pop();
						if(!fileExt.match(reg))
						{
							alert("Invalid file '"+fileName+"' selected. Please select image file extension with *.jpg|JPG|jpeg|JPEG|png|png12|png24|gif|bmp.");
							return false;
						}
						
						var fileSize = fileInput.files[0].size / 1024 / 1024; 	/* in MiB */
						if(fileSize > 3) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 3 MB. Please select image file less than 3MB size.");
							return false;
						}
					}
					
					var fileInput = document.getElementById("file7");
					if(fileInput.files.length == 0) {}						/* no file selected */
					else {
						var file = fileInput.files[0].name;
						var fileName = file.toLowerCase();
						var fileExt = '.' + fileName.split('.').pop();
						if(!fileExt.match(reg))
						{
							alert("Invalid file '"+fileName+"' selected. Please select image file extension with *.jpg|JPG|jpeg|JPEG|png|png12|png24|gif|bmp.");
							return false;
						}
						
						var fileSize = fileInput.files[0].size / 1024 / 1024; 	/* in MiB */
						if(fileSize > 3) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 3 MB. Please select image file less than 3MB size.");
							return false;
						}
					}
					
					var fileInput = document.getElementById("file8");
					if(fileInput.files.length == 0) {}						/* no file selected */
					else {
						var file = fileInput.files[0].name;
						var fileName = file.toLowerCase();
						var fileExt = '.' + fileName.split('.').pop();
						if(!fileExt.match(reg))
						{
							alert("Invalid file '"+fileName+"' selected. Please select image file extension with *.jpg|JPG|jpeg|JPEG|png|png12|png24|gif|bmp.");
							return false;
						}
						
						var fileSize = fileInput.files[0].size / 1024 / 1024; 	/* in MiB */
						if(fileSize > 3) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 3 MB. Please select image file less than 3MB size.");
							return false;
						}
					}
					
					var fileInput = document.getElementById("file9");
					if(fileInput.files.length == 0) {}						/* no file selected */
					else {
						var file = fileInput.files[0].name;
						var fileName = file.toLowerCase();
						var fileExt = '.' + fileName.split('.').pop();
						if(!fileExt.match(reg))
						{
							alert("Invalid file '"+fileName+"' selected. Please select image file extension with *.jpg|JPG|jpeg|JPEG|png|png12|png24|gif|bmp.");
							return false;
						}
						
						var fileSize = fileInput.files[0].size / 1024 / 1024; 	/* in MiB */
						if(fileSize > 3) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 3 MB. Please select image file less than 3MB size.");
							return false;
						}
					}
					
					var fileInput = document.getElementById("file10");
					if(fileInput.files.length == 0) {}						/* no file selected */
					else {
						var file = fileInput.files[0].name;
						var fileName = file.toLowerCase();
						var fileExt = '.' + fileName.split('.').pop();
						if(!fileExt.match(reg))
						{
							alert("Invalid file '"+fileName+"' selected. Please select image file extension with *.jpg|JPG|jpeg|JPEG|png|png12|png24|gif|bmp.");
							return false;
						}
						
						var fileSize = fileInput.files[0].size / 1024 / 1024; 	/* in MiB */
						if(fileSize > 3) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 3 MB. Please select image file less than 3MB size.");
							return false;
						}
					}
					
					var fileInput = document.getElementById("fileMT");
					if(fileInput.files.length == 0) {}						/* no file selected */
					else {
						var file = fileInput.files[0].name;		
						var fileName = file.toLowerCase();
						var fileExt = '.' + fileName.split('.').pop();
						if(!fileExt.match(reg))
						{
							alert("Invalid file '"+fileName+"' selected. Please select image file extension with *.jpg|JPG|jpeg|JPEG|png|png12|png24|gif|bmp.");
							return false;
						}
						
						var fileSize = fileInput.files[0].size / 1024 / 1024; 	/* in MiB */
						if(fileSize > 3) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 3 MB. Please select image file less than 3MB size.");
							return false;
						}
					}
					
					return confirm('Are you sure you want to add post ?');
				}
				
				var digit = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
				function ChrCheck2(evnt, match) {
					var key = evnt.charCode ? evnt.charCode : event.keyCode;
					if (key>=48 && key<=57) { return true; }
					else { return false; }
				}
				</script>
				
				<form name='frmPost' method="post" action="post_edit.php" enctype="multipart/form-data" onsubmit='return validFrmPostSubmit()'>
				
				<!--Sell Car Form-->
				<div class="sell-car-form">
					<h2>Vehicle Information</h2>
					<div class="form-box">
						<div class="row clearfix">

							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Brand</label>
								<input type="text" name="brand" maxlength=50 value="<?php echo $brand; ?>" readonly>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Model</label>
								<input type="text" name="model" maxlength=50 value="<?php echo $model; ?>" readonly>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Model Year</label>
								<select name='modelyr'><?php for($i=$yr; $i>=$yr-40; $i--) { echo "<option"; if($modelyr==$i) { echo " selected"; } echo ">$i</option>"; } ?></select>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Registration Year</label>
								<select name='regyr'><option value=0>Unregistered</option><?php for($i=$yr; $i>=$yr-40; $i--) { echo "<option"; if($regyr==$i) { echo " selected"; } echo ">$i</option>"; } ?></select>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Condition</label>
								<select name='condition'><option>Used</option><option <?php if($condition=="New") { echo " selected"; } ?>>New</option></select>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Type</label>
								<select name='type'><option <?php if($type=="Sedan") { echo "selected"; } ?>>Sedan</option><option <?php if($type=="Hatch") { echo "selected"; } ?>>Hatch</option><option <?php if($type=="Wagon") { echo "selected"; } ?>>Wagon</option><option <?php if($type=="Microbus") { echo "selected"; } ?>>Microbus</option><option <?php if($type=="SUV/Crossover") { echo "selected"; } ?>>SUV/Crossover</option><option <?php if($type=="Pickup") { echo "selected"; } ?>>Pickup</option><option <?php if($type=="Sports") { echo "selected"; } ?>>Sports</option><option <?php if($type=="Bus/Truck/Commercial") { echo "selected"; } ?>>Bus/Truck/Commercial</option><option <?php if($type=="Convertible") { echo "selected"; } ?>>Convertible</option></select>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Transmission</label>
								<select name='trans'><option <?php if($trans=="Automatic") { echo "selected"; } ?>>Automatic</option><option <?php if($trans=="Semi-Automatic") { echo "selected"; } ?>>Semi-Automatic</option><option <?php if($trans=="Manual") { echo "selected"; } ?>>Manual</option></select>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Fuel Type</label>
								<select name='fueltype'><option <?php if($fueltype=="Octane") { echo "selected"; } ?>>Octane</option><option <?php if($fueltype=="Octane(Hybrid)") { echo "selected"; } ?>>Octane(Hybrid)</option><option <?php if($fueltype=="Petrol") { echo "selected"; } ?>>Petrol</option><option <?php if($fueltype=="Diesel") { echo "selected"; } ?>>Diesel</option><option <?php if($fueltype=="Diesel(Hybrid)") { echo "selected"; } ?>>Diesel(Hybrid)</option><option <?php if($fueltype=="CNG") { echo "selected"; } ?>>CNG</option><option <?php if($fueltype=="LPG") { echo "selected"; } ?>>LPG</option></select>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Mileage</label>
								<input type="text" name="mileage" maxlength=50 value="<?php echo $mileage; ?>" placeholder="type 0 or leave empty if undisclosed" pattern="[0-9]{0,}">
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Color</label>
								<input type="text" name="color" maxlength=50 value="<?php echo $color; ?>" placeholder="Enter Color Details *" pattern="[A-Z a-z]{3,}" required>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Engine Capacity</label>
								<input type="text" name="engcap" maxlength=50 value="<?php echo $engcap; ?>" placeholder="Enter Engine Capacity *" onkeypress="return ChrCheck2(event, digit)" required>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Doors</label>
								<select name='door'><?php for($i=1; $i<=5; $i++) { echo "<option"; if($door==$i) { echo " selected"; } echo ">$i</option>"; } ?></select>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Seats</label>
								<select name='seats'><?php for($i=1; $i<=15; $i++) { echo "<option"; if($seats==$i) { echo " selected"; } echo ">$i</option>"; } ?></select>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Papers & Documents</label>
								<select name='papers'><option <?php if($papers=="None") { echo "selected"; } ?>>None</option><option <?php if($papers=="Up to Date") { echo "selected"; } ?>>Up to Date</option><option <?php if($papers=="Failed") { echo "selected"; } ?>>Failed</option></select>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Location</label>
								<select name='location'><option <?php if($location=="Dhaka") { echo "selected"; } ?>>Dhaka</option><option <?php if($location=="Chittagong") { echo "selected"; } ?>>Chittagong</option><option <?php if($location=="Rajshahi") { echo "selected"; } ?>>Rajshahi</option><option <?php if($location=="Khulna") { echo "selected"; } ?>>Khulna</option><option <?php if($location=="Barishal") { echo "selected"; } ?>>Barishal</option><option <?php if($location=="Sylhet") { echo "selected"; } ?>>Sylhet</option><option <?php if($location=="Rangpur") { echo "selected"; } ?>>Rangpur</option><option <?php if($location=="Mymensingh") { echo "selected"; } ?>>Mymensingh</option></select>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Price</label>
								<input type="text" name="price" maxlength=50 value="<?php echo $price; ?>" placeholder="type 0 or leave empty if undisclosed" pattern="[0-9]{0,}">
							</div>
						</div>
					</div>
				</div>
				<!--End Cell Car Form-->
				
				<!--Cell Car Form-->
				<div class="sell-car-form">
					<h2>Contact Information</h2>
					<div class="form-box">
						<div class="row clearfix">
							<div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
								<label>Name *</label>
								<input type="text" name="uname" maxlength=50 value="<?php echo $un; ?>" placeholder="Enter Name *" required>
							</div>
							<div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
								<label>Email *</label>
								<input type="email" name="uemail" maxlength=50 value="<?php echo $ue; ?>" placeholder="Enter Email *" required>
							</div>
							<div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
								<label>Phone *</label>
								<input type="text" name="umobile" maxlength=50 value="<?php echo $um; ?>" placeholder="Enter Mobile *" pattern="01[3-9]{1}[0-9]{8}" required>
							</div>
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<label>Brief Description</label>
								<textarea id="umsg" name='umsg' placeholder=""><?php echo $seller_msg; ?></textarea>
							</div>
						</div>
					</div>
				</div>
				<!--End Cell Car Form-->

				<div class="form-column column col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="styled-form">
						<div class="form-group" style='text-align:center;'>
							<input type='hidden' name='pid' value='<?php echo $pid; ?>'>
							<input type='submit' name='submitEdit' id="submitEdit" value='SUBMIT' class="theme-btn btn-style-one">
						</div>
					</div>
				</div>
				
				</form>
                
            </div>
        </div>
    </section>
    <!--End Register Section-->
    
    <?php require('files/footer.php'); ?>
    
</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-up"></span></div>

<script src="js/jquery.js"></script> 
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>
<script src="js/owl.js"></script>
<script src="js/appear.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/wow.js"></script>
<script src="js/script.js"></script>

<script src="https://cdn.tiny.cloud/1/2dv442zvorgjmm0ch04e8stic3aceud5p4pj7nrmcu035mg1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
  selector: 'textarea#umsg',
  height: 300,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount'
  ],
  toolbar: 'undo redo | formatselect | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
function getStats(id) {
    var body = tinymce.get(id).getBody(), 
    text = tinymce.trim(body.innerText || body.textContent);

    return {
        chars: text.length,
        words: text.split(/[\w\u2019\'-]+/).length
    };
}
function submitForm() {
    // Check if the user has entered less than 1000 characters
    if (getStats('content').chars > 50000) {
        alert("You need to enter 1000 characters or more.");
        return;
    }

    // Submit the form
    document.forms[0].submit();
}
</script>

</body>
</html>
