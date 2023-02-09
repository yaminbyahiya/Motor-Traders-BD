<?php session_start();
require('files/session.php');
require('files/ts.php');

/* if($u!="" && $session==true) { $tmpId = $ts.rand(100,999); } else { die("<script>window.location='index.php?lang=En';</script>"); } */

function fnSetLocBySession($loc) {
	if($loc=="bd") { return ""; }
	elseif($loc=="dhk") { return "and t1.location='Dhaka' "; }
	elseif($loc=="ctg") { return "and t1.location='Chittagong' "; }
	elseif($loc=="raj") { return "and t1.location='Rajshahi' "; }
	elseif($loc=="khu") { return "and t1.location='Khulna' "; }
	elseif($loc=="bar") { return "and t1.location='Barishal' "; }
	elseif($loc=="syl") { return "and t1.location='Sylhet' "; }
	elseif($loc=="ran") { return "and t1.location='Rangpur' "; }
	elseif($loc=="mym") { return "and t1.location='Mymensingh' "; }
	else { return ""; }
}
function fnCrLac2($n) {
	if($n>999)
	{
		if($n>9999999) {
			return substr($n, 0, strlen($n)-7).",".substr(substr($n, -7), 0, 2).",".substr(substr($n, -5), 0, 2).",".substr($n, -3);
		}
		elseif($n>99999) {
			return substr($n, 0, strlen($n)-5).",".substr(substr($n, -5), 0, 2).",".substr($n, -3);
		}
		else {
			return substr($n, 0, strlen($n)-3).",".substr($n, -3);
		}
	}
	else {
		return $n;
	}
}

require('files/dbcon.php');

$searchBoxTxt = "";
$submitFromIndexPg = false;

//submit from index page
if(isset($_POST['submitSearch']) && isset($_POST['selectBrand']) && isset($_POST['selectModel']) && isset($_POST['selectPrice']) && isset($_POST['selectMileage']) && isset($_POST['selectLocation']) && isset($_POST['condition']))
{
	$submitFromIndexPg = true;
	$search_filter = "";
	if($_POST['selectBrand']=="All") {} else { $search_filter.= "and t1.brand='".$_POST['selectBrand']."' "; }
	if($_POST['selectModel']=="All") {} else { $search_filter.= "and t1.model='".$_POST['selectModel']."' "; }
	if($_POST['selectPrice']=="All") {} else { $tmp = explode(",", $_POST['selectPrice']); $search_filter.= "and t1.price between '$tmp[0]' and '$tmp[1]' "; }
	if($_POST['selectMileage']=="All") {} else { $tmp = explode(",", $_POST['selectMileage']); $search_filter.= "and t1.mileage between '$tmp[0]' and '$tmp[1]' "; }
	if($_POST['selectLocation']=="All") {} else { $search_filter.= "and t1.location='".$_POST['selectLocation']."' "; }
	if($_POST['condition']=="Used") { $search_filter.= "and t1.conditions='Used' "; } else { $search_filter.= "and t1.conditions='New' "; }
}
// search submit from this page
elseif(isset($_POST['submitThisSearch']) && isset($_POST['selectBrand']) && isset($_POST['selectModel']) && isset($_POST['selectPrice']) && isset($_POST['selectMileage']) && isset($_POST['selectLocation']) && isset($_POST['condition']) && isset($_POST['boostName']) && isset($_POST['verification']))
{
	$submitFromIndexPg = true;
	$search_filter = "";
	if($_POST['selectBrand']=="All") {} else { $search_filter.= "and t1.brand='".$_POST['selectBrand']."' "; }
	if($_POST['selectModel']=="All") {} else { $search_filter.= "and t1.model='".$_POST['selectModel']."' "; }
	if($_POST['selectPrice']=="All") {} else { $tmp = explode(",", $_POST['selectPrice']); $search_filter.= "and t1.price between '$tmp[0]' and '$tmp[1]' "; }
	if($_POST['selectMileage']=="All") {} else { $tmp = explode(",", $_POST['selectMileage']); $search_filter.= "and t1.mileage between '$tmp[0]' and '$tmp[1]' "; }
	if($_POST['selectLocation']=="All") {} else { $search_filter.= "and t1.location='".$_POST['selectLocation']."' "; }
	if($_POST['condition']=="All"){}elseif($_POST['condition']=="Used") { $search_filter.= "and t1.conditions='Used' "; } else { $search_filter.= "and t1.conditions='New' "; }
	if($_POST['boostName']=="All") {} else { $search_filter.= "and t1.boostName='".$_POST['boostName']."' "; }
	if($_POST['verification']=="All") {} elseif($_POST['verification']=="un_verified") { $search_filter.= "and t1.verifyOn IS NULL "; } else {$search_filter.= "and t1.verifyOn IS NOT NULL "; }
}
//page no. click from this page
elseif(isset($_REQUEST['pg']) && isset($_REQUEST['tpg']) && isset($_REQUEST['searchFilter']))
{
	$search_filter = $_REQUEST['searchFilter'].' ';
	$search_filter = str_replace("~", "'", $search_filter);
	$search_filter = str_replace("()", "=", $search_filter);
}
elseif(isset($_REQUEST['tab']) && isset($_REQUEST['value']))
{
	$tab = $_REQUEST['tab'];
	$value = $_REQUEST['value'];
	$search_filter = "";
	if($tab=="brand") { $search_filter = "and t1.brand='".$value."' "; }
	elseif($tab=="city") { $search_filter = "and t1.location='".$value."' "; }
	elseif($tab=="price") { $tmp = explode("-", $value); $search_filter = "and t1.price between '". $tmp[0]*100000 ."' and '". $tmp[1]*100000 ."' "; }
	elseif($tab=="type") { $search_filter = "and t1.type like '%".$value."%' "; }
	elseif($tab=="boostName") { $search_filter = "and t1.boostName like '%".$value."%' "; }
}
elseif(isset($_POST['searchbox']))
{
	$submitFromIndexPg = true;
	$searchBoxOnly = 2;
	$searchBoxTxt = trim($_POST['searchbox']);
	
	$searchBox = explode(" ", $searchBoxTxt);
	$src = array_values(array_unique($searchBox));
	
	$search_filter = "";
	$search_filter.= "(t1.model LIKE '%$searchBoxTxt%' OR t1.brand LIKE '%$searchBoxTxt%'";
	if($search_filter!="")
	{
		$search_filter.= ")";
		
		$sqlForSearchOnly = "select count(t1.pid) from `$db`.`mt_sell_car` t1 where t1.status='y' and t1.hidepost='n' and $search_filter;";
		$r = mysqli_query($dbcon, $sqlForSearchOnly) or die($sqlForSearchOnly);
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH)) { $sfound = $row[0]; }
		$search_filter = "and $search_filter ";
	}
}
else { $search_filter = fnSetLocBySession($setLoc); }

	$pgPostShow = 12;
	$totalPost = 0;
	if(isset($_REQUEST['pg']) && isset($_REQUEST['tpg'])) {
		$curPg = $_REQUEST['pg'];
		$totalPg = $_REQUEST['tpg'];
	}else {
	$curPg = 1;
	$totalPg = 1;
	
	if($submitFromIndexPg==true)
	{
		//start checking if searching by model name 
		if(isset($searchBoxOnly)){
			$r = mysqli_query($dbcon, $sqlForSearchOnly) or die($sqlForSearchOnly);
			while($row = mysqli_fetch_array($r, MYSQLI_BOTH)) { $totalPost = $row[0]; }
		}else{
			$sql = "select count(pid) from `$db`.`mt_sell_car` where status='y' and hidepost='n' ";
			if($_POST['selectBrand']=="All") {} else { $sql.= "and brand='".$_POST['selectBrand']."' "; }
			if($_POST['selectModel']=="All") {} else { $sql.= "and model='".$_POST['selectModel']."' "; }
			if($_POST['selectPrice']=="All") {} else { $tmp = explode(",", $_POST['selectPrice']); $sql.= "and price between '$tmp[0]' and '$tmp[1]' "; }
			if($_POST['selectMileage']=="All") {} else { $tmp = explode(",", $_POST['selectMileage']); $sql.= "and mileage between '$tmp[0]' and '$tmp[1]' "; }
			if($_POST['selectLocation']=="All") {} else { $sql.= "and location='".$_POST['selectLocation']."' "; }
			if($_POST['condition']=="Used") { $sql.= "and conditions='Used' "; } else { $sql.= "and conditions='New' "; }
			if(isset($_POST['boostName'])){
				if($_POST['boostName']=="All") {} else { $sql.= "and boostName='".$_POST['boostName']."' "; }
			}
			if(isset($_POST['verification'])){
				if($_POST['verification']=="All") {} elseif($_POST['verification']=="verified") { $sql.= "and verifyOn IS NOT NULL "; } elseif($_POST['verification']=="un_verified") { $sql.= "and verifyOn IS NULL "; }
			}
			
			$sql.= ";";
			$r = mysqli_query($dbcon, $sql) or die($sql);
			while($row = mysqli_fetch_array($r, MYSQLI_BOTH)) { $totalPost = $row[0]; }
		}
		 		
		
		// var_dump($totalPost);
		// die();
		
	}
	else
	{
		$sql = "select count(pid) from `$db`.`mt_sell_car` where status='y' and hidepost='n';";
		$r = mysqli_query($dbcon, $sql) or die($sql);
		while($row = mysqli_fetch_array($r, MYSQLI_BOTH)) { $totalPost = $row[0]; }
	}
	
	if($totalPost>0)
	{
		$totalPg = (int)($totalPost / $pgPostShow);
		if($totalPg * $pgPostShow == $totalPost) {}
		else { $totalPg++; }
		
	}
}

