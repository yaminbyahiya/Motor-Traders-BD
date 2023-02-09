<?php session_start();
require('files/session.php');

require_once('files/dbcon.php');
require_once('files/ts.php');

function monthname3($m) {
	if($m=="01" || $m==1) { return "Jan"; }
	elseif($m=="02" || $m==2) { return "Feb"; }
	elseif($m=="03" || $m==3) { return "Mar"; }
	elseif($m=="04" || $m==4) { return "Apr"; }
	elseif($m=="05" || $m==5) { return "May"; }
	elseif($m=="06" || $m==6) { return "Jun"; }
	elseif($m=="07" || $m==7) { return "Jul"; }
	elseif($m=="08" || $m==8) { return "Aug"; }
	elseif($m=="09" || $m==9) { return "Sep"; }
	elseif($m=="10" || $m==10) { return "Oct"; }
	elseif($m=="11" || $m==11) { return "Nov"; }
	elseif($m=="12" || $m==12) { return "Dec"; }
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
	else
	{
		return $n;
	}
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
<?php require('files/head-bn.php'); ?>
<!-- Stylesheets -->
<link href="plugins/revolution/css/settings.css" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
<link href="plugins/revolution/css/layers.css" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
<link href="plugins/revolution/css/navigation.css" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->
</head>

<body>
<script>
localStorage.setItem("mt_comp1",1);
localStorage.setItem("mt_comp2",2);
</script>

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <?php $menu='home'; require('files/header-bn.php'); ?>

    <!--Main Slider-->
    <section class="main-slider">
        <div class="rev_slider_wrapper fullwidthbanner-container"  id="rev_slider_one_wrapper" data-source="gallery" style="background-color:#FFCF00; background-image:url('images/logo-m.png'); background-position:center; background-repeat:no-repeat; background-size:40%;">
            <div class="rev_slider fullwidthabanner" id="rev_slider_one" data-version="5.4.1">
                <ul>
                    <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1687" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="images/main-slider/image-1.jpg" data-title="Slide Title" data-transition="parallaxvertical">
						<img alt="Motortrader Red Proton X50 & Silver X70" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="images/main-slider/image-04.jpg">

						<div class="tp-caption"
						data-paddingbottom="[0,0,0,0]"
						data-paddingleft="[0,0,0,0]"
						data-paddingright="[0,0,0,0]"
						data-paddingtop="[0,0,0,0]"
						data-responsive_offset="on"
						data-type="text"
						data-height="none"
						data-width="['600','600','500','420']"
						data-whitespace="normal"
						data-hoffset="['15','15','15','15']"
						data-voffset="['-20','-20','-20','-20']"
						data-x="['right','right','right','right']"
						data-y="['middle','middle','middle','middle']"
						data-textalign="['top','top','top','top']"
						data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
							<div class="slider-content">
								<h2>গাড়ি বেচাকেনার সবচেয়ে ভালো অনলাইন মার্কেটপ্লেস</h2>
								<!--
								<div class="text">It is a long established fact that a reader will distracted by the readable content of a page when looking.</div>
								-->
								<a href="profile-bn.php" class="theme-btn btn-style-one">গাড়িবিক্রয়</a>
							</div>
						</div>
                    </li>

                    <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1688" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="images/main-slider/image-2.jpg" data-title="Slide Title" data-transition="parallaxvertical">
						<img alt="Motortrader Orange Pickup" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="images/main-slider/image-2.jpg">

						<div class="tp-caption"
						data-paddingbottom="[0,0,0,0]"
						data-paddingleft="[0,0,0,0]"
						data-paddingright="[0,0,0,0]"
						data-paddingtop="[0,0,0,0]"
						data-responsive_offset="on"
						data-type="text"
						data-height="none"
						data-width="['600','600','500','420']"
						data-whitespace="normal"
						data-hoffset="['15','15','15','15']"
						data-voffset="['-20','-20','-20','-20']"
						data-x="['right','right','right','right']"
						data-y="['middle','middle','middle','middle']"
						data-textalign="['top','top','top','top']"
						data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
							<div class="slider-content">
								<h2>বাংলাদেশের গাড়ির সবচেয়ে বড় অনলাইন মার্কেটপ্লেস</h2>
								<!--
								<div class="text">It is a long established fact that a reader will distracted by the readable content of a page when looking.</div>
								-->
								<a href="buy-car-bn.php" class="theme-btn btn-style-one">গাড়িক্রয়</a>
							</div>
						</div>
                    </li>
					
					<li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1689" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="images/main-slider/image-1.jpg" data-title="Slide Title" data-transition="parallaxvertical">
						<img alt="Motortrader White Civic & Red MG" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="images/main-slider/slider-05.jpg">

						<div class="tp-caption"
						data-paddingbottom="[0,0,0,0]"
						data-paddingleft="[0,0,0,0]"
						data-paddingright="[0,0,0,0]"
						data-paddingtop="[0,0,0,0]"
						data-responsive_offset="on"
						data-type="text"
						data-height="none"
						data-width="['600','600','500','420']"
						data-whitespace="normal"
						data-hoffset="['15','15','15','15']"
						data-voffset="['-20','-20','-20','-20']"
						data-x="['right','right','right','right']"
						data-y="['middle','middle','middle','middle']"
						data-textalign="['top','top','top','top']"
						data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
							<div class="slider-content">
								<h2>নতুন এবং ব্যবহূত গাড়ি ক্লাসিফাইড</h2>
								<a href="profile-bn.php" class="theme-btn btn-style-one">গাড়িবিক্রয়</a>
							</div>
						</div>
                    </li>

                    <li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1690" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="images/main-slider/image-2.jpg" data-title="Slide Title" data-transition="parallaxvertical">
						<img alt="Motortrader Silver Proton SUV & White Yaris" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="images/main-slider/slider-03.jpg">

						<div class="tp-caption"
						data-paddingbottom="[0,0,0,0]"
						data-paddingleft="[0,0,0,0]"
						data-paddingright="[0,0,0,0]"
						data-paddingtop="[0,0,0,0]"
						data-responsive_offset="on"
						data-type="text"
						data-height="none"
						data-width="['600','600','500','420']"
						data-whitespace="normal"
						data-hoffset="['15','15','15','15']"
						data-voffset="['-20','-20','-20','-20']"
						data-x="['right','right','right','right']"
						data-y="['middle','middle','middle','middle']"
						data-textalign="['top','top','top','top']"
						data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
							<div class="slider-content">
								<h2>অটো ডিলারশীপ ডিজিটাল মার্কেটিং সলিউশন</h2>
								<a href="buy-car-bn.php" class="theme-btn btn-style-one">গাড়িক্রয়</a>
							</div>
						</div>
                    </li>
					
					<li data-description="Slide Description" data-easein="default" data-easeout="default" data-fsmasterspeed="1500" data-fsslotamount="7" data-fstransition="fade" data-hideafterloop="0" data-hideslideonmobile="off" data-index="rs-1691" data-masterspeed="default" data-param1="" data-param10="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off" data-slotamount="default" data-thumb="images/main-slider/image-1.jpg" data-title="Slide Title" data-transition="parallaxvertical">
						<img alt="Motortrader Red SUV & Silver SUV" class="rev-slidebg" data-bgfit="cover" data-bgparallax="10" data-bgposition="center center" data-bgrepeat="no-repeat" data-no-retina="" src="images/main-slider/slider-04.jpg">

						<div class="tp-caption"
						data-paddingbottom="[0,0,0,0]"
						data-paddingleft="[0,0,0,0]"
						data-paddingright="[0,0,0,0]"
						data-paddingtop="[0,0,0,0]"
						data-responsive_offset="on"
						data-type="text"
						data-height="none"
						data-width="['600','600','500','420']"
						data-whitespace="normal"
						data-hoffset="['15','15','15','15']"
						data-voffset="['-20','-20','-20','-20']"
						data-x="['right','right','right','right']"
						data-y="['middle','middle','middle','middle']"
						data-textalign="['top','top','top','top']"
						data-frames='[{"from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;","mask":"x:0px;y:0px;s:inherit;e:inherit;","speed":1500,"to":"o:1;","delay":1000,"ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"to":"auto:auto;","mask":"x:0;y:0;s:inherit;e:inherit;","ease":"Power3.easeInOut"}]'>
							<div class="slider-content">
								<h2>শুণ্য কমিশন, ফ্রি বিজ্ঞাপন</h2>
								<a href="profile-bn.php" class="theme-btn btn-style-one">গাড়িবিক্রয়</a>
							</div>
						</div>
                    </li>
                
				</ul>
            </div>
        </div>
    </section>
    <!--End Main Slider-->

    <?php //require('files/responsive-slides/index.php'); ?>
	<?php require('files/adv3rdparty-jssor.php'); ?>
	<?php //require('files/adv3rdparty.php'); ?>
	
	<!--Offer Section-->
    <section class="offer-section">
    	<div class="auto-container">
        	<!--Sec Title-->
            <div class="sec-title light centered">
            	<h2>বিশেষ বিজ্ঞাপন</h2>
            </div>
            <div class="three-item-carousel owl-carousel owl-theme">
			
				<?php
				$sql = "select t1.pid, t1.brand, t1.model, t1.modelyr, t1.mileage, t1.fueltype, t1.price, t2.thumb, t1.trans, t1.type, t1.boostName from `$db`.`mt_sell_car` t1, `$db`.`mt_sell_car_pic` t2 where t1.status='y' and t1.hidepost='n' and t1.pid=t2.pid and t1.boost='y' and t1.boostExpiry>'$now' and t1.utype='Individual' order by RAND(), t1.sl desc limit 0,9;";
				$r = mysqli_query($dbcon, $sql) or die("$sql");
				while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
				{
					$boostName = $row['boostName'];
					$price = $row['price'];
					$mileage = $row['mileage'];
					?>
					<div class="offer-block">
						<div class="inner-box">
							<div class="image">
								<a href="vehicle_details.php?pid=<?php echo $row['pid']; ?>"><img src="post_pic/<?php echo $row['pid']."_".$row['thumb']; ?>" alt="" height=200 /></a>
								<!--<div class="price">1.5 <span class="percent">% <br> APR</span></div>-->
								<?php
								if($boostName=="urgent") { echo "<div class='price'><img src='images/boost_urgent72.png' title='URGENT' alt='URGENT'></div>"; }
								elseif($boostName=="top") { echo "<div class='price'><img src='images/boost_top72.png' title='TOP' alt='TOP'></div>"; }
								elseif($boostName=="bump") { echo "<div class='price'><img src='images/boost_bump72.png' title='BUMP' alt='BUMP'></div>"; }
								?>
							</div>
							<h3><a href="vehicle_details.php?pid=<?php echo $row['pid']; ?>"><?php echo $row['brand']." &mdash; ".$row['model']." (".$row['modelyr'].")"; ?><br><?php echo $row['type']; ?></a></h3>
							<div class="lower-box">
								<!-- <div class="plus-box">
									<span class="icon fa fa-plus"></span>
									<ul class="tooltip-data">
										<li>5 Years Warranty</li>
										<li>Free Registration</li>
										<li>Free 2 Years Services</li>
									</ul>
								</div> -->
								<div class="lower-price"><?php if($price==0 || $price=="" || $price==null) { echo "<a href='vehicle_details.php?pid=".$row['pid']."#seller' style='color:#242628'>ask for price</a>"; } else { echo "<font color='#242628'>৳ ".fnCrLac2($price)."</font>"; } ?></div>
								
								<ul>
									<li><span class="icon fa fa-road"></span><?php if($mileage==0 || $mileage=="" || $mileage==null) { echo "<a href='vehicle_details.php?pid=".$row['pid']."#seller' style='color:#242628'>Ask Seller</a>"; } else { echo "$mileage km"; } ?></li>
									<li><span class="icon fa fa-car"></span><?php echo $row['fueltype']; ?></li>
									<li><span class="icon fa fa-gear"></span><?php echo $row['trans']; ?></li>
								</ul>
							</div>
						</div>
					</div>
					<?php
				}
				?>
            </div>
        </div>
    </section>
    <!--End Offer Section-->

    <!--Car Search Form-->
    <section class="car-search-form">
      <div class="auto-container">
          <div class="inner-section">

                <!--Product Info Tabs-->
                <div class="car-search-tab">

                    <!--Tabs Box-->
                    <div class="prod-tabs tabs-box">

                        <!--Tab Btns-->
                        <ul class="tab-btns tab-buttons clearfix">
                            <li data-tab="#used-car" class="tab-btn active-btn">ব্যবহৃত গাড়ি</li>
                            <li data-tab="#new-car" class="tab-btn">নতুন গাড়ি</li>
                        </ul>

                        <!--Tabs Container-->
                        <div class="tabs-content">
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
                            <!--Tab / Active Tab-->
                            <div class="tab active-tab" id="used-car">
                                <div class="content">
                                    <div class="car-search-form">
                                        <form name='frmSearch' method="post" action="buy-car-bn.php">
										<div class="row clearfix">
											<div class="column col-lg-7 col-md-12 col-sm-12 col-xs-12">
												<div class="row clearfix">
													<div class="form-group col-md-4 col-sm-4 col-xs-12">
														<select id='selectBrand' name='selectBrand' class="custom-select-boxXX" onchange="fnBrandModel(this);">
														<option value='All' selected>Any Brand</option><option>Audi</option><option>Bentley</option><option>BMW</option><option>Daihatusu</option><option>Ford</option><option>Honda</option><option>Hyundai</option><option>Infiniti</option><option>Isuzu</option><option>Jeep</option><option>Kia</option><option value='LandRover'>Land Rover</option><option>Lexus</option><option>Maruti</option><option>Mazda</option><option>Mercedes</option><option>MG</option><option>Mitsubishi</option><option>Nissan</option><option>Porsche</option><option>Proton</option><option>Subaru</option><option>Suzuki</option><option>Tata</option><option>Toyota</option><option>Volkswagen</option><option>Volvo</option>
														</select>
													</div>
													<div class="form-group col-md-4 col-sm-4 col-xs-12">
														<select id='selectModel' name='selectModel' class="custom-select-boxXX">
														<option value='All' selected>Any Model</option>
														</select>
													</div>
													<div class="form-group col-md-4 col-sm-4 col-xs-12">
														<select name='selectPrice' class="custom-select-boxXX">
														<option value='All' selected>Any Price</option>
														<option value="0,300000">Up to 3 Lakh</option>
														<option value="300000,500000">Between 3-5 Lakh</option>
														<option value="500000,1000000">Between 5-10 Lakh</option>
														<option value="1000000,1500000">Between 10-15 Lakh</option>
														<option value="1500000,2500000">Between 15-25 Lakh</option>
														<option value="2500000,4000000">Between 25-40 Lakh</option>
														<option value="4000000,99999999">Above 40 Lakh</option>
														</select>
													</div>
												</div>
											</div>
											<div class="column col-lg-5 col-md-12 col-sm-12 col-xs-12">
												<div class="row clearfix">
													<div class="form-group col-md-4 col-sm-4 col-xs-12">
														<select name='selectMileage' class="custom-select-boxXX">
														<option value='All' selected>Any Mileage</option>
														<option value="0,100">Less than 100 KM</option>
														<option value="100,15000">Between 100-15000 KM</option>
														<option value="15000,30000">Between 15000-30000 KM</option>
														<option value="30000,45000">Between 30000-45000 KM</option>
														<option value="45000,9999999">Above 45000+ KM</option>
														</select>
													</div>
													<div class="form-group col-md-4 col-sm-4 col-xs-12">
														<select name='selectLocation' class="custom-select-boxXX">
														<option value='All' selected>Any Location</option>
														<option>Dhaka</option><option>Chittagong</option><option>Rajshahi</option><option>Khulna</option><option>Barishal</option><option>Sylhet</option><option>Rangpur</option><option>Mymensingh</option>
														</select>
													</div>
													<div class="form-group col-md-4 col-sm-4 col-xs-12">
														<button type="submit" name="submitSearch" class="theme-btn search-btn">Search</button>
													</div>
												</div>
											</div>
										</div>
										<input type='hidden' name='condition' value='Used'>
										</form>

                                    </div>
                                </div>
                            </div>

                            <!--Tab-->
                            <div class="tab" id="new-car">
                                <div class="content">
                                    <div class="car-search-form">
                                        <form name='frmSearchNew' method="post" action="buy-car-bn.php">
										<div class="row clearfix">
											<div class="column col-lg-7 col-md-12 col-sm-12 col-xs-12">
												<div class="row clearfix">
													<div class="form-group col-md-4 col-sm-4 col-xs-12">
														<select id='selectBrandNew' name='selectBrand' class="custom-select-boxXX" onchange="fnBrandModelNew(this);">
														<option value='All' selected>Any Brand</option><option>Audi</option><option>Bentley</option><option>BMW</option><option>Daihatusu</option><option>Ford</option><option>Honda</option><option>Hyundai</option><option>Infiniti</option><option>Isuzu</option><option>Jeep</option><option>Kia</option><option value='LandRover'>Land Rover</option><option>Lexus</option><option>Maruti</option><option>Mazda</option><option>Mercedes</option><option>MG</option><option>Mitsubishi</option><option>Nissan</option><option>Porsche</option><option>Proton</option><option>Subaru</option><option>Suzuki</option><option>Tata</option><option>Toyota</option><option>Volkswagen</option><option>Volvo</option>
														</select>
													</div>
													<div class="form-group col-md-4 col-sm-4 col-xs-12">
														<select id='selectModelNew' name='selectModel' class="custom-select-boxXX">
														<option value='All' selected>Any Model</option>
														</select>
													</div>
													<div class="form-group col-md-4 col-sm-4 col-xs-12">
														<select name='selectPrice' class="custom-select-boxXX">
														<option value='All' selected>Any Price</option>
														<option value="0,300000">Up to 3 Lakh</option>
														<option value="300000,500000">Between 3-5 Lakh</option>
														<option value="500000,1000000">Between 5-10 Lakh</option>
														<option value="1000000,1500000">Between 10-15 Lakh</option>
														<option value="1500000,2500000">Between 15-25 Lakh</option>
														<option value="2500000,4000000">Between 25-40 Lakh</option>
														<option value="4000000,99999999">Above 40 Lakh</option>
														</select>
													</div>
												</div>
											</div>
											<div class="column col-lg-5 col-md-12 col-sm-12 col-xs-12">
												<div class="row clearfix">
													<div class="form-group col-md-4 col-sm-4 col-xs-12">
														<select name='selectMileage' class="custom-select-boxXX">
														<option value='All' selected>Any Mileage</option>
														<option value="0,100">Less than 100 KM</option>
														<option value="100,15000">Between 100-15000 KM</option>
														<option value="15000,30000">Between 15000-30000 KM</option>
														<option value="30000,45000">Between 30000-45000 KM</option>
														<option value="45000,9999999">Above 45000+ KM</option>
														</select>
													</div>
													<div class="form-group col-md-4 col-sm-4 col-xs-12">
														<select name='selectLocation' class="custom-select-boxXX">
														<option value='All' selected>Any Location</option>
														<option>Dhaka</option><option>Chittagong</option><option>Rajshahi</option><option>Khulna</option><option>Barishal</option><option>Sylhet</option><option>Rangpur</option><option>Mymensingh</option>
														</select>
													</div>
													<div class="form-group col-md-4 col-sm-4 col-xs-12">
														<button type="submit" name="submitSearch" class="theme-btn search-btn">Search</button>
													</div>
												</div>
											</div>
										</div>
										<input type='hidden' name='condition' value='New'>
										</form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!--End Product Info Tabs-->

            </div>
        </div>
    </section>
    <!--End Car Search Form-->
	
    <!--Popular Cars Section Two-->
    <section class="popular-cars-section-two">
    	<div class="auto-container">
        	<!--Sec Title-->
            <div class="sec-title centered">
            	<h2>জনপ্রিয় গাড়ি</h2>
            </div>

            <!--Popular Used Tabs-->
            <div class="popular-used-car">

                <!--Tabs Box-->
                <div class="prod-tabs tabs-box">
                	<div class="text-center">
                        <!--Tab Btns-->
                        <ul class="tab-btns tab-buttons clearfix">
                            <li data-tab="#prod-brand" class="tab-btn active-btn"><span class="text">ব্র্যান্ড অনুযায়ী</span><span class="icon flaticon-check-2"></span></li>
							<li data-tab="#prod-city" class="tab-btn"><span class="text">শহর অনুযায়ী</span><span class="icon flaticon-planet-earth"></span></li>
                            <li data-tab="#prod-price" class="tab-btn"><span class="text">মূল্য অনুযায়ী</span><span class="icon fa fa-credit-card"></span></li>
                            <li data-tab="#prod-body" class="tab-btn"><span class="text">ধরণ অনুযায়ী</span><span class="icon flaticon-car"></span></li>
                        </ul>
                    </div>

                    <!--Tabs Container-->
                    <div class="tabs-content">

                        <!--Tab / Active Tab-->
                        <div class="tab active-tab" id="prod-brand">
                            <div class="content">
                                <div class="row clearfix">
                                    <div class="brand-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<figure class="image"><a href="buy-car.php?tab=brand&value=proton"><img src="images/brands/proton.png" alt="Motortrader Proton Logo"></a></figure>
                                        </div>
                                    </div>
                                    <div class="brand-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<figure class="image"><a href="buy-car.php?tab=brand&value=toyota"><img src="images/brands/toyota.png" alt="Motortrader Toyota Logo"></a></figure>
                                        </div>
                                    </div>
                                    <div class="brand-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<figure class="image"><a href="buy-car.php?tab=brand&value=honda"><img src="images/brands/honda.png" alt="Motortrader Honda Logo"></a></figure>
                                        </div>
                                    </div>
                                    <div class="brand-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<figure class="image"><a href="buy-car.php?tab=brand&value=mitsubishi"><img src="images/brands/mitsubishi.png" alt="Motortrader Mitsubishi Logo"></a></figure>
                                        </div>
                                    </div>
                                    <div class="brand-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<figure class="image"><a href="buy-car.php?tab=brand&value=nissan"><img src="images/brands/nissan.png" alt="Motortrader Nissan Logo"></a></figure>
                                        </div>
                                    </div>
                                    <div class="brand-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<figure class="image"><a href="buy-car.php?tab=brand&value=mazda"><img src="images/brands/mazda.png" alt="Motortrader Mazda Logo"></a></figure>
                                        </div>
                                    </div>
                                    <div class="brand-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<figure class="image"><a href="buy-car.php?tab=brand&value=mercedes"><img src="images/brands/mercedes.png" alt="Motortrader Mercedes Logo"></a></figure>
                                        </div>
                                    </div>
                                    <div class="brand-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<figure class="image"><a href="buy-car.php?tab=brand&value=bmw"><img src="images/brands/bmw.png" alt="Motortrader BMW Logo"></a></figure>
                                        </div>
                                    </div>
                                    <div class="brand-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<figure class="image"><a href="buy-car.php?tab=brand&value=audi"><img src="images/brands/audi.png" alt="Motortrader Audi Logo"></a></figure>
                                        </div>
                                    </div>
                                    <div class="brand-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<figure class="image"><a href="buy-car.php?tab=brand&value=lexus"><img src="images/brands/lexus.png" alt="Motortrader Lexus Logo"></a></figure>
                                        </div>
                                    </div>
                                    <div class="brand-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<figure class="image"><a href="buy-car.php?tab=brand&value=mg"><img src="images/brands/mg.png" alt="Motortrader MG Logo"></a></figure>
                                        </div>
                                    </div>
                                    <div class="brand-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<figure class="image"><a href="buy-car.php?tab=brand&value=hyundai"><img src="images/brands/hyundai.png" alt="Motortrader Hyundai Logo"></a></figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Tab-->
						<div class="tab" id="prod-city">
                            <div class="content">
                                <div class="row clearfix">
                                    <div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=city&value=Dhaka" class="link-box"><div class="icon-box"><img src="images/city-dhaka.png" height=100 alt="Motortrader Dhaka Symbol"></div><div class="text">ঢাকা</div></a>
                                        </div>
                                    </div>
									<div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=city&value=Chittagong" class="link-box"><div class="icon-box"><img src="images/city-chittagong.png" height=100 alt="Motortrader Chittagong Symbol"></div><div class="text">চট্টগ্রাম</div></a>
                                        </div>
                                    </div>
									<div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=city&value=Rajshahi" class="link-box"><div class="icon-box"><img src="images/city-rajshahi.png" height=100 alt="Motortrader Rajshahi Symbol"></div><div class="text">রাজশাহী</div></a>
                                        </div>
                                    </div>
									<div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=city&value=Khulna" class="link-box"><div class="icon-box"><img src="images/city-khulna.png" height=100 alt="Motortrader Khulna Symbol"></div><div class="text">খুলনা</div></a>
                                        </div>
                                    </div>
									<div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=city&value=Sylhet" class="link-box"><div class="icon-box"><img src="images/city-sylhet.png" height=100 alt="Motortrader Sylhet Symbol"></div><div class="text">সিলেট</div></a>
                                        </div>
                                    </div>
									<div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=city&value=Barishal" class="link-box"><div class="icon-box"><img src="images/city-barishal.png" height=100 alt="Motortrader Barishal Symbol"></div><div class="text">বরিশাল</div></a>
                                        </div>
                                    </div>
									<div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=city&value=Rangpur" class="link-box"><div class="icon-box"><img src="images/city-rangpur.png" height=100 alt="Motortrader Rangpur Symbol"></div><div class="text">রংপুর</div></a>
                                        </div>
                                    </div>
									<div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=city&value=Mymensingh" class="link-box"><div class="icon-box"><img src="images/city-mymensingh.png" height=100 alt="Motortrader Mymensingh Symbol"></div><div class="text">ময়মনসিংহ</div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Tab-->
                        <div class="tab" id="prod-price">
                            <div class="content">
                                <div class="row clearfix">
                                    <div class="price-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=price&value=0-1" class="text">Under Tk 1 Lakh</a>
                                        </div>
                                    </div>
                                    <div class="price-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=price&value=1-2" class="text">Tk 1 - 2 Lakhs</a>
                                        </div>
                                    </div>
                                    <div class="price-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=price&value=3-4" class="text">Tk 3 - 4 Lakhs</a>
                                        </div>
                                    </div>
                                    <div class="price-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=price&value=4-5" class="text">Tk 4 - 5 Lakhs</a>
                                        </div>
                                    </div>
                                    <div class="price-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=price&value=6-8" class="text">Tk 6 - 8 Lakhs</a>
                                        </div>
                                    </div>
                                    <div class="price-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=price&value=8-12" class="text">Tk 8 - 12 Lakhs</a>
                                        </div>
                                    </div>
                                    <div class="price-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=price&value=12-20" class="text">Tk 12 - 20 Lakhs</a>
                                        </div>
                                    </div>
                                    <div class="price-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=price&value=20-500" class="text">Tk 20 Lakhs and Above</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--Tab-->
                        <div class="tab" id="prod-body">
                            <div class="content">
                                <div class="row clearfix">
                                    <div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=type&value=Sedan" class="link-box"><div class="icon-box"><img src="images/body/Body Filter-01.jpg" alt="Motortrader Blue Sedan"></div><div class="text">সেডান</div></a>
                                        </div>
                                    </div>
                                    <div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=type&value=Hatch" class="link-box"><div class="icon-box"><img src="images/body/Body Filter-02.jpg" alt="Motortrader Red Hatch"></div><div class="text">হ্যাচ</div></a>
                                        </div>
                                    </div>
                                    <div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=type&value=Wagon" class="link-box"><div class="icon-box"><img src="images/body/Body Filter-03.jpg" alt="Motortrader Black Wagon"></div><div class="text">ওয়াগন</div></a>
                                        </div>
                                    </div>
                                    <div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=type&value=Microbus" class="link-box"><div class="icon-box"><img src="images/body/Body Filter-04.jpg" alt="Motortrader White Microbus"></div><div class="text">মাইক্রোবাস</div></a>
                                        </div>
                                    </div>
                                    <div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=type&value=Suv" class="link-box"><div class="icon-box"><img src="images/body/Body Filter-05.jpg" alt="Motortrader Grey SUV"></div><div class="text">এসইউভি / ক্রসওভার</div></a>
                                        </div>
                                    </div>
                                    <div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=type&value=Pickup" class="link-box"><div class="icon-box"><img src="images/body/Body Filter-06.jpg" alt="Motortrader White Pickup"></div><div class="text">পিকআপ</div></a>
                                        </div>
                                    </div>
                                    <div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=type&value=Sports" class="link-box"><div class="icon-box"><img src="images/body/Body Filter-07.jpg" alt="Motortrader Red Sports Car"></div><div class="text">স্পোর্টস</div></a>
                                        </div>
                                    </div>
                                    <div class="body-block col-md-3 col-sm-4 col-xs-12">
                                    	<div class="inner-box">
                                        	<a href="buy-car.php?tab=type&value=Commercial" class="link-box"><div class="icon-box"><img src="images/body/Body Filter-08.jpg" alt="Motortrader Blue Truck"></div><div class="text">বাস / ট্রাক / কমার্সিয়াল</div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!--End Product Info Tabs-->

        </div>
    </section>
    <!--End Popular Cars Section Two-->

    <!--Offer Section-->
    <section class="offer-section">
    	<div class="auto-container">
        	<!--Sec Title-->
            <div class="sec-title light centered">
            	<h2>ডিলারশিপ বিজ্ঞাপন</h2>
            </div>
            <div class="three-item-carousel owl-carousel owl-theme">
				<?php
				$sql = "select t1.pid, t1.brand, t1.model, t1.modelyr, t1.mileage, t1.fueltype, t1.price, t2.thumb, t1.trans, t1.type, t1.boostName from `$db`.`mt_sell_car` t1, `$db`.`mt_sell_car_pic` t2 where t1.status='y' and t1.hidepost='n' and t1.pid=t2.pid and t1.utype<>'Individual' order by RAND(), t1.sl desc limit 0,9;";	//and t1.boost='y' and t1.boostExpiry>'$now' 
				$r = mysqli_query($dbcon, $sql) or die("$sql");
				while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
				{
					$boostName = $row['boostName'];
					$price = $row['price'];
					$mileage = $row['mileage'];
					?>
					<div class="offer-block">
						<div class="inner-box">
							<div class="image">
								<a href="vehicle_details.php?pid=<?php echo $row['pid']; ?>"><img src="post_pic/<?php echo $row['pid']."_".$row['thumb']; ?>" alt="<?php echo 'motortrader-'.$row['brand'].'-'.$row['model']; ?>" height=200 /></a>
								<!-- <div class="price">1.5 <span class="percent">% <br> APR</span></div> -->
								<?php
								/*
								if($boostName=="urgent") { echo "<div class='price'><img src='images/boost_urgent72.png' title='URGENT' alt='URGENT'></div>"; }
								elseif($boostName=="top") { echo "<div class='price'><img src='images/boost_top72.png' title='TOP' alt='TOP'></div>"; }
								elseif($boostName=="bump") { echo "<div class='price'><img src='images/boost_bump72.png' title='BUMP' alt='BUMP'></div>"; }
								*/
								?>
							</div>
							<h3><a href="vehicle_details.php?pid=<?php echo $row['pid']; ?>"><?php echo $row['brand']." &mdash; ".$row['model']." (".$row['modelyr'].")"; ?><br><?php echo $row['type']; ?></a></h3>
							<div class="lower-box">
								<!-- <div class="plus-box">
									<span class="icon fa fa-plus"></span>
									<ul class="tooltip-data">
										<li>5 Years Warranty</li>
										<li>Free Registration</li>
										<li>Free 2 Years Services</li>
									</ul>
								</div> -->
								<div class="lower-price"><?php if($price==0 || $price=="" || $price==null) { echo "<a href='vehicle_details.php?pid=".$row['pid']."#seller' style='color:#242628'>ask for price</a>"; } else { echo "<font color='#242628'>৳ ".fnCrLac2($price)."</font>"; } ?></div>
								
								<ul>
									<li><span class="icon fa fa-road"></span><?php if($mileage==0 || $mileage=="" || $mileage==null) { echo "<a href='vehicle_details.php?pid=".$row['pid']."#seller' style='color:#242628'>Ask Seller</a>"; } else { echo "$mileage km"; } ?></li>
									<li><span class="icon fa fa-car"></span><?php echo $row['fueltype']; ?></li>
									<li><span class="icon fa fa-gear"></span><?php echo $row['trans']; ?></li>
								</ul>
							</div>
						</div>
					</div>
					<?php
				}
				?>
            </div>
        </div>
    </section>
    <!--End Offer Section-->
	
	<?php //require('files/why_choose_us.php'); ?>

    <!--News Section-->
    <section class="news-section">
    	<div class="auto-container">
        	<!--Sec Title-->
            <div class="sec-title centered">
            	<h2>সর্বশেষ সংবাদ</h2>
            </div>
            <div class="row clearfix">
				<?php
				$sql = "select name, nid, title, title2, img, verifyOn from `$db`.`mt_news` where status='y' and verifyBy is not null and verifyOn is not null order by verifyOn desc limit 0, 3;";
				$r = mysqli_query($dbcon, $sql) or die("$sql");
				while($row = mysqli_fetch_array($r, MYSQLI_BOTH))
				{
					$name = $row['name'];
					$nid = $row['nid'];
					$t1 = $row['title'];
					$t2 = $row['title2'];
					$img = $row['img'];
					$dt = $row['verifyOn'];
					$d = substr($dt,8,2);
					$m = monthname3(substr($dt,5,2));
					
					echo "
					<div class='news-block col-md-4 col-sm-6 col-xs-12'>
						<div class='inner-box'>
							<div class='image'>
								<img src='news_pic/".$nid."_".$img."' alt='".$t1."' height=250 />
								<a class='overlay-link' href='blogs_details.php?nid=".$nid."'><span class='icon fa fa-link'></span></a>
							</div>
							<div class='lower-box'>
								<div class='post-date'>$d<br>$m</div>
								<div class='content'>
									<div class='author'>$name</div>
									<h3><a href='blogs_details.php?nid=".$nid."'>$t1</a></h3>
									<div class='text'>$t2</div>
								</div>
							</div>
						</div>
					</div>";
				}
				?>
            </div>
        </div>
    </section>
    <!--End News Section-->
    
            		<!--Calculator-->
				<div class="sell-car-form auto-container">
					<h2>Tax Calculator</h2>
					<div class="form-box">
						<div class="row clearfix tax-calculator">
							<!--
							<div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
								<label>Name</label>
								<input type="text" name="name" maxlength=50 value="" placeholder="Enter Name *" required>
							</div>
							-->
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<label>Type</label>
								<select id='type' name='type'>
								    <option value="0">Select car type</option>
								    <option value="1">Car or SUV</option>
								    <option value="3">Pickups</option>
								    <option value="2">Microbus</option></select>
								<!-- <input type="text" name="brand" maxlength=50 value="" placeholder="Enter Brand Name *" required> -->
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<label>Engine Capacity</label>
								<select id='capacity' name='capacity' disabled>
								    <option >Select engine capacity</option>
								    <option value="1">Less than 1500</option>
								    <option value="2">1500 to 2000</option>
								    <option value="3">2000 to 2500</option>
								    <option value="4">2500 to 3000</option>
								    <option value="5">3000 to 3500</option>
								    <option value="6">More than 3500</option>
								</select>
								<!-- <input type="text" name="model" maxlength=50 value="" placeholder="Enter Model Name *" required> -->
							</div>
							<div class="form-group col-md-6 col-sm-6 col-xs-12">
								<label>Amount of tax in taka(tk)</label>
								<p id='tax' name='tax' style="font-size: 22px;margin-top: 5px;">0 tk</p>
								<!-- <input type="text" name="model" maxlength=50 value="" placeholder="Enter Model Name *" required> -->
							</div>

						</div>
					</div>
				</div>
				<!--Calculator-->

    <?php require('files/rates.php'); ?>
	
	<?php require('files/footer-bn.php'); ?>

</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="icon fa fa-angle-up"></span></div>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--Revolution Slider-->
<script src="plugins/revolution/js/jquery.themepunch.revolution.min.js"></script>
<script src="plugins/revolution/js/jquery.themepunch.tools.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.actions.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.migration.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
<script src="plugins/revolution/js/extensions/revolution.extension.video.min.js"></script>
<script src="js/main-slider-script.js"></script>
<!--End Revolution Slider-->
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.fancybox.pack.js"></script>
<script src="js/jquery.fancybox-media.js"></script>
<script src="js/owl.js"></script>
<script src="js/appear.js"></script>
<script src="js/wow.js"></script>
<script src="js/main-slider-script.js"></script>
<script src="js/script.js"></script>

<?php mysqli_close($dbcon); ?>

<!-- COOKIE POLICY -->
<?php if(isset($_REQUEST['lang'])) {} else { ?>
<div id="cookieConsent">
    <div id="closeCookieConsent">x</div>
    This website is using cookies. To know more about Cookie Policy <a href="cookie-policy.php" target="_blank">CLICK HERE</a>.
	<a class="cookieConsentOK">I AGREE</a>
</div>
<style>
/*Cookie Consent Begin*/
#cookieConsent {
    background-color: rgba(20,20,20,0.8);
    min-height: 26px;
    font-size: 14px;
    color: #ccc;
    line-height: 26px;
    padding: 8px 0 8px 30px;
    font-family: "Trebuchet MS",Helvetica,sans-serif;
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    display: none;
    z-index: 9999;
}
#cookieConsent a {
    color: #4B8EE7;
    text-decoration: none;
}
#closeCookieConsent {
    float: right;
    display: inline-block;
    cursor: pointer;
    height: 20px;
    width: 20px;
    margin: -15px 0 0 0;
    font-weight: bold;
}
#closeCookieConsent:hover {
    color: #FFF;
}
#cookieConsent a.cookieConsentOK {
    background-color: #F1D600;
    color: #000;
    display: inline-block;
    border-radius: 5px;
    padding: 0 20px;
    cursor: pointer;
    float: right;
    margin: 0 60px 0 10px;
}
#cookieConsent a.cookieConsentOK:hover {
    background-color: #E0C91F;
}
/*Cookie Consent End*/
</style>
<script>
$(document).ready(function() {
    
        $("#type").on("change", function() {
           if(this.value === "1"){
                document.getElementById("capacity").removeAttribute("disabled");
           }else if(this.value === "2"){
                document.getElementById("tax").innerHTML = "30000 tk" ;
                document.getElementById("capacity").disabled = true;
           }else if(this.value === "3"){
                document.getElementById("tax").innerHTML = "15000 tk" ;
                document.getElementById("capacity").disabled = true;
           }else if(this.value === "0"){
               document.getElementById("capacity").disabled = true;
           }
        });
    
        $("#capacity").on("change", function() {
           if(this.value === "1"){
                document.getElementById("tax").innerHTML = "25000 tk" ;
           }else if(this.value === "2"){
               document.getElementById("tax").innerHTML = "50000 tk" ;
           }else if(this.value === "3"){
               document.getElementById("tax").innerHTML = "75000 tk" ;
           }else if(this.value === "4"){
               document.getElementById("tax").innerHTML = "125000 tk" ;
           }else if(this.value === "5"){
               document.getElementById("tax").innerHTML = "150000 tk" ;
           }else if(this.value === "6"){
               document.getElementById("tax").innerHTML = "200000 tk" ;
           }
        });
    setTimeout(function () {
        $("#cookieConsent").fadeIn(200);
    }, 2000);
    $("#closeCookieConsent, .cookieConsentOK").click(function() {
        $("#cookieConsent").fadeOut(200);
    });
}); 
</script>
<?php } ?>
<!-- COOKIE POLICY -->

</body>
</html>
 