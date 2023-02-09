<?php session_start();
require("session.php");

if(isset($_POST['submitAddNews']))
{
	require('../files/ts.php');
	require('../files/dbcon.php');

	$title = $_POST['title'];
	$details = $_POST['details'];
	$title2 = substr(strip_tags($details),0,150);
	$category = $_POST['category'];
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
	
	$sl = fnRowID("mt_news");
	$sql = "insert into `$db`.`mt_news` values ('$sl', 'admin', '$u', '$author', '$nid', '$title', '$title2', '$details', '$category', '$img1', 'y', '$now', '0', '-', '$u', '$now');";
	mysqli_query($dbcon, $sql) or die("$sql");
	
	mysqli_close($dbcon);
	
	die("<script>alert('Your News/Article was submitted successfully.'); window.location='news_add.php';</script>");
}
?>

<html>
<head>
<?php require_once('head.php'); ?>
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

<body>
<?php
//$pg = $_REQUEST['pg'];
require_once('menu.php');
?>

<div style='padding:15px;'>
<h2>Add News/Article</h2>

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
	}
	
	return confirm('Are you sure you want to add news/article ?');
}
</script>

<form name='frmPost' method="post" enctype="multipart/form-data" action="" onsubmit='return validFrmNews()' class=cat>

Title : <input type="text" name="title" class=cat size=68 maxlength=200 value="" placeholder="Enter News Title *" required>
<br><br>
Category : <input type="text" name="category" class=cat size=64 maxlength=200 value="" placeholder="Enter Category">
<br><br>
Author : <input type="text" name="author" class=cat size=64 maxlength=50 value="MotorTrader" placeholder="Enter Author Name" required>
<br><br>
Details :<br>
<div style="width:700px;"><textarea name="details" class=cat style="height:300px;"></textarea></div>
<br><br>
Image : <input type="file" name="file1" id="file1" class=cat accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp" required>
<br><br>
<input type='submit' name='submitAddNews' value='SUBMIT' class="cat2">
</form>

</div>
</body>
</html>
