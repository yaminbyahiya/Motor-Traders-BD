<?php
require_once("files/common_top.php");
require_once("files/session.php");

if(isset($_POST['submit']) && isset($_POST['boid']) && isset($_POST['date']))
{
	require_once("files/ts.php");
	require_once("files/dbcon.php");
	
	$code = $_POST['boid'];
	$date = $_POST['date'];
	
	$tmp = explode(" ", $date);
	$m = $tmp[2];
	if($m=='January') { $m='01'; } elseif($m=='February') { $m='02'; } elseif($m=='March') { $m='03'; }
	elseif($m=='April') { $m='04'; } elseif($m=='May') { $m='05'; } elseif($m=='June') { $m='06'; }
	elseif($m=='July') { $m='07'; } elseif($m=='August') { $m='08'; } elseif($m=='September') { $m='09'; }
	elseif($m=='October') { $m='10'; } elseif($m=='November') { $m='11'; } elseif($m=='December') { $m='12'; }
	$ymd = $tmp[3].$m.$tmp[1];
	$dt = date('d-M-Y', strtotime($tmp[3]."-".$m."-".$tmp[1]." 00:00:00"));
	?>

	<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
	<meta name="viewport" content="width=device-width">
	<title>Trade Summary Report (<?php echo $code." - ".$dt; ?>)</title>
	</head>

	<body topmargin="0" leftmargin="0" rightmargin="0" bottommargin="0" bgcolor=#FFFFFF>
	<div align=center><table border=0 width=750 cellpadding=0 cellspacing=0><tr><td>
	<!-- pg start -->

	<style type=text/css>
	.ver9  { font-family: tahoma, arial, helvetica, sans-serif; font-weight: normal; font-size: 9px; }
	.ver10 { font-family: tahoma, arial, helvetica, sans-serif; font-weight: normal; font-size: 10px; }
	.ver11 { font-family: tahoma, arial, helvetica, sans-serif; font-weight: normal; font-size: 11px; }
	.ver11wht { font-family: tahoma, arial, helvetica, sans-serif; font-weight: normal; font-size: 11px; color:#FFFFFF; }
	.ver12 { font-family: tahoma, arial, helvetica, sans-serif; font-weight: normal; font-size: 12px; }
	.ver13 { font-family: tahoma, arial, helvetica, sans-serif; font-weight: normal; font-size: 13px; }
	.ver14 { font-family: tahoma, arial, helvetica, sans-serif; font-weight: normal; font-size: 14px; }
	.ver15 { font-family: tahoma, arial, helvetica, sans-serif; font-weight: normal; font-size: 15px; }
	.ver20 { font-family: tahoma, arial, helvetica, sans-serif; font-weight: bold; font-size: 18px; }
	</style>

	<table border=0 width="100%" cellpadding=0 cellspacing=0 class=ver13>
	<tr>
		<td>
			<span class=ver20>DELTA CAPITAL LIMITED</span><br>
			55-MOTIJHEEL C/A, ZAREEN MANSION (3RD FLOOR),<br>
			Dhaka, Bangladesh
		</td>
		<td align=right>
			<b>TRADE SUMMARY REPORT</b>
		</td>
	</tr>
	</table>

	<hr size=2>
	<br>
	
	<?php
	$sql = "select BOID, Name from `$db`.`dp29` where ClientCode='$code';";
	$r = mysql_query($sql, $dbcon) or die($sql);
	while($row = mysql_fetch_array($r))
	{
		$boid = $row[0];
		$name = $row[1];
	}
	?>
	
	<table border=0 width="100%" cellpadding=1 cellspacing=0 class=ver12>
	<tr><td width=120><b>Account Number</b></td>
		<td width=15><b>:&nbsp;</b></td><td><?php echo $code; ?></td>
		<td align=right><b>Trading Date &nbsp;&nbsp; : &nbsp;</b></td><td width=80><?php echo $dt; ?></td>
	</tr>	
	<tr><td><b>BO Number</b></td><td><b>:&nbsp;</b></td><td><?php echo $boid; ?></td>
		<td align=right><b></b></td><td>&nbsp;</td>
	</tr>
	<tr><td><b>Account Name</b></td><td><b>:&nbsp;</b></td><td><?php echo strtoupper($name); ?></td>
		<td align=right><b></b></td><td>&nbsp;</td>
	</tr>
	</table>
	<br>
	
	<center>
	<table border=0 cellpadding=8 cellspacing=0 class=ver15 bgcolor='#000000'>
	<tr><td><font color='#FFFFFF'><b>CUSTOMER COPY</b></font></td></tr>
	</table>
	</center>

	<div class=ver12 style="padding:10px 0px 20px 0px;">With reference to your order as stated before date <?php echo $dt; ?>, we have purchased & sold following securities.</div>

	<table border=1 width="100%" cellpadding=3 cellspacing=0 class=ver12 style="border-collapse:collapse;">
	<tr class=ver13 style='font-weight:bold; border:1px solid #000000'>
		<td>Trade</td>
		<td>Instrument</td>
		<td align=right>Quantity</td>
		<td align=right>Avg. Rate</td>
		<td align=right>Amount</td>
		<td align=right>Commission</td>
		<td align=right>Total Cost</td>
	</tr>
	<?php
	$totalBuy = $totalBuyComm = $totalBuyCost = 0;
	$totalSALE = $totalSALEComm = $totalSALECost = 0;
	$bs = "BUY";
	$i = 0;
	$sql = "SELECT Side, SecurityCode, sum(Quantity) as qty, sum(Value) as tk FROM `$db`.`trades` WHERE Action='EXEC' and Quantity>0 and ClientCode='$code' and Date='$ymd' group by SecurityCode order by Side, SecurityCode;";
	$r = mysql_query($sql, $dbcon) or die($sql);
	while($row = mysql_fetch_array($r))
	{
		$i++;
		$side = $row[0]=="B"?"BUY":"SALE";
		$rate = number_format($row[3]/$row[2],2,'.',',');
		$comm = $row[3]*.0009;
		$total = $row[3] + $comm;
		
		if($side=="BUY")
		{
			$totalBuy += $row[3];
			$totalBuyComm += $comm;
			$totalBuyCost = $totalBuy + $totalBuyComm;
		}
		else
		{
			$totalSALE += $row[3];
			$totalSALEComm += $comm;
			$totalSALECost = $totalSALE + $totalSALEComm;
			
			if($bs=="BUY" && $i>1)
			{
				echo "
				<tr>
				<td colspan=4 align=right><b>SUB TOTAL</b></td>
				<td align=right>".number_format($totalBuy,2,'.',',')."</td>
				<td align=right>".number_format($totalBuyComm,2,'.',',')."</td>
				<td align=right>".number_format($totalBuyCost,2,'.',',')."</td>
				</tr>
				<tr><td colspan=7 style='border-left:1px solid #FFFFFF; border-right:1px solid #FFFFFF;'>&nbsp;</td></tr>
				<tr class=ver13 style='font-weight:bold; border:1px solid #000000'>
					<td>Trade</td>
					<td>Instrument</td>
					<td align=right>Quantity</td>
					<td align=right>Avg. Rate</td>
					<td align=right>Amount</td>
					<td align=right>Commission</td>
					<td align=right>Total Cost</td>
				</tr>
				";
			}
			$bs = "SALE";
		}
		
		echo "
		<tr>
		<td>$side</td>
		<td>$row[1]</td>
		<td align=right>".number_format($row[2],0,'.',',')."</td>
		<td align=right>$rate</td>
		<td align=right>".number_format($row[3],2,'.',',')."</td>
		<td align=right>".number_format($comm,2,'.',',')."</td>
		<td align=right>".number_format($total,2,'.',',')."</td>
		</tr>
		";
	}
	if($bs=="BUY")
	{
		echo "
		<tr>
		<td colspan=4 align=right><b>SUB TOTAL</b></td>
		<td align=right>".number_format($totalBuy,2,'.',',')."</td>
		<td align=right>".number_format($totalBuyComm,2,'.',',')."</td>
		<td align=right>".number_format($totalBuyCost,2,'.',',')."</td>
		</tr>";
	}
	elseif($bs=="SALE")
	{
		echo "
		<tr>
		<td colspan=4 align=right><b>SUB TOTAL</b></td>
		<td align=right>".number_format($totalSALE,2,'.',',')."</td>
		<td align=right>".number_format($totalSALEComm,2,'.',',')."</td>
		<td align=right>".number_format($totalSALECost,2,'.',',')."</td>
		</tr>";
	}
	?>
	</table>
	<br>
	
	<center>
	<table border=1 cellpadding=5 cellspacing=0 class=ver15 style="border-collapse:collapse; border:2px solid #000000">
	<tr>
		<td rowspan=2 width=120 align=center>SUMMARY</td>
		<td align=right width=140>TOTAL BUY</td>
		<td align=right width=140>TOTAL SALE</td>
		<td align=right>TOTAL COMMISSION</td>
	</tr>
	<tr>
		<td align=right><?php echo number_format($totalBuy,2,'.',','); ?></td>
		<td align=right><?php echo number_format($totalSALE,2,'.',','); ?></td>
		<td align=right><?php echo number_format($totalBuyComm + $totalSALEComm,2,'.',','); ?></td>
	</tr>
	</table>
	<br>
	<br>
	<hr>
	<i>THIS IS A COMPUTER GENERATED PRINTOUT. SIGNATURE NOT MANDATORY.</i>
	</center>


	<!-- pg end -->
	<?php mysql_close($dbcon); ?>

	</td></tr></table></div>
	</body>
	</html>
	<?php
}
else { echo "INVALID INPUT"; }
?>