if($curPg==1) { $prvPg = $totalPg; } else { $prvPg = $curPg - 1; }
if($curPg==$totalPg) { $nxtPg = 1; } else { $nxtPg = $curPg + 1; }
$startPg = ($curPg - 1) * $pgPostShow;	//for sql

?>

<!DOCTYPE html>
<html>

<head>
<?php require('files/head.php'); ?>
<style>
.boost {
    position: absolute;
    left: 0px;
    top: 0px;
    color: #FFCF00;
    font-size: 12px;
    font-weight: 400;
    padding: 0px 6px;
    background-color: #000;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -webkit-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    -o-transition: all 0.3s ease;
}
</style>
</head>

<body>
<div class="page-wrapper">

  <!-- Preloader -->
  <div class="preloader"></div>

  <?php $menu='buy-car'; require('files/header.php'); ?>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/buy-a-car.png);">
        <div class="auto-container">
            <h1>Buy A Car</h1>
        </div>
    </section>
    <!--End Page Title-->

    <!--Page Info-->
    <section class="page-info">
        <div class="auto-container">
            <ul class="bread-crumb">
                <li><a href="index.php">Home</a></li>
                <li>Pages</li>
                <li class="current">Buy A Car</li>
            </ul>
        </div>
    </section>
    <!--End Page Info-->

    <!--Inventory Section-->
    <section class="inventory-section">
    	<div class="auto-container">
        	<div class="row clearfix">

            	<script>
				var selsrt = "NewPost";
				var selcon = "All";
				var selbrn = "All";
				var selmod = "All";
				var selprc = "All";
				var selmil = "All";
				var selloc = "All";
				var selboostName = "All";
				
				function number_format(number, decimals, dec_point, thousands_sep)
				{
					// Strip all characters but numerical ones.
					number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
					var n = !isFinite(+number) ? 0 : +number,
						prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
						sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
						dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
						s = '',
						toFixedFix = function (n, prec) {
							var k = Math.pow(10, prec);
							return '' + Math.round(n * k) / k;
						};
					// Fix for IE parseFloat(0.55).toFixed(0) = 0;
					s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
					if (s[0].length > 3) {
						s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
					}
					if ((s[1] || '').length < prec) {
						s[1] = s[1] || '';
						s[1] += new Array(prec - s[1].length + 1).join('0');
					}
					return s.join(dec);
				}
				
				function fnCrLac2(n)
				{
					var tk = 0;
					if(n>9999999) {				/* 1 cr ++ */
						tk = n.substr(0,n.length-7) + "," + n.substr(-7,2) + "," + n.substr(-5,2) + "," + n.substr(-3);
					}
					else if(n>99999) {			/* 1 lac ++ */
						tk = n.substr(0,n.length-5) + "," + n.substr(-5,2) + "," + n.substr(-3);
					}
					else if(n>999) {			/* 1 k ++ */
						tk = n.substr(0,n.length-3) + "," + n.substr(-3);
					}
					else {
						tk = n;
					}
					return tk;
				}
				
				function fnListSort(selection)
				{
					var selSort = document.getElementById("selectSort").value;
					var selCond = document.getElementById("selectCondition").value;
					var selBrnd = document.getElementById("selectBrand").value;
					var selModl = document.getElementById("selectModel").value;
					var selPric = document.getElementById("selectPrice").value;
					var selMile = document.getElementById("selectMileage").value;
					var selLocn = document.getElementById("selectLocation").value;
					var selBoostName = document.getElementById("selectBoostName").value;
					
					if(selection=='sort') { if(selsrt==selSort) { return false; } else { selsrt = selSort; } }
					if(selection=='cond') { if(selcon==selCond) { return false; } else { selcon = selCond; } }
					if(selection=='brnd') { if(selbrn==selBrnd) { return false; } else { selbrn = selBrnd; } }
					if(selection=='modl') { if(selmod==selModl) { return false; } else { selmod = selModl; } }
					if(selection=='pric') { if(selprc==selPric) { return false; } else { selprc = selPric; } }
					if(selection=='mile') { if(selmil==selMile) { return false; } else { selmil = selMile; } }
					if(selection=='locn') { if(selloc==selLocn) { return false; } else { selloc = selLocn; } }
					if(selection=='boostName') { if(selboostName==selBoostName) { return false; } else { selboostName = selBoostName; } }
					
					document.getElementById("mt-buy-list").innerHTML = "Loading....";
					window.setTimeout(function(){}, 2000);
					
					$.ajax({
						url: 'ajax/buy-car-list.php?sort='+selSort+'&condition='+selCond+'&brand='+selBrnd+'&model='+selModl+'&price='+selPric+'&mileage='+selMile+'&location='+selLocn+'&boostName='+selBoostName,
						data: "",
						dataType: 'json',
						success: function(data)
						{
							var list = "";
							var tk = 0;
							console.log(data);
							var numberOfPost = (data[0].length);
							
							for (var i=0; i<=data[8]; i++)
							{
								tk = 0;
								// if(data[2][i]>0) { tk = "<font color='#242628'>৳ "+ number_format(data[2][i],0,'.',',') +"</font>"; }
								if(data[2][i]>0) { tk = "<font color='#242628'>৳ " + fnCrLac2(data[2][i]) + "</font>"; }
								else { tk = "<a href='vehicle_details.php?pid="+data[0][i]+"#seller' style='color:#242628'>ask for price</a>"; }
								
								list = list + "<div class='car-block col-lg-4 col-md-6 col-sm-6 col-xs-12'><div class='inner-box'><div class='image'><a href='vehicle_details.php?pid="+data[0][i]+"'><img src='post_pic/"+data[0][i]+"_"+data[1][i]+"' height=168 alt='' /></a><div class='price'>"+tk+"</div></div><h3><a href='vehicle_details.php?pid="+data[0][i]+"'>"+data[3][i]+" "+data[4][i]+"</a></h3><div class='lower-box'><ul class='car-info'><li title='Mileage'><span class='icon fa fa-road'></span>"+data[5][i]+" km</li><li title='Fuel Type'><span class='icon fa fa-tint'></span>"+data[6][i]+"</li><li title='Model Year'><span class='icon fa fa-car'></span>"+data[7][i]+"</li><li title='Add to compare'><a style='color:#000' onclick='fnCompareInput('"+data[0][i]+"')'><span class='icon fa fa-balance-scale'></span>+</a></li></ul></div></div></div>";
							}
							
							
							document.getElementById("mt-buy-list").innerHTML = list;
							//document.getElementById("remove-ajax").innerHTML = list;
						}
					});
					
					//clear compare
					var a = document.getElementById('item1');
					var b = document.getElementById('item2');
					a.value = 1;		b.value = 2;
					document.getElementById('spnComp').innerHTML = "";
					document.getElementById('divCompare').style.display = "none";
				}
				</script>
				
				<!--Column-->
            	<div class="column col-lg-9 col-md-8 col-sm-12 col-xs-12">
                	<div class="layout-box clearfix">
                    	<div class="pull-left">
                        	<div class="sort-form">
                                <form action="inventory-form">
                                    <!--
									<div class="form-group">
                                        <label>Sort By:</label>
                                        <select class="custom-select-box"onclick='alert("123")'>
                                            <option value='NewPost'>Newest Post</option>
											<option value='MinMax'>Price (Min &rarr; Max)</option>
											<option value='MaxMin'>Price (Max &rarr; Min)</option>
                                        </select>
                                    </div>
									-->
									<div class="form-group">
                                        <label>Sort By:</label>
                                        <select name='selectSort' id='selectSort' class='' style='display:inline-block; padding:10px; background-color:#F2F2F2; margin-left:60px; width:250px;' onchange="fnListSort('sort')">
                                            <option value='NewPost'>Newest Post</option>
											<option value='MinMax'>Price (Min &rarr; Max)</option>
											<option value='MaxMin'>Price (Max &rarr; Min)</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="pull-right">
                        	<!--<ul class="view-options">
                            	<li class="active"><a href="inventory-1.html"><span class="fa fa-th-large"></span></a></li>
                                <li><a href="inventory-2.html"><span class="flaticon-list"></span></a></li>
                            </ul>-->
                        </div>
                    </div>
                    <!--End Sec Title-->

                    <div class="row clearfix" id='mt-buy-list'>
                        <script>
						function fnMTRptEmail(uid, pid)
						{
							if(uid==null || uid=="") { alert('Please login first and then request again.'); }		/* window.location='account.php'; */
							else
							{
								var min = 100000;
								var max = 999999;
								var rnd = Math.floor(Math.random() * (max - min) + min);
								
								var input = prompt("Please type : " + rnd, "");
								if(rnd==input)
								{
									$.ajax({
										url: 'emails/mt-report_request.php?eml=<?php echo $ue; ?>&uid=<?php echo $u; ?>&name=<?php echo $un; ?>&pid='+pid,
										data: "",
										dataType: 'json',
										success: function(data)
										{
										}
									});
									alert("Your request has been sent to MotorTrader Admin. Please wait for a reply via email.");
								}
								else if(input=='' || input=="" || input==null) {}
								else
								{
									alert("Invalid request. Please try again.");
								}
							}
						}
						</script>
						
						<?php
						$sql = "select t1.pid, t1.brand, t1.model, t1.modelyr, t1.mileage, t1.fueltype, t1.price, t2.thumb, t2.mtrpt, t1.boostName, t1.sl from `$db`.`mt_sell_car` t1, `$db`.`mt_sell_car_pic` t2 where t1.status='y' and t1.hidepost='n' and t1.pid=t2.pid ".$search_filter."order by t1.sl desc limit $startPg, $pgPostShow;";
						//echo $sql;
						$r = mysqli_query($dbcon, $sql) or die($sql);
						while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
						{
							$sl = $row['sl'];
							$mtrpt = $row['mtrpt'];
							$price = $row['price'];
							$boostName = $row['boostName'];
							$mileage = $row['mileage'];
							?>
							<!--Car Block-->
							<div class="car-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
								<div class="inner-box">
									<div class="image">
										<a href="vehicle_details.php?pid=<?php echo $row['pid']; ?>"><img src="post_pic/<?php echo $row['pid']."_".$row['thumb']; ?>" height=168 alt="<?php echo 'motortrader-'.$row['brand'].'-'.$row['model']; ?>" style='object-fit: cover;' /></a>
										<?php
										if($boostName=="urgent") { echo "<svg class='boost' id='Layer_1' width='84' height='25' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 50'><defs><style>.cls-1{fill:#ed1c24;}.cls-2{fill:#fff;}</style></defs><rect width='200' height='50'/><path class='cls-1' d='M175,2a23,23,0,1,1-23,23A23,23,0,0,1,175,2m0-2a25,25,0,1,0,25,25A25,25,0,0,0,175,0Z'/><circle class='cls-1' cx='175' cy='25' r='20'/><path class='cls-2' d='M16.42,17.28h2.27v11c0,3.2,1.73,4.57,4.3,4.57s4.27-1.37,4.27-4.57v-11h2.28v11c0,4.53-3,6.6-6.57,6.6s-6.55-2.07-6.55-6.6Z'/><path class='cls-2' d='M41.47,17.28c4.09,0,6,2.27,6,5.12a4.91,4.91,0,0,1-4.15,5l4.38,7.3H45l-4.14-7.13H38.12V34.7H35.84V17.28Zm0,1.87H38.12v6.6h3.35c2.57,0,3.69-1.4,3.69-3.35S44.06,19.15,41.47,19.15Z'/><path class='cls-2' d='M69.46,22.32H66.74a5.56,5.56,0,0,0-5.3-3.19C57.77,19.13,55,21.77,55,26s2.75,6.83,6.42,6.83a5.87,5.87,0,0,0,6.12-5.65h-7V25.3H70v1.75a8.46,8.46,0,0,1-8.55,7.8A8.58,8.58,0,0,1,52.69,26a8.59,8.59,0,0,1,8.75-8.89A8.24,8.24,0,0,1,69.46,22.32Z'/><path class='cls-2' d='M84.86,19.13H77.77V25h6.34v1.87H77.77v6h7.09V34.7H75.49V17.25h9.37Z'/><path class='cls-2' d='M104.51,17.25V34.7h-2.27L93.09,20.83V34.7H90.82V17.25h2.27l9.15,13.85V17.25Z'/><path class='cls-2' d='M109.82,17.28h11.79v1.85h-4.75V34.7h-2.27V19.13h-4.77Z'/></svg>"; }
										elseif($boostName=="top") { echo "<svg id='Layer_1' class='boost' width='84' height='25' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 50'><defs><style>.cls-11{fill:#fff;}.cls-22{fill:#ffcf00;}</style></defs><rect width='200' height='50'/><path class='cls-11' d='M16.47,17.4h2.45l6.39,14.3,6.4-14.3h2.43V34.7H31.86V21.8L26.11,34.7h-1.6L18.74,21.77V34.7H16.47Z'/><path class='cls-11' d='M39.42,17.28H51.21v1.85H46.46V34.7H44.19V19.13H39.42Z'/><path class='cls-11' d='M72.19,34.7h-6.5V17.28h6.25c3.67,0,5.52,2,5.52,4.42a4.07,4.07,0,0,1-3,4A4.35,4.35,0,0,1,77.86,30C77.86,32.65,75.79,34.7,72.19,34.7Zm-.45-15.55H68V24.8h3.83c2.12,0,3.35-1.05,3.35-2.82S74,19.15,71.74,19.15Zm.17,7.52H68v6.15h4c2.25,0,3.6-1.12,3.6-3S74.14,26.67,71.91,26.67Z'/><path class='cls-11' d='M83.47,17.28h2.27v11c0,3.2,1.72,4.57,4.3,4.57s4.27-1.37,4.27-4.57v-11h2.28v11c0,4.53-3,6.6-6.58,6.6s-6.54-2.07-6.54-6.6Z'/><path class='cls-11' d='M102.89,17.4h2.45l6.4,14.3,6.4-14.3h2.42V34.7h-2.27V21.8l-5.75,12.9h-1.6l-5.77-12.93V34.7h-2.28Z'/><path class='cls-11' d='M132.54,27.42h-3.35V34.7h-2.27V17.28h5.62c4.1,0,6,2.25,6,5.1C138.56,25,136.86,27.42,132.54,27.42Zm0-1.87c2.6,0,3.7-1.23,3.7-3.17s-1.1-3.23-3.7-3.23h-3.35v6.4Z'/><path class='cls-22' d='M175,2a23,23,0,1,1-23,23A23,23,0,0,1,175,2m0-2a25,25,0,1,0,25,25A25,25,0,0,0,175,0Z'/><circle class='cls-22' cx='175' cy='25' r='20'/></svg>"; }
										elseif($boostName=="bump") { echo "<svg id='Layer_1' class='boost' width='84' height='25' data-name='Layer 1' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 50'><defs><style>.cls-12{fill:#00b704;}.cls-23{fill:#fff;}</style></defs><rect width='200' height='50'/><path class='cls-12' d='M175,2a23,23,0,1,1-23,23A23,23,0,0,1,175,2m0-2a25,25,0,1,0,25,25A25,25,0,0,0,175,0Z'/><circle class='cls-12' cx='175' cy='25' r='20'/><path class='cls-23' d='M15.39,17.28h11.8v1.85H22.44V34.7H20.17V19.13H15.39Z'/><path class='cls-23' d='M40.39,34.87A8.59,8.59,0,0,1,31.64,26a8.75,8.75,0,1,1,17.5,0A8.58,8.58,0,0,1,40.39,34.87Zm0-2c3.67,0,6.42-2.68,6.42-6.93s-2.75-6.92-6.42-6.92S34,21.7,34,26,36.71,32.9,40.39,32.9Z'/><path class='cls-23' d='M60.27,27.42H56.92V34.7H54.64V17.28h5.63c4.09,0,6,2.25,6,5.1C66.29,25,64.59,27.42,60.27,27.42Zm0-1.87c2.59,0,3.69-1.23,3.69-3.17s-1.1-3.23-3.69-3.23H56.92v6.4Z'/><path class='cls-23' d='M80.79,17.4h2.45l6.4,14.3L96,17.4h2.42V34.7H96.19V21.8L90.44,34.7h-1.6L83.07,21.77V34.7H80.79Z'/><path class='cls-23' d='M103.74,17.28h11.8v1.85h-4.75V34.7h-2.27V19.13h-4.78Z'/></svg>"; }
										?>
										
										<div class="price"><?php if($price==0 || $price=="" || $price==null) { echo "<a href='vehicle_details.php?pid=".$row['pid']."#seller' style='color:#242628'>ask for price</a>"; } else { echo "<font color='#242628'>৳ ".fnCrLac2($price)."</font>"; } ?></div>
									</div>
									
									<h3><a href="vehicle_details.php?pid=<?php echo $row['pid']; ?>"><?php echo $row['brand']." ".$row['model']; ?></a></h3>
									
									<!--<h3><a href="vehicle_details.php?pid=<?php echo $row['pid']; ?>" <?php if($mtrpt=="" || $mtrpt==null) { echo ">"; } else { echo "title='MT VERIFIED'><font size=3 color='#008800'><span class='icon fa fa-check-square'></span></font> &nbsp;"; } echo $row['brand']." ".$row['model']; ?></a></h3>-->
									
									<div class="lower-box">
										<ul class="car-info">
											<li title='Mileage'><span class="icon fa fa-road"></span><?php if($mileage==0 || $mileage=="" || $mileage==null) { echo "<a href='vehicle_details.php?pid=".$row['pid']."#seller' style='color:#242628'>Ask Seller</a>"; } else { echo "$mileage km"; } ?></li>
											<li title='Model Year'><span class="icon fa fa-car"></span><?php echo $row['modelyr']; ?></li>
											<li title='Add to compare'><a style='color:#000' onclick='fnCompareInput("<?php echo $row['pid']; ?>")'><span class="icon fa fa-balance-scale"></span>&nbsp;add to compare</a></li>
											<li title='MTReport'><span class="icon fa fa-file-text"></span>&nbsp;<?php if($mtrpt=="" || $mtrpt==null) { echo "<a onclick='fnMTRptEmail(\"$u\", \"".$row['pid']."\")' style='color:#000;'>request for MTReport</a>"; } else { $tok=md5($row['pid']); echo "<a style='color:#000;' href='mt-report_download.php?pid=".$row['pid']."&token=$tok&session=".str_rot13($tok)."'>download MTReport</a>"; } ?></li>
										</ul>
									</div>
								</div>
								
							</div>
							<?php
						}
						
						mysqli_close($dbcon);
						?>
                    </div>
					
					
					<!--Styled Pagination-->
					<?php
					$search_filter = str_replace("'", "~", $search_filter);
					$search_filter = str_replace("=", "()", $search_filter);
					?>
                    <div class="styled-pagination text-center">
                        <ul class="clearfix remove-ajax">
                            <li><a href="buy-car.php?pg=<?php echo "$prvPg&tpg=$totalPg&searchFilter=$search_filter"; ?>"><span class="fa fa-caret-left"></span></a></li>
							<?php
							if($curPg>3) {
								for($i=$curPg-3; $i<$curPg; $i++) { echo "<li><a href='buy-car.php?pg=$i&tpg=$totalPg&searchFilter=$search_filter'>$i</a></li>"; }
							}
							else {
								for($i=1; $i<$curPg; $i++) { echo "<li><a href='buy-car.php?pg=$i&tpg=$totalPg&searchFilter=$search_filter'>$i</a></li>"; }
							}
							?>
							<li><a class="active"><?php echo $curPg; ?></a></li>
                            <?php
							if($totalPg-$curPg>3) {
								for($i=$curPg+1; $i<=$curPg+3; $i++) { echo "<li><a href='buy-car.php?pg=$i&tpg=$totalPg&searchFilter=$search_filter'>$i</a></li>"; }
							}
							else {
								for($i=$curPg+1; $i<=$totalPg; $i++) { echo "<li><a href='buy-car.php?pg=$i&tpg=$totalPg&searchFilter=$search_filter'>$i</a></li>"; }
							}
							?>
                            <li><a href="buy-car.php?pg=<?php echo "$nxtPg&tpg=$totalPg&searchFilter=$search_filter"; ?>"><span class="fa fa-caret-right"></span></a></li>
                        </ul>
                    </div>
                    <!--End Styled Pagination-->

                </div>

				
                <!--Form Column-->
                <div class="form-column col-lg-3 col-md-4 col-sm-12 col-xs-12">

                    <!-- Search Box -->
                    <div class="faq-search-box">
                    	<div class="outer-box">
                            <form name='frmsearch' method="post" action="buy-car.php">
                                <div class="form-group">
                                    <input type="search" name="searchbox" value="<?php echo $searchBoxTxt; ?>" placeholder="Search" required>
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--Select Car Tabs-->
                    <div class="select-cars-tabs">
                        <!--Tabs Box-->
                        <div class="prod-tabs tabs-box">

                            <!--Tab Btns- ->
                            <ul class="tab-btns tab-buttons clearfix">
                                <li data-tab="#prod-new-cars" class="tab-btn active-btn">New Cars</li>
                                <li data-tab="#prod-used-cars" class="tab-btn">Used Cars</li>
                            </ul>
							-->

                            <!--Tabs Container-->
                            <div class="tabs-content">

                                <!--Tab / Active Tab-->
                                <div class="tab active-tab" id="prod-new-cars">
                                    <div class="content">

                                        <div class="sell-car-form" style='padding-top:20px; margin-bottom:15px'>
											<h2>Search Filters</h2>
										</div>
										
