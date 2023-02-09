<?php session_start();
require("session.php");

if(isset($_REQUEST['result'])) { $result = $_REQUEST['result']; }
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
	$resultTxt= $result;
	$result = " and t2.result='$result'";
}
?>

<html>
<head>
<?php require_once('head.php'); ?>
</head>

<body>
<?php
//$pg = $_REQUEST['pg'];
require_once('menu.php');
?>

<div style='padding:15px;'>
<h2>Transactions - <?php echo $resultTxt; ?></h2>

<form name='frmsrc' action='' method='post'>
<a href='transactions.php?result=SUCCESS'>success</a> &nbsp; | &nbsp; <a href='transactions.php?result=FAIL'>fail</a> &nbsp; | &nbsp; <a href='transactions.php?result=CANCEL'>cancel</a> &nbsp; | &nbsp;
<input type='text' name='uid' value='' placeholder='user id' minlength='7'> &nbsp; | &nbsp;
<input type='text' name='dt' value='' placeholder='date YYYY-MM-DD' minlength='10'> &nbsp; | &nbsp;
<input type='text' name='invid' value='' placeholder='invoice id' minlength='6'> &nbsp; &nbsp;
<input type='submit' name='submit' value='submit'>
</form>
<br>

<table border=1 cellpadding=5 cellspacing=0 style='border-collapse:collapse;' class='cat'>
<tr><td>SL</td><td>User ID</td><td>Inv. Id</td><td>Trxn. Id</td><td>Trxn. Type</td><td>Qty</td><td>Amount</td><td>Time</td><td>Result</td></tr>
<?php
require('../files/dbcon.php');
require('../files/ts.php');

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
</table>

</div>
</body>

</html>
