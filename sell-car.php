<?php session_start();require('files/session.php');if($u!="" && $session==true) { die("<script>window.location='post.php';</script>"); }else { die("<script>window.location='login.php';</script>"); }?><!DOCTYPE html>
<html>
<head>
<?php require('files/head.php'); ?>
<!-- Stylesheets -->
<link href="plugins/revolution/css/settings.css" rel="stylesheet" type="text/css"><!-- REVOLUTION SETTINGS STYLES -->
<link href="plugins/revolution/css/layers.css" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->
<link href="plugins/revolution/css/navigation.css" rel="stylesheet" type="text/css"><!-- REVOLUTION NAVIGATION STYLES -->
</head>
<body>
<div class="page-wrapper">
  <!-- Preloader -->
  <div class="preloader"></div>
  <?php $menu='sell-car'; require('files/header.php'); ?>
    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/sell-car.jpg);">
        <div class="auto-container">
            <h1>Sell Your Car</h1>
        </div>
    </section>
    <!--End Page Title-->

    <!--Page Info-->
    <section class="page-info">
        <div class="auto-container">
            <ul class="bread-crumb">
                <li><a href="index.html">Home</a></li>
                <li>Pages</li>
                <li class="current">Sell Your Car</li>
            </ul>
        </div>
    </section>
    <!--End Page Info-->

    <!--Sell Car Section-->
    <section class="sell-car-section">
    	<div class="auto-container">
        	<div class="row clearfix">
            	<!--Cell Car Column-->
            	<div class="cell-car-column col-lg-9 col-md-8 col-sm-12 col-xs-12">
                	<div class="inner-column">
                        <!--Sec Title-->
                        <div class="sec-title">
                            <h2 style="text-align:center;">Sell Your Car For Free</h2>
                        </div>
                        <div class="text">Interested in selling us your vehicle? Simply enter in the vehicle information below along with your contact information and we will contact you shortly. Fields marked with (*) are required.</div>

                        <!--Sell Car Form-->
                        <div class="sell-car-form">
                        	<h2>Vehicle Information</h2>
                        	<div class="form-box">
                                <form method="post" action="calculater-form">
                                    <div class="row clearfix">
                                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <label>Make</label>
                                            <input type="text" name="fname" value="" placeholder="" required>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <label>Model</label>
                                            <input type="text" name="fname" value="" placeholder="" required>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <label>Body</label>
                                            <input type="text" name="fname" value="" placeholder="" required>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <label>Year</label>
                                            <input type="text" name="fname" value="" placeholder="" required>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <label>Transmission</label>
                                            <input type="text" name="fname" value="" placeholder="" required>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <label>Mileage</label>
                                            <input type="text" name="fname" value="" placeholder="" required>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label class="upload">Upload Car Photos</label>
                                            <div class="field-inner clearfix">
                                            	<button type="button" class="upload-btn"><span class="fa fa-file-picture-o"></span> Choose File ...</button>
                                                <button type="button" class="more-btn">Add More Files</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--End Cell Car Form-->

                        <!--Cell Car Form-->
                        <div class="sell-car-form">
                        	<h2>Contact Information</h2>
                        	<div class="form-box">
                                <form method="post" action="calculater-form">
                                    <div class="row clearfix">
                                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <label>Name *</label>
                                            <input type="text" name="fname" value="" placeholder="" required>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <label>Email *</label>
                                            <input type="text" name="fname" value="" placeholder="" required>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <label>Phone *</label>
                                            <input type="text" name="fname" value="" placeholder="" required>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <label>Address</label>
                                            <input type="text" name="fname" value="" placeholder="" required>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <label>City</label>
                                            <input type="text" name="fname" value="" placeholder="" required>
                                        </div>
                                        <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                            <label>Zipcode</label>
                                            <input type="text" name="fname" value="" placeholder="" required>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <label>Your Message...</label>
                                            <textarea placeholder="" ></textarea>
                                        </div>
                                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                            <button type="submit" class="theme-btn btn-style-one">submit Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--End Cell Car Form-->

                    </div>
                </div>
                <!--Faq Column-->
                <div class="form-column col-lg-3 col-md-4 col-sm-12 col-xs-12">

                    <!-- Search Box -->
                    <div class="faq-search-box">
                    	<div class="outer-box">
                            <form method="post" action="contact.html">
                                <div class="form-group">
                                    <input type="search" name="search-field" value="" placeholder="Search" required>
                                    <button type="submit"><span class="icon fa fa-search"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!--Select Car Tabs-->
                    <div class="select-cars-tabs">
                        <!--Tabs Box-->
                        <div class="prod-tabs tabs-box">

                            <!--Tab Btns-->
                            <ul class="tab-btns tab-buttons clearfix">
                                <li data-tab="#prod-new-cars" class="tab-btn active-btn">New Cars</li>
                                <li data-tab="#prod-used-cars" class="tab-btn">Used Cars</li>
                            </ul>

                            <!--Tabs Container-->
                            <div class="tabs-content">

                                <!--Tab / Active Tab-->
                                <div class="tab active-tab" id="prod-new-cars">
                                    <div class="content">

                                        <!--Cars Form-->
                                        <div class="cars-form">
                                            <form method="post" action="contact.html">

                                                <div class="form-group">
                                                    <label>Make:</label>
                                                    <select class="custom-select-box">
                                                        <option>Any Make</option>
                                                        <option>Make One</option>
                                                        <option>Make Two</option>
                                                        <option>Make Three</option>
                                                        <option>Make Four</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Model:</label>
                                                    <select class="custom-select-box">
                                                        <option>Any Model</option>
                                                        <option>Model Two</option>
                                                        <option>Model Three</option>
                                                        <option>Model Four</option>
                                                        <option>Model Five</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Body:</label>
                                                    <select class="custom-select-box">
                                                        <option>Convertible</option>
                                                        <option>Convertible 1</option>
                                                        <option>Convertible 2</option>
                                                        <option>Convertible 3</option>
                                                        <option>Convertible 4</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Year:</label>
                                                    <select class="custom-select-box">
                                                        <option>2012-2013</option>
                                                        <option>2013-2014</option>
                                                        <option>2014-2015</option>
                                                        <option>2015-2016</option>
                                                        <option>2016-2017</option>
                                                    </select>
                                                </div>

                                                <div class="row clearfix">
                                                	<div class="form-group inner-group col-md-6 col-sm-6 col-xs-12">
                                                        <label>Min Price:</label>
                                                        <select class="custom-select-box">
                                                            <option>$300000</option>
                                                            <option>$400000</option>
                                                            <option>$500000</option>
                                                            <option>$600000</option>
                                                            <option>$700000</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group inner-group col-md-6 col-sm-6 col-xs-12">
                                                        <label>Max Price:</label>
                                                        <select class="custom-select-box">
                                                            <option>$400000</option>
                                                            <option>$500000</option>
                                                            <option>$600000</option>
                                                            <option>$700000</option>
                                                            <option>$800000</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Transmission:</label>
                                                    <select class="custom-select-box">
                                                        <option>Semi Automatic</option>
                                                        <option>Automatic 1</option>
                                                        <option>Automatic 2</option>
                                                        <option>Automatic 3</option>
                                                        <option>Automatic 4</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Colors:</label>
                                                    <select class="custom-select-box">
                                                        <option>Titanium Metalic</option>
                                                        <option>Color 1</option>
                                                        <option>Color 2</option>
                                                        <option>Color 3</option>
                                                        <option>Color 4</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                	<button class="theme-btn btn-style-one">Find a Car</button>
                                                </div>

                                                <div class="form-group">
                                                	<button type="reset" class="reset-all"><span class="fa fa-refresh"></span>Reset all</button>
                                                </div>

                                            </form>
                                        </div>

                                    </div>
                                </div>

                                <!--Tab-->
                                <div class="tab" id="prod-used-cars">
                                    <div class="content">

                                       	<!--Cars Form-->
                                        <div class="cars-form">
                                            <form method="post" action="contact.html">

                                                <div class="form-group">
                                                    <label>Make:</label>
                                                    <select class="custom-select-box">
                                                        <option>Any Make</option>
                                                        <option>Make One</option>
                                                        <option>Make Two</option>
                                                        <option>Make Three</option>
                                                        <option>Make Four</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Model:</label>
                                                    <select class="custom-select-box">
                                                        <option>Any Model</option>
                                                        <option>Model Two</option>
                                                        <option>Model Three</option>
                                                        <option>Model Four</option>
                                                        <option>Model Five</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Body:</label>
                                                    <select class="custom-select-box">
                                                        <option>Convertible</option>
                                                        <option>Convertible 1</option>
                                                        <option>Convertible 2</option>
                                                        <option>Convertible 3</option>
                                                        <option>Convertible 4</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Year:</label>
                                                    <select class="custom-select-box">
                                                        <option>2012-2013</option>
                                                        <option>2013-2014</option>
                                                        <option>2014-2015</option>
                                                        <option>2015-2016</option>
                                                        <option>2016-2017</option>
                                                    </select>
                                                </div>

                                                <div class="row clearfix">
                                                	<div class="form-group inner-group col-md-6 col-sm-6 col-xs-12">
                                                        <label>Min Price:</label>
                                                        <select class="custom-select-box">
                                                            <option>$300000</option>
                                                            <option>$400000</option>
                                                            <option>$500000</option>
                                                            <option>$600000</option>
                                                            <option>$700000</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group inner-group col-md-6 col-sm-6 col-xs-12">
                                                        <label>Max Price:</label>
                                                        <select class="custom-select-box">
                                                            <option>$400000</option>
                                                            <option>$500000</option>
                                                            <option>$600000</option>
                                                            <option>$700000</option>
                                                            <option>$800000</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label>Transmission:</label>
                                                    <select class="custom-select-box">
                                                        <option>Semi Automatic</option>
                                                        <option>Automatic 1</option>
                                                        <option>Automatic 2</option>
                                                        <option>Automatic 3</option>
                                                        <option>Automatic 4</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Colors:</label>
                                                    <select class="custom-select-box">
                                                        <option>Titanium Metalic</option>
                                                        <option>Color 1</option>
                                                        <option>Color 2</option>
                                                        <option>Color 3</option>
                                                        <option>Color 4</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                	<button class="theme-btn btn-style-one">Find a Car</button>
                                                </div>

                                                <div class="form-group">
                                                	<button type="reset" class="reset-all"><span class="fa fa-refresh"></span>Reset all</button>
                                                </div>

                                            </form>
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
    <!--End Sell Car Section-->

    <!--Main Footer-->
      <?php require('files/footer.php'); ?>
    <!--End Main Footer-->

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
</body>
</html>