<script>
<?php require('files/vehicles.txt'); ?>

function fnBrandModel(s)
{
	var mod = document.getElementById("selectModel");
	mod.options.length = 0;
	
	var sel = s.value;
	var option;
	
	if(sel=='All') {
		option = document.createElement("option");
		option.text = "Any Model";
		option.value = "All";
		mod.add(option);
	}
	else {
		var arr;
		if(sel=='Audi') { arr = audi; }
		else if(sel=='Bentley') { arr = bentley; }
		else if(sel=='BMW') { arr = bmw; }
		else if(sel=='Daihatusu') { arr = daihatusu; }
		else if(sel=='Honda') { arr = honda; }
		else if(sel=='Hyundai') { arr = hyundai; }
		else if(sel=='Infiniti') { arr = infiniti; }
		else if(sel=='Jeep') { arr = jeep; }
		else if(sel=='Kia') { arr = kia; }
		else if(sel=='Land Rover') { arr = landrover; }
		else if(sel=='Lexus') { arr = lexus; }
		else if(sel=='Mercedes') { arr = mercedes; }
		else if(sel=='MG') { arr = mg; }
		else if(sel=='Mitsubishi') { arr = mitsubishi; }
		else if(sel=='Nissan') { arr = nissan; }
		else if(sel=='Porsche') { arr = porsche; }
		else if(sel=='Proton') { arr = proton; }
		else if(sel=='Subaru') { arr = subaru; }
		else if(sel=='Suzuki') { arr = suzuki; }
		else if(sel=='Tata') { arr = tata; }
		else if(sel=='Toyota') { arr = toyota; }
		else if(sel=='Volkswagen') { arr = volkswagen; }
		else if(sel=='Volvo') { arr = volvo; }
		arr.sort();
		
		var option;
		option = document.createElement("option");
		option.text = "Any Model";
		option.value = "All";
		mod.add(option);
		
		for (x of arr) {
			option = document.createElement("option");
			option.text = x;
			mod.add(option);
		}
	}
}
</script>
										<!--Cars Form-->
                                        <div class="cars-form">
                                            <form method="post" action="buy-car.php">

                                                <div class="form-group">
                                                    <label>Condition:</label>
                                                    <select id='' class="" name="condition">
                                                        <option value='All' selected>New/Used Cars</option>
														<option <?php if(isset($_POST['condition'] ) && $_POST['condition']  == 'New') echo"selected"; ?> value='New'>New Cars</option>
                                                        <option <?php if(isset($_POST['condition'] ) && $_POST['condition']  == 'Used') echo"selected"; ?> value='Used'>Used Cars</option>
                                                    </select>
                                                </div>
												
												<div class="form-group">
                                                    <label>Brand:</label>
                                                    <select id='selectedBrand' name='selectBrand' class="custom-select-boxXX" onchange="fnBrandModelNew(this);">
                                                        <option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'All') echo"selected"; ?> value='All' selected>Any Brand</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Audi') echo"selected"; ?> value="Audi">Audi</option><option>Bentley</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'BMW') echo"selected"; ?> value="BMW">BMW</option><option>Daihatusu</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Ford') echo"selected"; ?> value="Ford">Ford</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Honda') echo"selected"; ?> value="Honda">Honda</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Hyundai') echo"selected"; ?> value="Hyundai">Hyundai</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Infiniti') echo"selected"; ?> value="Infiniti">Infiniti</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Isuzu') echo"selected"; ?> value="Isuzu">Isuzu</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Jeep') echo"selected"; ?> value="Jeep">Jeep</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Kia') echo"selected"; ?> value="Kia">Kia</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'LandRover') echo"selected"; ?> value='LandRover'>Land Rover</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Lexus') echo"selected"; ?> value="Lexus">Lexus</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Maruti') echo"selected"; ?> value="Maruti">Maruti</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Mazda') echo"selected"; ?> value="Mazda">Mazda</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Mercedes') echo"selected"; ?> value="Mercedes">Mercedes</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'MG') echo"selected"; ?> value="MG">MG</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Mitsubishi') echo"selected"; ?> value="Mitsubishi">Mitsubishi</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Nissan') echo"selected"; ?> value="Nissan">Nissan</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Porsche') echo"selected"; ?> value="Porsche">Porsche</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Proton') echo"selected"; ?> value="Proton">Proton</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Subaru') echo"selected"; ?> value="Subaru">Subaru</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Suzuki') echo"selected"; ?> value="Suzuki">Suzuki</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Tata') echo"selected"; ?> value="Tata">Tata</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Toyota') echo"selected"; ?> value="Toyota">Toyota</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Volkswagen') echo"selected"; ?> value="Volkswagen">Volkswagen</option>
														<option <?php if(isset($_POST['selectBrand'] ) && $_POST['selectBrand']  == 'Volvo') echo"selected"; ?> value="Volvo">Volvo</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Model:</label>
                                                    <select id='selectModelNew' class="" name="selectModel">
                                                        <option value='All' selected>Any Model</option>
                                                    </select>
                                                </div>
												
												<div class="form-group">
                                                    <label>Price:</label>
                                                    <select id='' class="" name="selectPrice">
                                                        <option value='All' selected>Any Price</option>
                                                        <option <?php if(isset($_POST['selectPrice'] ) && $_POST['selectPrice']  == '0,300000') echo"selected"; ?> value="0,300000">Up to 3 Lakh</option>
                                                        <option <?php if(isset($_POST['selectPrice'] ) && $_POST['selectPrice']  == '300000,500000') echo"selected"; ?> value="300000,500000">Between 3-5 Lakh</option>
                                                        <option <?php if(isset($_POST['selectPrice'] ) && $_POST['selectPrice']  == '500000,1000000') echo"selected"; ?> value="500000,1000000">Between 5-10 Lakh</option>
														<option <?php if(isset($_POST['selectPrice'] ) && $_POST['selectPrice']  == '1000000,1500000') echo"selected"; ?> value="1000000,1500000">Between 10-15 Lakh</option>
														<option <?php if(isset($_POST['selectPrice'] ) && $_POST['selectPrice']  == '1500000,2500000') echo"selected"; ?> value="1500000,2500000">Between 15-25 Lakh</option>
														<option <?php if(isset($_POST['selectPrice'] ) && $_POST['selectPrice']  == '2500000,4000000') echo"selected"; ?> value="2500000,4000000">Between 25-40 Lakh</option>
														<option <?php if(isset($_POST['selectPrice'] ) && $_POST['selectPrice']  == '4000000,99999999') echo"selected"; ?> value="4000000,99999999">Above 40 Lakh</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Mileage:</label>
                                                    <select id='selectMileage' class="" name="selectMileage">
                                                        <option value='All' selected>Any Mileage</option>
                                                        <option <?php if(isset($_POST['selectMileage']) && $_POST['selectMileage'] == '0,100') echo"selected"; ?> value="0,100">Less than 100 KM</option>
                                                        <option <?php if(isset($_POST['selectMileage']) && $_POST['selectMileage'] == '100,15000') echo"selected"; ?> value="100,15000">Between 100-15000 KM</option>
                                                        <option <?php if(isset($_POST['selectMileage']) && $_POST['selectMileage'] == '15000,30000') echo"selected"; ?> value="15000,30000">Between 15000-30000 KM</option>
														<option <?php if(isset($_POST['selectMileage']) && $_POST['selectMileage'] == '30000,45000') echo"selected"; ?> value="30000,45000">Between 30000-45000 KM</option>
														<option <?php if(isset($_POST['selectMileage']) && $_POST['selectMileage'] == '45000,9999999') echo"selected"; ?> value="45000,9999999">Above 45000+ KM</option>
                                                    </select>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label>Verification:</label>
                                                    <select id='' class="" name="verification">
                                                        <option value='All' selected>All</option>
                                                        <option <?php if(isset($_POST['verification'] ) && $_POST['verification']  == 'verified') echo"selected"; ?> value="verified">Verified</option>
                                                        <option <?php if(isset($_POST['verification']) && $_POST['verification'] == 'un_verified') echo"selected"; ?> value="un_verified">Unverified</option>
                                                    </select>
                                                </div>
												
												<div class="form-group">
                                                    <label>Location:</label>
                                                    <select id='' class="" name="selectLocation">
                                                        <option <?php if(isset($_POST['selectLocation'] ) && $_POST['selectLocation']  == 'All') echo"selected"; ?> value='All' selected>Any Location</option>
                                                        <option <?php if(isset($_POST['selectLocation'] ) && $_POST['selectLocation']  == 'Dhaka') echo"selected"; ?> value="Dhaka">Dhaka</option>
														<option <?php if(isset($_POST['selectLocation'] ) && $_POST['selectLocation']  == 'Chittagong') echo"selected"; ?> value="Chittagong">Chittagong</option>
														<option <?php if(isset($_POST['selectLocation'] ) && $_POST['selectLocation']  == 'Rajshahi') echo"selected"; ?> value="Rajshahi">Rajshahi</option>
														<option <?php if(isset($_POST['selectLocation'] ) && $_POST['selectLocation']  == 'Khulna') echo"selected"; ?> value="Khulna">Khulna</option>
														<option <?php if(isset($_POST['selectLocation'] ) && $_POST['selectLocation']  == 'Barishal') echo"selected"; ?> value="Barishal">Barishal</option>
														<option <?php if(isset($_POST['selectLocation'] ) && $_POST['selectLocation']  == 'Sylhet') echo"selected"; ?> value="Sylhet">Sylhet</option>
														<option <?php if(isset($_POST['selectLocation'] ) && $_POST['selectLocation']  == 'Rangpur') echo"selected"; ?> value="Rangpur">Rangpur</option>
														<option <?php if(isset($_POST['selectLocation'] ) && $_POST['selectLocation']  == 'Mymensingh') echo"selected"; ?> value="Mymensingh">Mymensingh</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Boost:</label>
                                                    <select id='' class="" name="boostName">
                                                        <option value='All' selected>All</option>
                                                        <option <?php if(isset($_POST['boostName'] ) && $_POST['boostName']  == 'Urgent') echo"selected"; ?> value="Urgent">Urgent</option>
                                                        <option <?php if(isset($_POST['boostName'] ) && $_POST['boostName']  == 'top') echo"selected"; ?> value="top">MT Bump</option>
                                                        <option <?php if(isset($_POST['boostName'] ) && $_POST['boostName']  == 'bump') echo"selected"; ?> value="bump">Top MT</option>
                                                    </select>
                                                </div>
												<div class="form-group">
													<button style="min-width:150px;text-align:center;padding:10px 30px;background-color:#ffcf00;" type="submit" name="submitThisSearch" class="theme-btn search-btn">
														Search
													</button>
												</div>

                                            </form>

                                        </div>
                                        <div class="ad-mob">
                                            <img src="images/portrait-ad-space .jpg" alt='Ad'>
                                        </div>
                                        <div class="ad-tab">
                                            <img src="images/Banner_Ad_NEW_PROTON.jpg" alt='Ad'>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                    <!--End Select Car Tabs-->

                </div>
            
			</div>
        </div>
    </section>
    <!--End Inventory Section-->

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

