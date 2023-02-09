<!-- Main Header-->
<header class="main-header">

	<!--Header Top-->
	<div class="header-top">
		<div class="auto-container">
			<div class="clearfix">
				<!--Top Left-->
				<div class="top-left">
					<ul class="dropdown-option clearfix">
						<li class="location dropdown"><a class="btn btn-default dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#"><span class="icon flaticon-maps-and-flags"></span>Select Your Location &nbsp;<span class="fa fa-angle-down"></span></a>
							<ul class="dropdown-menu style-one" aria-labelledby="dropdownMenu1">
								<li><a href="set_location.php?loc=bd">Bangladesh</a></li>
								<li><a href="set_location.php?loc=dhk">Dhaka</a></li>
								<li><a href="set_location.php?loc=ctg">Chittagong</a></li>
								<li><a href="set_location.php?loc=raj">Rajshahi</a></li>
								<li><a href="set_location.php?loc=khu">Khulna</a></li>
								<li><a href="set_location.php?loc=bar">Barishal</a></li>
								<li><a href="set_location.php?loc=syl">Sylhet</a></li>
								<li><a href="set_location.php?loc=ran">Rangpur</a></li>
								<li><a href="set_location.php?loc=mym">Mymensingh</a></li>
							</ul>
						</li>
					</ul>
					<div class="social-links">
						<!--<a href="index-bn.php" style='border-right:1px solid #35393B; padding-right:20px;'>বাং</a>-->
						<a target='_blank' href="https://www.facebook.com/motortraderbd/"><span class="fa fa-facebook"></span></a>
						<a target='_blank' href="https://www.instagram.com/motortraderbd/" style='border-right:1px solid #35393B; padding-right:20px;'><span class="fa fa-instagram"></span></a>
						<a href="buy-car.php?tab=type&value=Sedan">Sedan</a>
						<a href="buy-car.php?tab=type&value=Suv">Suv</a>
						<a href="buy-car.php?tab=type&value=Commercial">Commercial</a>
						<!--<a href="#"><span class="fa fa-twitter"></span></a>
						<a href="#"><span class="fa fa-linkedin"></span></a>
						<a href="#"><span class="fa fa-vimeo"></span></a>
						<a href="#"><span class="fa fa-rss"></span></a>-->
					</div>
				</div>
				
				<!--Top Right-->
				<div class="top-right">
					<ul class="dropdown-option clearfix">
						<?php
						if($u!="" && $session==true)
						{	?>
							<li class="account dropdown"><a class="btn btn-default dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" href="#"><span class="icon flaticon-user"></span>&ensp;My Account &nbsp;<span class="fa fa-angle-down"></span></a>
								<ul class="dropdown-menu style-one" aria-labelledby="dropdownMenu2">
									<li><a href="profile.php">My Profile</a></li>
									<li><a href="my_garage.php">My Garage</a></li>
									<!--
									<li><a href="my-garage.php">My Garage</a></li>
									<li><a href="#">Settings</a></li>
									<li><a href="shoping-cart.php">Cart</a></li>
									-->
								</ul>
							</li>
							<li><?php $tmp = explode("@", $u); echo $tmp[0]; ?></li>
							<li><a class="sell-car" href="logout.php">Logout</a></li>
							<?php
						}
						else
						{	?>
							<li><a class="sell-car" href="account.php">Login</a></li>
							<li><a class="sell-car" href="account.php">Register</a></li>
							<?php
						}
						?>
						<li><a class="sell-car" href="index-bn.php">বাং</a></li>
					</ul>
				</div>

			</div>
		</div>
	</div>

	<!--Header-Upper-->
	<div class="header-upper">
		<div class="auto-container">
			<div class="upper-inner clearfix">

				<div class="logo-outer">
					<div class="logo"><a rel="canonical" href="index.php"><img src="images/beta-logo-big-01.png" alt="Motortrader Logo" title="MotorTrader"></a></div>
				</div>

				<div class="upper-right clearfix">
					<div class="nav-outer clearfix">
						<!-- Main Menu -->
						<nav class="main-menu">
							<div class="navbar-header">
								<!-- Toggle Button -->
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								</button>
							</div>

							<div class="navbar-collapse collapse clearfix">
								<ul class="navigation clearfix">
									<li <?php if($menu=='home') { echo "class='current'"; } ?>><a rel="canonical" href="index.php">Home</a></li>
									<li <?php if($menu=='about') { echo "class='current'"; } ?>><a rel="canonical" href="about.php">About</a></li>
									<?php 
									if($u!="" && $session==true) { echo "<li"; if($menu=='sell-car') { echo " class='current'"; } echo "><a href='post.php'>Sell A Car</a></li>"; }
									else { echo "<li><a href='account.php'>Sell A Car</a></li>"; }
									?>
									<li <?php if($menu=='buy-car') { echo "class='current'"; } ?>><a href="buy-car.php">Buy A Car</a></li>
									<li <?php if($menu=='blogs') { echo "class='current'"; } ?>><a href="blogs.php">Blogs</a></li>
									<li <?php if($menu=='dealerships') { echo "class='current'"; } ?>><a href="dealerships.php">Dealerships</a></li>
									<li <?php if($menu=='contact') { echo "class='current'"; } ?>><a rel="canonical" href="contact.php">Contact Us</a></li>
									<!--
									<li><a href="#">Services</a></li>
									<li class="dropdown"><a href="#">Inventory</a>
										<ul>
											<li><a href="inventory-1.html">Inventory Style 01</a></li>
											<li><a href="inventory-2.html">Inventory Style 02</a></li>
											<li><a href="inventory-single.html">Single Inventory</a></li>
										</ul>
									</li>
									<li class="dropdown"><a href="#">News</a>
										<ul>
											<li><a href="#">Blog Default</a></li>
											<li><a href="news-classic.html">Blog Large Image</a></li>
											<li><a href="#">Blog Single Post</a></li>
										</ul>
									</li>
									<li class="dropdown"><a href="#">Pages</a>
										<ul>
											<li><a href="about.html">About Us</a></li>
											<li><a href="sell-car.html">Sell a Car</a></li>
											<li><a href="vehicle-compare.html">Select Vehicle Compare</a></li>
											<li><a href="vehicle-compare-2.html">Vehicle Comparison</a></li>
											<li><a href="faq.html">FAQ’s</a></li>
											<li><a href="loan-calculater.html">Loan Calculator</a></li>
											<li><a href="error-page.html">404 Page</a></li>
										</ul>
									</li>
									<li class="dropdown"><a href="#">Shop</a>
										<ul>
											<li><a href="#">Our Shop</a></li>
											<li><a href="shop-single.html">Shop Single</a></li>
											<li><a href="shoping-cart.html">Shoping Cart</a></li>
											<li><a href="checkout.html">CheckOut</a></li>
											<li><a href="account.html">Account</a></li>
										</ul>
									</li>
									<li><a href="contact.html">Contact</a></li>
									-->
								</ul>
							</div>
						</nav>
						<!-- Main Menu End-->

						<!--More Options- ->
						<div class="more-options">
							<div class="cart-box">
								<a href="shoping-cart.html">Cart <span class="icon fa fa-shopping-cart"><span class="number">0</span></span></a>
							</div>
						</div>
						-->

					</div>
				</div>

			</div>
		</div>
	</div>
	<!--End Header Upper-->

	<!--
	<div class="header-lower">
		<div class="auto-container">
			<div class="lower-inner">
				<ul class="info-block">
					<li><span class="icon flaticon-maps-and-flags"></span>Level#1, House#41, Road#7, Block#F, Banani, Dhaka-1213</li>
					<li><span class="icon flaticon-telephone"></span>Hotline: +88 01841000106</li>
					<li><span class="icon flaticon-timer"></span>Saturday - Thursday 11am - 7pm</li>
				</ul>
				<!-- Search - ->
				<div class="search-box">
					<form method="post" action="contact.html">
						<div class="form-group">
							<input type="search" name="search-field" value="" placeholder="Search..." required>
							<button type="submit"><span class="icon fa fa-search"></span></button>
						</div>
					</form>
				</div>
				- ->
			</div>
		</div>
	</div>
	-->

	<!--Sticky Header-->
	<div class="sticky-header">
		<div class="auto-container clearfix">
			<!--Logo-->
			<div class="logo pull-left">
				<a href="index.php" class="img-responsive" title="MotorTrader"><img src="images/logo-small.png" alt="Motortrader Logo" title="MotorTrader"></a>
			</div>

			<!--Right Col-->
			<div class="right-col pull-right">
				<!-- Main Menu -->
				<nav class="main-menu">
					<div class="navbar-header">
						<!-- Toggle Button -->
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
					</div>

					<div class="navbar-collapse collapse clearfix">
						<ul class="navigation clearfix">
							<li <?php if($menu=='home') { echo "class='current'"; } ?>><a rel="canonical" href="index.php?lang=En">Home</a></li>
							<li <?php if($menu=='about') { echo "class='current'"; } ?>><a rel="canonical" href="about.php">About</a></li>
							<?php 
							if($u!="" && $session==true) { echo "<li"; if($menu=='sell-car') { echo " class='current'"; } echo "><a href='post.php'>Sell A Car</a></li>"; }
							else { echo "<li><a href='account.php'>Sell A Car</a></li>"; }
							?>
							<li <?php if($menu=='buy-car') { echo "class='current'"; } ?>><a href="buy-car.php">Buy A Car</a></li>
							<li <?php if($menu=='blogs') { echo "class='current'"; } ?>><a href="blogs.php">Blogs</a></li>
							<li <?php if($menu=='dealerships') { echo "class='current'"; } ?>><a href="dealerships.php">Dealerships</a></li>
							<li <?php if($menu=='contact') { echo "class='current'"; } ?>><a rel="canonical" href="contact.php">Contact Us</a></li>
							<?php
							if($u!="" && $session==true) { echo "<li><a href='logout.php'>Logout</a></li>"; }
							else { echo "<li><a href='account.php'>Login</a></li>"; }
							?>

							<!--
							<li class="current"><a href="index.html">Home</a></li>
							<li><a href="#">Services</a></li>
							<li class="dropdown"><a href="#">Inventory</a>
								<ul>
									<li><a href="inventory-1.html">Inventory Style 01</a></li>
									<li><a href="inventory-2.html">Inventory Style 02</a></li>
									<li><a href="inventory-single.html">Single Inventory</a></li>
								</ul>
							</li>
							<li class="dropdown"><a href="#">News</a>
								<ul>
									<li><a href="#">Blog Default</a></li>
									<li><a href="news-classic.html">Blog Large Image</a></li>
									<li><a href="#">Blog Single Post</a></li>
								</ul>
							</li>
							<li class="dropdown"><a href="#">Pages</a>
								<ul>
									<li><a href="about.html">About Us</a></li>
									<li><a href="sell-car.html">Sell a Car</a></li>
									<li><a href="vehicle-compare.html">Select Vehicle Compare</a></li>
											<li><a href="vehicle-compare-2.html">Vehicle Comparison</a></li>
									<li><a href="faq.html">FAQ’s</a></li>
									<li><a href="loan-calculater.html">Loan Calculator</a></li>
									<li><a href="error-page.html">404 Page</a></li>
								</ul>
							</li>
							<li class="dropdown"><a href="#">Shop</a>
								<ul>
									<li><a href="#">Our Shop</a></li>
									<li><a href="shop-single.html">Shop Single</a></li>
									<li><a href="shoping-cart.html">Shoping Cart</a></li>
									<li><a href="checkout.html">CheckOut</a></li>
									<li><a href="account.html">Account</a></li>
								</ul>
							</li>
							<li><a href="contact.html">Contact</a></li>
							-->
						</ul>
					</div>
				</nav>
				<!-- Main Menu End-->
			</div>

		</div>
	</div>
	<!--End Sticky Header-->

</header>
<!--End Main Header -->
