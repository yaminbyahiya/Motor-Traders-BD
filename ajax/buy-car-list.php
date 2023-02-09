<?php
date_default_timezone_set('Asia/Dhaka');

if(isset($_REQUEST['sort']))
{
	$sort = $_REQUEST['sort'];
	$cond = $_REQUEST['condition'];
	$brnd = $_REQUEST['brand'];
	$modl = $_REQUEST['model'];
	$pric = $_REQUEST['price'];
	$mile = $_REQUEST['mileage'];
	$locn = $_REQUEST['location'];
	$boostName = $_REQUEST['boostName'];
	
	if($sort=="NewPost") { $orderby = "t1.sl desc"; }
	elseif($sort=="MinMax") { $orderby = "t1.price asc"; }
	elseif($sort=="MaxMin") { $orderby = "t1.price desc"; }
	
	$where = "";
	if($cond=="All") {} else { $where .= "and t1.conditions='$cond' "; }
	if($brnd=="All") {} else { $where .= "and t1.brand='$brnd' "; }
	if($modl=="All") {} else { $where .= "and t1.model='$modl' "; }
	if($pric=="All") {} else { $tmp = explode(',',$pric); $where .= "and t1.price between ".$tmp[0]." and ".$tmp[1]." "; }
	if($mile=="All") {} else { $tmp = explode(',',$mile); $where .= "and t1.mileage between ".$tmp[0]." and ".$tmp[1]." "; }
	if($locn=="All") {} else { $where .= "and t1.location='$locn' "; }
	if($boostName=="All") {} else { $where .= "and t1.boostName='$boostName' "; }
	
	require('../files/dbcon.php');
	$i = -1;
	
	$sql = "select t1.pid, t1.brand, t1.model, t1.modelyr, t1.mileage, t1.fueltype, t1.price, t2.thumb from `$db`.`mt_sell_car` t1, `$db`.`mt_sell_car_pic` t2 where t1.status='y' and t1.hidepost='n' and t1.pid=t2.pid ".$where."order by $orderby limit 0,15;";
	//file_put_contents("error.txt", "$sql"."\r\n\r\n", FILE_APPEND);
	$r = mysqli_query($dbcon, $sql) or die(file_put_contents("error.txt", "$sql"."\r\n\r\n", FILE_APPEND));
	while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
	{
		$pid[] = $row['pid'];
		$thumb[] = $row['thumb'];
		$price[] = $row['price'];
		$brand[] = $row['brand'];
		$model[] = $row['model'];
		$mileage[] = $row['mileage'];
		$fueltype[] = $row['fueltype'];
		$modelyr[] = $row['modelyr'];
		++$i;
	}
	
	mysqli_close($dbcon);
	
	$data[] = $pid;
	$data[] = $thumb;
	$data[] = $price;
	$data[] = $brand;
	$data[] = $model;
	$data[] = $mileage;
	$data[] = $fueltype;
	$data[] = $modelyr;
	$data[] = $i;

	echo json_encode($data);
	
	//file_put_contents("text.txt", "$sql\r\n", FILE_APPEND);
}
?>
