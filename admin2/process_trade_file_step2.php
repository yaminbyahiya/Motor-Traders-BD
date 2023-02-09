<?php
require_once("files/common_top.php");
require_once("files/session.php");

if(isset($_POST['submitProcess']))
{
	$sl = $_POST['sl'];
	$id = $_POST['ts'];
	$file = $_POST['file'];
	
	require_once("files/ts.php");
	require_once("files/dbcon.php");
	
	$found = false;
	$sql = "select * from `$db`.`file_upload` where sl='$sl' and ts='$id' and name='$file';";
	$r = mysql_query($sql, $dbcon) or die($sql);
	while($row = mysql_fetch_array($r))
	{
		$found = true;
	
		$xmlstring = file_get_contents("upload/".$file);
		$xml = simplexml_load_string($xmlstring);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);

		$trades = count($array['Detail']);

		for($i=0; $i<$trades; $i++)
		{
			$Action = $array['Detail'][$i]['@attributes']['Action'];
			$Status = $array['Detail'][$i]['@attributes']['Status'];
			$ISIN = $array['Detail'][$i]['@attributes']['ISIN'];
			$AssetClass = $array['Detail'][$i]['@attributes']['AssetClass'];
			$OrderID = $array['Detail'][$i]['@attributes']['OrderID'];
			$RefOrderID = $array['Detail'][$i]['@attributes']['RefOrderID'];
			$Side = $array['Detail'][$i]['@attributes']['Side'];
			$BOID = $array['Detail'][$i]['@attributes']['BOID'];
			$SecurityCode = $array['Detail'][$i]['@attributes']['SecurityCode'];
			$Board = $array['Detail'][$i]['@attributes']['Board'];
			$Date = $array['Detail'][$i]['@attributes']['Date'];
			$Time = $array['Detail'][$i]['@attributes']['Time'];
			$Quantity = $array['Detail'][$i]['@attributes']['Quantity'];
			$Price = $array['Detail'][$i]['@attributes']['Price'];
			$Value = $array['Detail'][$i]['@attributes']['Value'];
			$ExecID = $array['Detail'][$i]['@attributes']['ExecID'];
			$Session = $array['Detail'][$i]['@attributes']['Session'];
			$FillType = $array['Detail'][$i]['@attributes']['FillType'];
			$Category = $array['Detail'][$i]['@attributes']['Category'];
			$CompulsorySpot = $array['Detail'][$i]['@attributes']['CompulsorySpot'];
			$ClientCode = $array['Detail'][$i]['@attributes']['ClientCode'];
			$TraderDealerID = $array['Detail'][$i]['@attributes']['TraderDealerID'];
			$OwnerDealerID = $array['Detail'][$i]['@attributes']['OwnerDealerID'];
			$TradeReportType = $array['Detail'][$i]['@attributes']['TradeReportType'];
			
			$ts = time();
			$now = date('Y-m-d H:i:s', $ts);

			$sql2 = "replace into `$db`.`trades` values ('', '$Action', '$Status', '$ISIN', '$AssetClass', '$OrderID', '$RefOrderID', '$Side', '$BOID', '$SecurityCode', '$Board', '$Date', '$Time', '$Quantity', '$Price', '$Value', '$ExecID', '$Session', '$FillType', '$Category', '$CompulsorySpot', '$ClientCode', '$TraderDealerID', '$OwnerDealerID', '$TradeReportType', '$now');";
			mysql_query($sql2, $dbcon) or die($sql2);
		}
	}
	
	if($found==true)
	{
		$sql = "update `$db`.`file_upload` set processBy='$u', processOn='$now', remarks='$trades trade info found' where sl='$sl' and ts='$id' and name='$file';";
		mysql_query($sql, $dbcon) or die($sql);
	}

	mysql_close($dbcon);

	echo "<script>alert('Process DONE')</script>";
}

die("<script>window.location='process_trade_file.php';</script>");
?>
