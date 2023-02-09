<?php session_start();
require('files/session.php');
if($u!="" && $session==true) {} else { die("<script>window.location='news.php';</script>"); }

if(isset($_POST['submitNews'])) {
}
elseif(isset($_POST['submitAddNews']))
{
	require('files/ts.php');
	require('files/dbcon.php');

	$title = $_POST['title'];			$title = preg_replace("([^A-Za-z0-9()?!,. -])", "", $title);
	$details = $_POST['details'];		$details = preg_replace("([^A-Za-z0-9. ()-,?!/;:])", "", $details);
	$title2 = substr(strip_tags($details),0,150);
	$category = str_replace("'", "\'", $_POST['category']);
	
	$nid = $ts.rand(100,999);
	
	$allowed = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'png12', 'png24', 'gif', 'bmp');
	
	if($_FILES["file1"]["error"] > 0) { $img1 = ""; }
	else {
		$filename = strtolower(substr($_FILES['file1']['name'],-15));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$filename = preg_replace("([^A-Za-z0-9.])", "", $filename);
			$target = "news_pic/".$nid."_".$filename;
			move_uploaded_file($_FILES["file1"]["tmp_name"], $target) or exit();
			$img1 = $filename;
		}
	}
	
	$sl = fnRowID("mt_news");
	$sql = "insert into `$db`.`mt_news` values ('$sl', 'user', '$u', '$un', '$nid', '$title', '$title2', '$details', '$category', '$img1', 'n', '$now', '0', '-', NULL, NULL);";
	mysqli_query($dbcon, $sql) or die("$sql");
	
	mysqli_close($dbcon);
	
	die("<script>alert('Your News/Article was submitted for approval. Please keep patient.'); window.location='profile.php';</script>");
}
else { die("<script>window.location='profile.php';</script>"); }
?>

<!DOCTYPE html>
<html>
<head>
<?php require('files/head.php'); ?>
<script src="admin/editor/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist anchor autolink charmap code colorpicker directionality emoticons fullscreen hr",
        "image insertdatetime link lists media nonbreaking pagebreak paste preview print",
        "save searchreplace spellchecker table template textcolor textpattern visualblocks visualchars wordcount"
    ],	//contextmenu
    spellchecker_rpc_url: 'admin/editor/spellchecker.php',

    menubar: "false",	//file edit
    toolbar_items_size: 'big',	//small
	toolbar1: "insertfile undo redo | outdent indent | searchreplace hr | blockquote | bullist numlist | charmap emoticons | preview code",
    toolbar2: "fontsizeselect forecolor backcolor | bold italic underline | alignleft aligncenter alignright alignjustify | link unlink media image",
    // styleselect strikethrough fontselect spellchecker cut copy paste | 
    image_advtab: true,
    templates: [
        {title: 'Test template 1', content: 'Test 1'},
        {title: 'Test template 2', content: 'Test 2'}
    ]
});
</script>
</head>

<body>
<div class="page-wrapper">
 	
    <!-- Preloader -->
    <div class="preloader"></div>
 	
    <?php $menu='news_post'; require('files/header.php'); ?>
    
    <!--Register Section-->
    <section class="register-section">
        <div class="auto-container">
            <div class="sec-title">
            	<h2>Add News / Article / Blog</h2>
                <!--<div class="text">Interested in selling us your vehicle? Simply enter in the vehicle information below along with your contact information and we will contact you shortly. Fields marked with (*) are required.</div>-->
            </div>
			
			<div class="row clearfix">
                
                <script>
				function validFrmNews()
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
					
					return confirm('Are you sure you want to add news/article ?');
				}
				</script>
				
				<form name='frmPost' method="post" enctype="multipart/form-data" action="" onsubmit='return validFrmNews()'>
				
				<div class="sell-car-form">
					<div class="form-box">
						<div class="row clearfix">
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Title</label>
								<input type="text" name="title" maxlength=200 value="" placeholder="Enter News Title *" required>
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<label>Category</label>
								<input type="text" name="category" maxlength=200 value="" placeholder="Enter Category">
							</div>
							<div class="form-group col-md-12 col-sm-12 col-xs-12">
								<label>Details</label>
								<textarea name="details" style="height:400px;"></textarea>
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style='padding:0 0 0 20;'>
								<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style='padding:10px 10px 10px 20px; border:1px solid #CCC; background-color:#E7E7E7;'>
									<label>News Image</label>
									<input type="file" name="file1" id="file1" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp">
								</div>
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" style='text-align:center;'>
								<input type='submit' name='submitAddNews' value='SUBMIT' class="theme-btn btn-style-one">
							</div>
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

</body>
</html>
