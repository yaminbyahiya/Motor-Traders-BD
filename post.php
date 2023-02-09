<?php session_start();
require('files/session.php');
if($u!="" && $session==true) {} else { die("<script>window.location='index.php?lang=En';</script>"); }

require('files/ts.php');

if(isset($_POST['submitPost']))		//from profile.php
{
	require('files/dbcon.php');
	
	$sql = "select tokens from `$db`.`mt_users_pass` where userid='$u';";
	$r = mysqli_query($dbcon, $sql) or die($sql);
	$row = mysqli_fetch_array($r, MYSQLI_BOTH);
	$tokens = $row[0];
	
	/*
	$sql = "select count(pid) from `$db`.`mt_sell_car` where status in ('y', 'n') and userid='$u';";
	$r = mysqli_query($dbcon, $sql) or die($sql);
	$row = mysqli_fetch_array($r, MYSQLI_BOTH);
	$posts = $tokens - $row[0];
	*/
	
	mysqli_close($dbcon);
	
	if($tokens>0) {}
	else { die("alert('You can not submit another post due to limit crossed. Please buy token for submit post.'); window.location='profile.php';"); }
}
elseif(isset($_POST['submitNew']))
{
	require('files/dbcon.php');
	
	$sql = "select tokens from `$db`.`mt_users_pass` where userid='$u';";
	$r = mysqli_query($dbcon, $sql) or die($sql);
	$row = mysqli_fetch_array($r, MYSQLI_BOTH);
	$tokens = $row[0];
	
	/*
	$sql = "select count(pid) from `$db`.`mt_sell_car` where status='y' and userid='$u';";
	$r = mysqli_query($dbcon, $sql) or die($sql);
	$row = mysqli_fetch_array($r, MYSQLI_BOTH);
	$posts = $tokens - $row[0];
	*/
	//if($posts>0) {}
	
	if($tokens>0) {}
	else { mysqli_close($dbcon); die("<script>alert('You can not submit another post due to limit crossed. Please buy token for submit post.'); window.location='profile.php';</script>"); }
	
	$brand = $_POST['brand'];
	$regyr = $_POST['regyr'];
	$model = $_POST['model'];
	$modelyr = $_POST['modelyr'];
	$trans = $_POST['trans'];
	$fueltype = $_POST['fueltype'];
	$mileage = $_POST['mileage'];				$mileage = preg_replace("([^0-9])", "", $mileage);		if($mileage=="") { $mileage = 0; }
	$color = $_POST['color'];					$color = preg_replace("([^A-Za-z. -])", "", $color);
	$condition = $_POST['condition'];
	$type = $_POST['type'];
	$engcap = $_POST['engcap'];					$engcap = preg_replace("([^0-9])", "", $engcap);
	$door = $_POST['door'];
	$seats = $_POST['seats'];
	$papers = $_POST['papers'];
	$location = $_POST['location'];
	$price = $_POST['price'];					$price = preg_replace("([^0-9])", "", $price);			if($price=="") { $price = 0; }
	$whtCar = $_POST['whtCar'];					$whtCar = preg_replace("([^A-Za-z0-9., -()])", "", $whtCar);
	
	$uname = $_POST['uname'];					$uname = preg_replace("([^A-Za-z. -])", "", $uname);
	$uemail = $_POST['uemail'];					$uemail = preg_replace("([^a-z0-9@.-_])", "", strtolower($uemail));
	$umobile = $_POST['umobile'];				$umobile = preg_replace("([^0-9])", "", $umobile);
	$umsg = $_POST['umsg'];						//$umsg = preg_replace("([^A-Za-z0-9. -,?/;:])", "", $umsg);
	$umsg = str_replace("\r", "", $umsg);		$umsg = str_replace("\n", "<br>", $umsg);
	
	$pid = $uts.date('YmdHis', $ts);
	
	/* added later
	$sl = fnRowID("mt_sell_car");
	$sql = "insert into `$db`.`mt_sell_car` values ('$sl', '$pid', '$u', '$ut', '$brand', '$regyr', '$trans', '$fueltype', '$mileage', '$model', '$modelyr', '$condition', '$type', '$engcap', '$door', '$seats', '$papers', '$location', '$color', '$price', '$whtCar', null, null, null, null, '-', '$uname', '$uemail', '$umobile', '$umsg', 'n', 'n', 'n', '0', '$now', NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
	mysqli_query($dbcon, $sql) or die("$sql");
	
	$sql = "update `$db`.`mt_users_pass` set tokens=tokens-1 where userid='$u';";
	mysqli_query($dbcon, $sql) or die("$sql");
	*/
	
	function compress_image($source_url, $destination_url, $quality)
	{
		ini_set('memory_limit', '-1');
		$info = getimagesize($source_url);
		if($info['mime'] == 'image/jpeg') { $image = imagecreatefromjpeg($source_url); }
		elseif($info['mime'] == 'image/gif') { $image = imagecreatefromgif($source_url); }
		elseif($info['mime'] == 'image/png') { $image = imagecreatefrompng($source_url); }
		imagejpeg($image, $destination_url, $quality);
		//echo "Image uploaded successfully.";
	}
	
	//WATERMARK
	/*
	// Load the stamp and the photo to apply the watermark to
	$stamp = imagecreatefrompng("post_pic/wm.png");
	// Set the margins for the stamp and get the height/width of the stamp image
	$marge_right = 10;
	$marge_bottom = 10;
	$sx = imagesx($stamp);
	$sy = imagesy($stamp);
	*/
	
	$thumbnail = $_POST['thumb'];
	
	$allowed = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'png12', 'png24', 'gif', 'bmp');
	
	$thumb = "";
	if($_FILES["file1"]["error"] > 0) { $img1 = ""; }
	else {
		$filename = "01-".strtolower(substr($_FILES['file1']['name'],-12));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$source = $_FILES["file1"]["tmp_name"];
			$filename = preg_replace("([^A-Za-z0-9.-])", "", $filename);
			$target = "post_pic/".$pid."_".$filename;
			//move_uploaded_file($source, $target) or exit();
			$thumb = $img1 = $filename;
			
			//file_put_contents("post_pic/".$pid.".txt", $source."\r\n".$target."\r\n\r\n", FILE_APPEND);
			$file_type = $_FILES["file1"]["type"];
			if(($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
			{
				$filename = compress_image($source, $target, 50);
				
				/* WaterMark
				$im = imagecreatefromjpeg($target);
				
				// Copy the stamp image onto our photo using the margin offsets and the photo 
				// width to calculate positioning of the stamp. 
				imagecopy($im, $stamp, imagesx($im) - $sx - $marge_right, imagesy($im) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

				// Output and free memory
				//header('Content-type: image/png');
				imagepng($im);
				imagedestroy($im);
				*/
			}
		}
	}
	if($_FILES["file2"]["error"] > 0) { $img2 = ""; }
	else {
		$filename = "02-".strtolower(substr($_FILES['file2']['name'],-12));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$source = $_FILES["file2"]["tmp_name"];
			$filename = preg_replace("([^A-Za-z0-9.-])", "", $filename);
			$target = "post_pic/".$pid."_".$filename;
			//move_uploaded_file($source, $target) or exit();
			$img2 = $filename;
			if($thumbnail==2 || $thumb=="") { $thumb = $filename; }
			
			//file_put_contents("post_pic/".$pid.".txt", $source."\r\n".$target."\r\n\r\n", FILE_APPEND);
			$file_type = $_FILES["file2"]["type"];
			if(($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
			{
				$filename = compress_image($source, $target, 50);
			}
		}
	}
	if($_FILES["file3"]["error"] > 0) { $img3 = ""; }
	else {
		$filename = "03-".strtolower(substr($_FILES['file3']['name'],-12));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$source = $_FILES["file3"]["tmp_name"];
			$filename = preg_replace("([^A-Za-z0-9.-])", "", $filename);
			$target = "post_pic/".$pid."_".$filename;
			//move_uploaded_file($source, $target) or exit();
			$img3 = $filename;
			if($thumbnail==3 || $thumb=="") { $thumb = $filename; }
			
			//file_put_contents("post_pic/".$pid.".txt", $source."\r\n".$target."\r\n\r\n", FILE_APPEND);
			$file_type = $_FILES["file3"]["type"];
			if(($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
			{
				$filename = compress_image($source, $target, 50);
			}
		}
	}
	if($_FILES["file4"]["error"] > 0) { $img4 = ""; }
	else {
		$filename = "04-".strtolower(substr($_FILES['file4']['name'],-12));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$source = $_FILES["file4"]["tmp_name"];
			$filename = preg_replace("([^A-Za-z0-9.-])", "", $filename);
			$target = "post_pic/".$pid."_".$filename;
			//move_uploaded_file($source, $target) or exit();
			$img4 = $filename;
			if($thumbnail==4 || $thumb=="") { $thumb = $filename; }
			
			//file_put_contents("post_pic/".$pid.".txt", $source."\r\n".$target."\r\n\r\n", FILE_APPEND);
			$file_type = $_FILES["file4"]["type"];
			if(($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
			{
				$filename = compress_image($source, $target, 50);
			}
		}
	}
	if($_FILES["file5"]["error"] > 0) { $img5 = ""; }
	else {
		$filename = "05-".strtolower(substr($_FILES['file5']['name'],-12));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$source = $_FILES["file5"]["tmp_name"];
			$filename = preg_replace("([^A-Za-z0-9.-])", "", $filename);
			$target = "post_pic/".$pid."_".$filename;
			//move_uploaded_file($source, $target) or exit();
			$img5 = $filename;
			if($thumbnail==5 || $thumb=="") { $thumb = $filename; }
			
			//file_put_contents("post_pic/".$pid.".txt", $source."\r\n".$target."\r\n\r\n", FILE_APPEND);
			$file_type = $_FILES["file5"]["type"];
			if(($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
			{
				$filename = compress_image($source, $target, 50);
			}
		}
	}
	if($_FILES["file6"]["error"] > 0) { $img6 = ""; }
	else {
		$filename = "06-".strtolower(substr($_FILES['file6']['name'],-12));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$source = $_FILES["file6"]["tmp_name"];
			$filename = preg_replace("([^A-Za-z0-9.-])", "", $filename);
			$target = "post_pic/".$pid."_".$filename;
			//move_uploaded_file($source, $target) or exit();
			$img6 = $filename;
			if($thumbnail==6 || $thumb=="") { $thumb = $filename; }
			
			//file_put_contents("post_pic/".$pid.".txt", $source."\r\n".$target."\r\n\r\n", FILE_APPEND);
			$file_type = $_FILES["file6"]["type"];
			if(($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
			{
				$filename = compress_image($source, $target, 50);
			}
		}
	}
	if($_FILES["file7"]["error"] > 0) { $img7 = ""; }
	else {
		$filename = "07-".strtolower(substr($_FILES['file7']['name'],-12));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$source = $_FILES["file7"]["tmp_name"];
			$filename = preg_replace("([^A-Za-z0-9.-])", "", $filename);
			$target = "post_pic/".$pid."_".$filename;
			//move_uploaded_file($source, $target) or exit();
			$img7 = $filename;
			if($thumbnail==7 || $thumb=="") { $thumb = $filename; }
			
			//file_put_contents("post_pic/".$pid.".txt", $source."\r\n".$target."\r\n\r\n", FILE_APPEND);
			$file_type = $_FILES["file7"]["type"];
			if(($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
			{
				$filename = compress_image($source, $target, 50);
			}
		}
	}
	if($_FILES["file8"]["error"] > 0) { $img8 = ""; }
	else {
		$filename = "08-".strtolower(substr($_FILES['file8']['name'],-12));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$source = $_FILES["file8"]["tmp_name"];
			$filename = preg_replace("([^A-Za-z0-9.-])", "", $filename);
			$target = "post_pic/".$pid."_".$filename;
			//move_uploaded_file($source, $target) or exit();
			$img8 = $filename;
			if($thumbnail==8 || $thumb=="") { $thumb = $filename; }
			
			//file_put_contents("post_pic/".$pid.".txt", $source."\r\n".$target."\r\n\r\n", FILE_APPEND);
			$file_type = $_FILES["file8"]["type"];
			if(($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
			{
				$filename = compress_image($source, $target, 50);
			}
		}
	}
	if($_FILES["file9"]["error"] > 0) { $img9 = ""; }
	else {
		$filename = "09-".strtolower(substr($_FILES['file9']['name'],-12));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$source = $_FILES["file9"]["tmp_name"];
			$filename = preg_replace("([^A-Za-z0-9.-])", "", $filename);
			$target = "post_pic/".$pid."_".$filename;
			//move_uploaded_file($source, $target) or exit();
			$img9 = $filename;
			if($thumbnail==9 || $thumb=="") { $thumb = $filename; }
			
			//file_put_contents("post_pic/".$pid.".txt", $source."\r\n".$target."\r\n\r\n", FILE_APPEND);
			$file_type = $_FILES["file9"]["type"];
			if(($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
			{
				$filename = compress_image($source, $target, 50);
			}
		}
	}
	if($_FILES["file10"]["error"] > 0) { $img10 = ""; }
	else {
		$filename = "10-".strtolower(substr($_FILES['file10']['name'],-12));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$source = $_FILES["file10"]["tmp_name"];
			$filename = preg_replace("([^A-Za-z0-9.-])", "", $filename);
			$target = "post_pic/".$pid."_".$filename;
			//move_uploaded_file($source, $target) or exit();
			$img10 = $filename;
			if($thumbnail==10 || $thumb=="") { $thumb = $filename; }
			
			//file_put_contents("post_pic/".$pid.".txt", $source."\r\n".$target."\r\n\r\n", FILE_APPEND);
			$file_type = $_FILES["file10"]["type"];
			if(($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
			{
				$filename = compress_image($source, $target, 50);
			}
		}
	}
	
	$youtube = $_POST['youtube'];				$youtube = preg_replace("([^A-Za-z0-9:/.?=])", "", $youtube);
	
	//MT REPORT
	if($_FILES["fileMT"]["error"] > 0) { $fileMT = ""; }
	else {
		$filename = "mt-".strtolower(substr($_FILES['fileMT']['name'],-12));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$source = $_FILES["fileMT"]["tmp_name"];
			$filename = preg_replace("([^A-Za-z0-9.-])", "", $filename);
			$target = "post_pic/".$pid."_".$filename;
			//move_uploaded_file($source, $target) or exit();
			$fileMT = $filename;
			
			$file_type = $_FILES["fileMT"]["type"];
			if(($file_type == "image/gif") || ($file_type == "image/jpeg") || ($file_type == "image/png") || ($file_type == "image/pjpeg"))
			{
				$filename = compress_image($source, $target, 50);
			}
		}
	}
	
	$sl = fnRowID("mt_sell_car_pic");
	$sql = "insert into `$db`.`mt_sell_car_pic` values ('$sl', '$pid', '$u', '$thumb', '$img1', '$img2', '$img3', '$img4', '$img5', '$img6', '$img7', '$img8', '$img9', '$img10', '$youtube', '$fileMT', '$now');";
	mysqli_query($dbcon, $sql) or die("$sql");
	
	/*Fatal error: Allowed memory size of 33554432 bytes exhausted (tried to allocate 16384 bytes) in /home/motortraderbd/public_html/post.php on line 83*/
	/*shift from bottom due to error */
	$sl = fnRowID("mt_sell_car");
	$sql = "insert into `$db`.`mt_sell_car` values ('$sl', '$pid', '$u', '$ut', '$brand', '$regyr', '$trans', '$fueltype', '$mileage', '$model', '$modelyr', '$condition', '$type', '$engcap', '$door', '$seats', '$papers', '$location', '$color', '$price', '$whtCar', null, null, null, null, '-', '$uname', '$uemail', '$umobile', '$umsg', 'n', 'n', 'n', '0', '$now', NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
	mysqli_query($dbcon, $sql) or die(mysqli_error($dbcon));
	
	$sql = "update `$db`.`mt_users_pass` set tokens=tokens-1 where userid='$u';";
	mysqli_query($dbcon, $sql) or die("$sql");
	
	
	mysqli_close($dbcon);
	
	
	//email
	if(file_get_contents("files/location.txt")=="server")
	{
		$email = $ue; 	//from session.php
		
		require('emails/post_submit.php');
	}
	
	
	die("<script>alert('Your post was submitted and pending for approval.'); window.location='profile.php';</script>");
}
else { die("<script>window.location='profile.php';</script>"); }
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
				
				function fnBrandModel(s)
				{
					var mod = document.getElementById("model");
					mod.options.length = 0;
					
					var sel = s.value;
					
					var arr;
					if(sel=='Audi') { arr = audi; }
					else if(sel=='Bentley') { arr = bentley; }
					else if(sel=='BMW') { arr = bmw; }
					else if(sel=='Daihatusu') { arr = daihatusu; }
					else if(sel=='DFSK') { arr = dfsk; }
					else if(sel=='Haval') { arr = haval; }
					else if(sel=='Honda') { arr = honda; }
					else if(sel=='Hyundai') { arr = hyundai; }
					else if(sel=='Infiniti') { arr = infiniti; }
					else if(sel=='Jaguar') { arr = jaguar; }
					else if(sel=='Jeep') { arr = jeep; }
					else if(sel=='Kia') { arr = kia; }
					else if(sel=='Land Rover') { arr = landrover; }
					else if(sel=='Lexus') { arr = lexus; }
					else if(sel=='Maserati') { arr = maserati; }
					else if(sel=='Mazda') { arr = mazda; }
					else if(sel=='Mercedes') { arr = mercedes; }
					else if(sel=='MG') { arr = mg; }
					else if(sel=='Mitsubishi') { arr = mitsubishi; }
					else if(sel=='Nissan') { arr = nissan; }
					else if(sel=='Porsche') { arr = porsche; }
					else if(sel=='Proton') { arr = proton; }
					else if(sel=='Ssangyong') { arr = ssangyong; }
					else if(sel=='Subaru') { arr = subaru; }
					else if(sel=='Suzuki') { arr = suzuki; }
					else if(sel=='Tata') { arr = tata; }
					else if(sel=='Toyota') { arr = toyota; }
					else if(sel=='Volkswagen') { arr = volkswagen; }
					else if(sel=='Volvo') { arr = volvo; }
					else if(sel=='Hino') { arr = hino; }
					else if(sel=='Ashok Leyland') { arr = ashok; }
					arr.sort();
					
					var option;
					for (x of arr) {
						option = document.createElement("option");
						option.text = x;
						mod.add(option);
					}
				}
				
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
						if(fileSize > 30) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 30 MB. Please select image file less than 30MB size.");
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
						if(fileSize > 30) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 30 MB. Please select image file less than 30MB size.");
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
						if(fileSize > 30) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 30 MB. Please select image file less than 30MB size.");
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
						if(fileSize > 30) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 30 MB. Please select image file less than 30MB size.");
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
						if(fileSize > 30) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 30 MB. Please select image file less than 30MB size.");
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
						if(fileSize > 30) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 30 MB. Please select image file less than 30MB size.");
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
						if(fileSize > 30) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 30 MB. Please select image file less than 30MB size.");
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
						if(fileSize > 30) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 30 MB. Please select image file less than 30MB size.");
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
						if(fileSize > 30) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 30 MB. Please select image file less than 30MB size.");
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
						if(fileSize > 30) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 30 MB. Please select image file less than 30MB size.");
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
						if(fileSize > 30) {
							alert("WARNING !!! '"+fileName+"' - file size exceeds 30 MB. Please select image file less than 30MB size.");
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
				
				<form name='frmPost' method="post" action="post.php" enctype="multipart/form-data" onsubmit='return validFrmPostSubmit()'>
				
				<!--Sell Car Form-->
				<div class="sell-car-form">
					<h2>Vehicle Information</h2>
					<div class="form-box">
						<div class="row clearfix">
							<!--
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Name</label>
								<input type="text" name="name" maxlength=50 value="" placeholder="Enter Name *" required>
							</div>
							-->
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Brand</label>
								<select id='brand' name='brand' onchange='fnBrandModel(this)'><option>Audi</option><option>Ashok Leyland</option><option>Bentley</option><option>BMW</option><option>Daihatusu</option><option>DFSK</option><option>Ford</option><option>Haval</option><option>Honda</option><option>Hino</option><option>Hyundai</option><option>Infiniti</option><option>Isuzu</option><option>Jaguar</option><option>Jeep</option><option>Kia</option><option>Land Rover</option><option>Lexus</option><option>Maserati</option><option>Mazda</option><option>Mercedes</option><option>MG</option><option>Mitsubishi</option><option>Nissan</option><option>Porsche</option><option>Proton</option><option>Ssangyong</option><option>Subaru</option><option>Suzuki</option><option>Tata</option><option>Toyota</option><option>Volkswagen</option><option>Volvo</option></select>
								<!-- <input type="text" name="brand" maxlength=50 value="" placeholder="Enter Brand Name *" required> -->
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Model</label>
								<select id='model' name='model'><option>-</option></select>
								<!-- <input type="text" name="model" maxlength=50 value="" placeholder="Enter Model Name *" required> -->
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Model Year</label>
								<select name='modelyr'><?php for($i=$yr; $i>=$yr-40; $i--) { echo "<option>$i</option>"; } ?></select>
								<!-- <input type="text" name="modelyr" maxlength=50 value="" placeholder="Enter Model Year *" required> -->
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Registration Year</label>
								<select name='regyr'><option value=0>Unregistered</option><?php for($i=$yr; $i>=$yr-40; $i--) { echo "<option>$i</option>"; } ?></select>
								<!-- <input type="text" name="regyr" maxlength=50 value="" placeholder="Enter Registration Year *" required> -->
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Condition</label>
								<select name='condition'><option>New</option><option>Used</option></select>
								<!-- <input type="text" name="condition" maxlength=50 value="" placeholder="Enter Condition *" required> -->
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Type</label>
								<select name='type'><option>Sedan</option><option>Hatch</option><option>Wagon</option><option>Microbus</option><option>SUV/Crossover</option><option>Pickup</option><option>Sports</option><option>Bus/Truck/Commercial</option><option>Convertible</option></select>
								<!-- <input type="text" name="type" maxlength=50 value="" placeholder="Enter Type *" required> -->
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Transmission</label>
								<select name='trans'><option>Automatic</option><option>Semi-Automatic</option><option>Manual</option></select>
								<!-- <input type="text" name="trans" maxlength=50 value="" placeholder="Enter Transmission *" required> -->
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Fuel Type</label>
								<select name='fueltype'><option>Octane</option><option>Octane(Hybrid)</option><option>Petrol</option><option>Diesel</option><option>Diesel(Hybrid)</option><option>CNG</option><option>LPG</option></select>
								<!-- <input type="text" name="fueltype" maxlength=50 value="" placeholder="Enter Fuel Type *" required> -->
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Mileage</label>
								<input type="text" name="mileage" maxlength=50 value="" placeholder="type 0 or leave empty if undisclosed" pattern="[0-9]{0,}">
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Color</label>
								<input type="text" name="color" maxlength=50 value="" placeholder="Enter Color Details *" pattern="[A-Z a-z]{3,}" required>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Engine Capacity</label>
								<input type="text" name="engcap" maxlength=50 value="" placeholder="Enter Engine Capacity *" onkeypress="return ChrCheck2(event, digit)" required>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Doors</label>
								<select name='door'><option>1</option><option>2</option><option>3</option><option selected>4</option><option>5</option></select>
								<!-- <input type="text" name="door" maxlength=50 value="" placeholder="Enter No. of Door *" required> -->
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Seats</label>
								<select name='seats'><option>1</option><option>2</option><option>3</option><option>4</option><option selected>5</option><option>6</option><option>7</option><option>8</option><option>9</option><option>10</option><option>11</option><option>12</option><option>13</option><option>14</option><option>15</option></select>
								<!-- <input type="text" name="seats" maxlength=50 value="" placeholder="Enter No. of Seats *" required> -->
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Papers & Documents</label>
								<select name='papers'><option>None</option><option>Up to Date</option><option>Failed</option></select>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Location</label>
								<select name='location'><option>Dhaka</option><option>Chittagong</option><option>Rajshahi</option><option>Khulna</option><option>Barishal</option><option>Sylhet</option><option>Rangpur</option><option>Mymensingh</option></select>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Price</label>
								<input type="text" name="price" maxlength=50 value="" placeholder="type 0 or leave empty if undisclosed" pattern="[0-9]{0,}">
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>What Car do you drive</label>
								<input type="text" name="whtCar" maxlength=50 value="" placeholder="Enter Brand, Model, Year etc." pattern="[A-Za-z0-9 .,-()]{0,}" >
							</div>
						</div>
					</div>
				</div>
				<!--End Cell Car Form-->
				
				
				<!--Sell Car Form-->
				<div class="sell-car-form">
					<h2>Upload Car Photos</h2>
					<div class="form-box">
						<div class="row clearfix">
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12" style='display:flex;flex-direction:row;border:1px solid #CCC; padding:0px 0px 5px 10px; background-color:#E7E7E7;'>
								<div>
								    <b>Image 1</b> 
								    <input style="width:43%;" type="file" oninput="pic.src=window.URL.createObjectURL(this.files[0])" name="file1" id="file1" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp">
								<div>
								    <input type="radio" id="thumb" name="thumb" value="1" checked> Choose Thumbnail</div>
								</div>
								<img id="pic" style="background-image:url(images/background/picture-preview-icon-01.png);margin-top:20px;margin-right:10px;width:90px;height:50px;background-position: center;"/>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12" style='display:flex;flex-direction:row;border:1px solid #CCC; padding:0px 0px 5px 10px; background-color:#E7E7E7;'>
								<div>
								    <b>Image 2</b> 
								<input style="width:43%;" type="file" name="file2" id="file2" oninput="pic2.src=window.URL.createObjectURL(this.files[0])" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp">
							    <div>	
							    <input type="radio" id="thumb" name="thumb" value="2"> Choose Thumbnail</div>
								</div>
								<img id="pic2" style="background-image:url(images/background/picture-preview-icon-01.png);margin-top:20px;margin-right:10px;width:90px;height:50px;background-position: center;"/>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12" style='display:flex;flex-direction:row;border:1px solid #CCC; padding:0px 0px 5px 10px; background-color:#E7E7E7;'>
								<div>
								    <b>Image 3</b> 
								<input style="width:43%;" type="file" name="file3" id="file3" oninput="pic3.src=window.URL.createObjectURL(this.files[0])" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp">
							<div>	
							    <input type="radio" id="thumb" name="thumb" value="3"> Choose Thumbnail</div>
								</div>
								<img id="pic3" style="background-image:url(images/background/picture-preview-icon-01.png);margin-top:20px;margin-right:10px;width:90px;height:50px;background-position: center;"/>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12" style='display:flex;flex-direction:row;border:1px solid #CCC; padding:0px 0px 5px 10px; background-color:#E7E7E7;'>
								<div>
								    <b>Image 4</b> 
								<input style="width:43%;" type="file" name="file4" id="file4" oninput="pic4.src=window.URL.createObjectURL(this.files[0])" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp">
							<div>	
							    <input type="radio" id="thumb" name="thumb" value="4"> Choose Thumbnail</div>
								</div>
								<img id="pic4" style="background-image:url(images/background/picture-preview-icon-01.png);margin-top:20px;margin-right:10px;width:90px;height:50px;background-position: center;"/>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12" style='display:flex;flex-direction:row;border:1px solid #CCC; padding:0px 0px 5px 10px; background-color:#E7E7E7;'>
								<div>
								    <b>Image 5</b> 
								    <input style="width:43%;" type="file" name="file5" id="file5" oninput="pic5.src=window.URL.createObjectURL(this.files[0])" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp">
								<div>	<input type="radio" id="thumb" name="thumb" value="5"> Choose Thumbnail</div>
								</div>
								<img id="pic5" style="background-image:url(images/background/picture-preview-icon-01.png);margin-top:20px;margin-right:10px;width:90px;height:50px;background-position: center;"/>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12" style='display:flex;flex-direction:row;border:1px solid #CCC; padding:0px 0px 5px 10px; background-color:#E7E7E7;'>
								<div>
								    <b>Image 6</b> 
								    <input style="width:43%;" type="file" name="file6" id="file6" oninput="pic6.src=window.URL.createObjectURL(this.files[0])" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp">
								<div>	
								<input type="radio" id="thumb" name="thumb" value="6"> Choose Thumbnail</div>
								</div>
								<img id="pic6" style="background-image:url(images/background/picture-preview-icon-01.png);margin-top:20px;margin-right:10px;width:90px;height:50px;background-position: center;"/>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12" style='display:flex;flex-direction:row;border:1px solid #CCC; padding:0px 0px 5px 10px; background-color:#E7E7E7;'>
							<div>
							    <b>Image 7</b> 
								<input style="width:43%;" type="file" name="file7" id="file7" oninput="pic7.src=window.URL.createObjectURL(this.files[0])" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp">
								<div>	
								<input type="radio" id="thumb" name="thumb" value="7"> Choose Thumbnail</div>
							</div>
								<img id="pic7" style="background-image:url(images/background/picture-preview-icon-01.png);margin-top:20px;margin-right:10px;width:90px;height:50px;background-position: center;"/>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12" style='display:flex;flex-direction:row;border:1px solid #CCC; padding:0px 0px 5px 10px; background-color:#E7E7E7;'>
								<div>
								    <b>Image 8</b> 
								    <input style="width:43%;" type="file" name="file8" id="file8" oninput="pic8.src=window.URL.createObjectURL(this.files[0])" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp">
								<div>	
								<input type="radio" id="thumb" name="thumb" value="8"> Choose Thumbnail</div>
								</div>
								<img id="pic8" style="background-image:url(images/background/picture-preview-icon-01.png);margin-top:20px;margin-right:10px;width:90px;height:50px;background-position: center;"/>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12" style='display:flex;flex-direction:row;border:1px solid #CCC; padding:0px 0px 5px 10px; background-color:#E7E7E7;'>
								<div>
								    <b>Image 9</b> 
								    <input style="width:43%;" type="file" name="file9" id="file9" oninput="pic9.src=window.URL.createObjectURL(this.files[0])" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp">
								<div>	
								<input type="radio" id="thumb" name="thumb" value="9"> Choose Thumbnail</div>
								</div>
								<img id="pic9" style="background-image:url(images/background/picture-preview-icon-01.png);margin-top:20px;margin-right:10px;width:90px;height:50px;background-position: center;"/>
							</div>
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12" style='display:flex;flex-direction:row;border:1px solid #CCC; padding:0px 0px 5px 10px; background-color:#E7E7E7;'>
								<div>
								    <b>Image 10</b> 
								    <input style="width:43%;" type="file" name="file10" id="file10" oninput="pic10.src=window.URL.createObjectURL(this.files[0])" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp">
								<div>	
								<input type="radio" id="thumb" name="thumb" value="10"> Choose Thumbnail</div>
								</div>
								<img id="pic10" style="background-image:url(images/background/picture-preview-icon-01.png);margin-top:20px;margin-right:10px;width:90px;height:50px;background-position: center;"/>
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style='border:1px solid #CCC; padding:0px 0px 5px 10px; background-color:#E7E7E7;'>
								<b>Youtube Link</b> <input type="text" name="youtube" maxlength=100 style='margin:10px 0 6px 0; width:98%; height:35px;' value="" placeholder="Youtube Video Link (ex. https://www.youtube.com/watch?v=QjSL0wl6U18)">
							</div>
						</div>
					</div>
				</div>
				<!--End Cell Car Form-->
				
				
				<!--Sell Car Form-->
				<div class="sell-car-form">
					<h2>Auction Sheet / MT REPORT</h2>
					<div class="form-box">
						<div class="row clearfix">
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12" style='border:1px solid #CCC; padding:0px 0px 5px 10px; background-color:#E7E7E7;'>
								Select File <input type="file" name="fileMT" id="fileMT" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp">
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
								<textarea id="umsg" name='umsg' placeholder=""></textarea>
							</div>
						</div>
					</div>
				</div>
				<!--End Cell Car Form-->

				<div class="form-column column col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="styled-form">
						<div class="form-group" style='text-align:center;'>
							<input type='submit' name='submitNew' id="submitNew" value='SUBMIT' class="theme-btn btn-style-one">
						</div>
					</div>
				</div>
				
				</form>
				
				<script>
				fnBrandModel(document.getElementById("brand"));
				</script>
                
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