<script>
$( document ).ready(function() {
    fnBrandModelNew(document.getElementById('selectedBrand'));
});
function fnCompareClose()
{
	var a = document.getElementById('item1');
	var b = document.getElementById('item2');
	a.value = 1;		b.value = 2;
	document.getElementById('spnComp').innerHTML = "";
	document.getElementById('divCompare').style.display = "none";
	localStorage.setItem("mt_comp1", a.value);
	localStorage.setItem("mt_comp2", b.value);
}
function fnCompareInput(pid)
{
	var a = document.getElementById('item1');
	var b = document.getElementById('item2');
	
	if(a.value==pid || b.value==pid) { return false; }
	
	a.value = b.value;		b.value = pid;
	
	if(a.value=='1') { return false; }
	else { document.getElementById('divCompare').style.display = "inline-block"; }
	
	if(document.getElementById('spnComp').innerHTML=="") {
		document.getElementById('spnComp').innerHTML = "Compare : 1";
		localStorage.setItem("mt_comp1", a.value);
		localStorage.setItem("mt_comp2", b.value);
	}
	else {
		document.getElementById('spnComp').innerHTML = "<a href='my-garage-compare.php?pg=buy-car&p1="+a.value+"&p2="+b.value+"' style='background-color:#000; color:#FFF; padding:5px 8px; border-radius:8px;'>Compare</a>";
		localStorage.setItem("mt_comp1", a.value);
		localStorage.setItem("mt_comp2", b.value);
	}
}
</script>

