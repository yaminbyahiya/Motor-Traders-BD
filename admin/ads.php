<?php session_start();
require("session.php");

$ts = time();
$now = date('Y-m-d H:i:s', $ts);

require_once('../files/dbcon.php');
?>

<html>
<head>
<?php require_once('head.php'); ?>
</head>

<body>
<?php
require_once('menu.php');
?>

<div style='padding:15px;'>
<h2>ADS</h2>

<?php
if(isset($_POST['submitup']))
{
	$c = $_POST['caption'];
	$t = date('ymdhis', $ts);
	
	$allowed = array('jpg', 'JPG', 'jpeg', 'JPEG', 'png', 'png12', 'png24', 'gif', 'bmp');
	
	if($_FILES["file1"]["error"] > 0) {}
	else {
		$filename = strtolower(substr($_FILES['file1']['name'],-15));
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if(!in_array($ext, $allowed)) {}
		else
		{
			$target = "../files/jssor-slider/".$t.".jpg";
			move_uploaded_file($_FILES["file1"]["tmp_name"], $target) or exit();
		}
	}
	//$sql2 = "insert into `$db`.`mt_ads` values (null, '$t', '$c', 'y', '$u', '$now', null, null);";
	$sql2 = "insert into `$db`.`mt_ads` values (null, '$t', null, 'y', '$u', '$now', null, null);";
	mysqli_query($dbcon, $sql2) or die($sql2);
	?>
	<script type='text/javascript'>alert("Image uploaded."); window.location='ads.php';</script>
	<?php
}

if(isset($_POST['submitdel']))
{
	$id = $_POST['id'];
	$sql2 = "update `$db`.`mt_ads` set status='n', removedBy='$u', removedOn='$now' where id='$id';";
	mysqli_query($dbcon, $sql2) or die($sql2);
	?>
	<script type='text/javascript'>alert("Image removed.")</script>
	<?php
}
?>

<table border="1" cellpadding=15 cellspacing=0>
<form name=frmimgup method=post action="ads.php" enctype="multipart/form-data">
<tr>
	<td>
		<u>Upload Image (980x380)</u><br><br>
		Image &nbsp;&nbsp;<input type="file" name="file1" id="file1" size=69 accept=".jpg, .JPG, .jpeg, .JPEG, .png, .png12, .png24, .gif, .bmp" required> (size w:980px, h:380px, JPG (RGB), 72 DPI)<br><br>
		<!--Caption <input type='text' name='caption' size=63 maxlength=500 class=cat><br><br>-->
		<input type='submit' name='submitup' value="Submit">
	</td>
</tr>
</form>
</table>
<br><br>

<?php
$i=1;
$sql = "select * from `$db`.`mt_ads` where status='y' order by id desc limit 0,10;";
$result = mysqli_query($dbcon, $sql) or die($sql);
while($row = mysqli_fetch_array($result))
{	$id = $row['id'];
	?>
	<form name="frmdel<?php echo $i; ?>" method=post action="ads.php">
	<table border=0 cellpadding=10 cellspacing=0 style="border-collapse: collapse" bgcolor='#CCC'>
	<tr>
		<td width=260><img src="../files/jssor-slider/<?php echo $id; ?>.jpg" border=1 width=250 height=150></td>
		<td class=cat>
			<?php echo $i; ?>.<br><br>
			<font color='#AA0000'><?php echo $row['caption']; ?></font><br><br>
			<input type='hidden' name='id' value="<?php echo $id; ?>">
			<input type='submit' name='submitdel' value="Delete">
		</td>
		<td>&nbsp;</td>
	</tr>
	</table>
	</form>
	<br>
	<?php
	$i++;
}
mysqli_free_result($result);

mysqli_close($dbcon);
?>

</div>
</body>
</html>
