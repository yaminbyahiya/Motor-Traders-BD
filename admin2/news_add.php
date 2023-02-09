<?php session_start();
require_once("files/common_top.php");
require_once("files/session.php");
$menu = "posts";
$submenu = "news-add";

if(isset($_POST['submitAddNews']))
{
	//require('../files/ts.php');
	require('../files/dbcon.php');

	$title = $_POST['title'];
	$details = $_POST['details'];
	$title2 = substr(strip_tags($details),0,150);
	$category = ""; //$_POST['category'];
	$author = $_POST['author'];
	
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
			$target = "../news_pic/".$nid."_".$filename;
			move_uploaded_file($_FILES["file1"]["tmp_name"], $target) or exit();
			$img1 = $filename;
		}
	}
	
	//$sl = fnRowID("mt_news");
	$sql = "insert into `$db`.`mt_news` values (null, 'admin', '$u', '$author', '$nid', '$title', '$title2', '$details', '$category', '$img1', 'y', '$now', '0', '-', '$u', '$now');";
	mysqli_query($dbcon, $sql) or die("$sql");
	
	mysqli_close($dbcon);
	
	die("<script>alert('Your News/Article was submitted successfully.'); window.location='news_add.php';</script>");
}
?>
<!DOCTYPE html>
<html>
<head>
<?php require_once("files/head.php"); ?>
<!-- Wait Me Css -->
<link href="css/waitMe.css" rel="stylesheet" />
<!-- Bootstrap Select Css -->
<link href="css/bootstrap-select.css" rel="stylesheet" />
<!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
<link href="css/all-themes.css" rel="stylesheet">
<title>Add News - MT-ADMIN</title>

<script src="editor/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist anchor autolink charmap code colorpicker directionality emoticons fullscreen hr",
        "image insertdatetime link lists media nonbreaking pagebreak paste preview print",
        "save searchreplace spellchecker table template textcolor textpattern visualblocks visualchars wordcount"
    ],	//contextmenu
    spellchecker_rpc_url: 'editor/spellchecker.php',

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
							Add News / Article
						</h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<i class="material-icons">more_vert</i>
								</a>
								<!--
								<ul class="dropdown-menu pull-right">
									<li><a href="javascript:void(0);">Action</a></li>
									<li><a href="javascript:void(0);">Another action</a></li>
									<li><a href="javascript:void(0);">Something else here</a></li>
								</ul>
								-->
							</li>
						</ul>
					</div>
					<div class="body">
						<div class="row clearfix">
							<script>
							function validFrms()
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
								}
								
								return confirm('Are you sure you want to add news/article ?');
							}
							</script>
							
							<form name='frmPost' method="post" action="" enctype="multipart/form-data" onsubmit='return validFrms()' style='margin-bottom:0px;' >
							
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="title" class="form-control" minlength=3 maxlength=200 value="" placeholder="News Title *" required>
									</div>
								</div>
							</div>
							<!--<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="category" class="form-control" minlength=0 maxlength=200 value="" placeholder="Category">
									</div>
								</div>
							</div>-->
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="author" class="form-control" minlength=3 maxlength=50 value="" placeholder="Author Name *" required>
									</div>
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="form-group">
									<div class="form-line">
										<textarea id="tinymce" name="details" style="height:300px;">
											
										</textarea>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										Image *<input type="file" name="file1" id="file1" class="form-control" accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp" title="News Image *" required>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line-XXX">
										<input type='submit' name='submitAddNews' value='SUBMIT' class="btn bg-green btn-lg waves-effect">
									</div>
								</div>
							</div>
							
							</form>
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
<!-- Autosize Plugin Js -->
<script src="js/autosize.js"></script>
<!-- Moment Plugin Js -->
<script src="js/moment.js"></script>
<!-- Custom Js -->
<script src="js/admin.js"></script>
<script src="js/basic-form-elements.js"></script>
<!-- Demo Js -->
<script src="js/demo.js"></script>

</body>
</html>