<p align=right style='display:none;'>
<input type='text' id='item1' name='item1' value='1' readonly style='padding:5px; text-align:right;'>
<input type='text' id='item2' name='item2' value='2' readonly style='padding:5px;'>
</p>

<div id='divCompare' style='display:none; position:fixed; bottom:0px; left:0px; padding:10px; background-color:#FFCF00; font-size:14px; font-weight:bold;'>
	<span id='spnComp'></span> &nbsp; <a onclick='fnCompareClose()' style='color:#FF0000; font-size:18px;' title='Close'><span class="icon fa fa-times-circle"></span></a>
</div>

<script>
var cmp1 = localStorage.getItem("mt_comp1");
var cmp2 = localStorage.getItem("mt_comp2");

document.getElementById('item1').value = cmp1;
document.getElementById('item2').value = cmp2;

if(cmp1!="1" && cmp1!="2" && cmp2!="1" && cmp2!="2") {
	document.getElementById('divCompare').style.display = 'inline-block';
	document.getElementById('spnComp').innerHTML = "<a href='my-garage-compare.php?pg=buy-car&p1="+cmp1+"&p2="+cmp2+"' style='background-color:#000; color:#FFF; padding:5px 8px; border-radius:8px;'>Compare</a>";
}
else if(cmp2!="1" && cmp2!="2") {
	document.getElementById('divCompare').style.display = 'inline-block';
	document.getElementById('spnComp').innerHTML = 'Compare : 1';
}
</script>
<script>
<?php require('files/vehicles.txt'); ?>

function fnBrandModel(s)
{
	var mod = document.getElementById("selectModel");
	mod.options.length = 0;
	
	var sel = s.value;
	var option;
	
	if(sel=='All') {
		option = document.createElement("option");
		option.text = "Any Model";
		option.value = "All";
		mod.add(option);
	}
	else {
		var arr;
		if(sel=='Audi') { arr = audi; }
		else if(sel=='Bentley') { arr = bentley; }
		else if(sel=='BMW') { arr = bmw; }
		else if(sel=='Daihatusu') { arr = daihatusu; }
		else if(sel=='Honda') { arr = honda; }
		else if(sel=='Hyundai') { arr = hyundai; }
		else if(sel=='Infiniti') { arr = infiniti; }
		else if(sel=='Jeep') { arr = jeep; }
		else if(sel=='Kia') { arr = kia; }
		else if(sel=='Land Rover') { arr = landrover; }
		else if(sel=='Lexus') { arr = lexus; }
		else if(sel=='Mercedes') { arr = mercedes; }
		else if(sel=='MG') { arr = mg; }
		else if(sel=='Mazda') { arr = mazda; }
		else if(sel=='Mitsubishi') { arr = mitsubishi; }
		else if(sel=='Nissan') { arr = nissan; }
		else if(sel=='Porsche') { arr = porsche; }
		else if(sel=='Proton') { arr = proton; }
		else if(sel=='Subaru') { arr = subaru; }
		else if(sel=='Suzuki') { arr = suzuki; }
		else if(sel=='Tata') { arr = tata; }
		else if(sel=='Toyota') { arr = toyota; }
		else if(sel=='Volkswagen') { arr = volkswagen; }
		else if(sel=='Volvo') { arr = volvo; }
		arr.sort();
		
		var option;
		option = document.createElement("option");
		option.text = "Any Model";
		option.value = "All";
		mod.add(option);
		
		for (x of arr) {
			option = document.createElement("option");
			option.text = x;
			mod.add(option);
		}
	}
}
function fnBrandModelNew(s)
{
	var mod = document.getElementById("selectModelNew");
	mod.options.length = 0;
	
	var sel = s.value;
	var option;
	
	if(sel=='All') {
		option = document.createElement("option");
		option.text = "Any Model";
		option.value = "All";
		mod.add(option);
	}
	else {
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
		var selectedModel;
		option = document.createElement("option");
		option.text = "Any Model";
		option.value = "All";
		mod.add(option);
		
		for (x of arr) {
			option = document.createElement("option");
			option.text = x;
			option.value=x
			selectedModel = '<?php echo $_POST['selectModel'] ?? '' ;?>';
			if(selectedModel==x){
				option.selected=true;
			}
			mod.add(option);
		}
	}
}
</script>

</body>
</html>
