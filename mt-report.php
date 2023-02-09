<?php session_start();
require('files/session.php');
//if($u!="" && $session==true) { die("<script>window.location='index.php?lang=En';</script>"); }
?>

<!DOCTYPE html>
<html>
<head>
<?php require('files/head.php'); ?>
</head>

<body>
<script>
localStorage.setItem("mt_comp1",1);
localStorage.setItem("mt_comp2",2);
</script>

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <?php $menu='mtreport'; require('files/header.php'); ?>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/about-us.jpg);" aria-label="Motortrader SUV running through water puddle">

    </section>
    <!--End Page Title-->

    <!--Page Info-->
    <section class="page-info">
        <div class="auto-container">
            <ul class="bread-crumb">
                <li><a href="index.php?lang=En">Home</a></li>
                <li>Pages</li>
                <li class="current">MT Report</li>
            </ul>
        </div>
    </section>
    <!--End Page Info-->

    <!--About Section-->
    <section class="about-section" style='padding-top:0px;'>
        <div class="auto-container">
            <!--Sec Title-->
            <div class="sec-title">
                <h2>About MT REPORT</h2>
            </div>
            <div class="row clearfix">
                <!--Content Column-->
                <div class="content-column col-md-4 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <div class="text" style='margin-bottom:10px;'><b>What is MT Report ?</b></div>
						<div class="text">An MT Report is an Auction Sheet that provides basic information and a good overview of the vehicle. It is a crucial part of buying used cars as it helps to determine and evaluate the condition of the vehicle, laying out details such as :<br>
• &nbsp; Chassis Number<br>
• &nbsp; First registration date of the vehicle<br>
• &nbsp; Crash repair history<br>
• &nbsp; Dents or scratches on the vehicle<br>
• &nbsp; Rust or corrosion on the vehicle<br>
• &nbsp; Body and Car type<br>
• &nbsp; Interior condition<br>
• &nbsp; Any engine noise or transmission problems<br>
• &nbsp; Oil leaks<br>
• &nbsp; If the vehicle has been re-sprayed<br>
• &nbsp; Engine displacement<br>
						</div>
                    </div>
                </div>

				<!--Blocks Column-->
                <div class="blocks-column col-md-8 col-sm-12 col-xs-12">
                    <div class="row clearfix">
                        <!--About Block-->
                        <div class="about-block col-md-6 col-sm-6 col-xs-12">
                            <div class="inner-box">
                                <div class="image">
                                    <img src="images/mt.jpg" alt="Motortrader Picutre of an Auction sheet" style=''>
                                </div>
                            </div>
                        </div>

                        <!--About Block-->
                        <div class="about-block col-md-6 col-sm-6 col-xs-12">
                            <div class="inner-box">
                                <div class="lower-box">
                                    <div class="text">After a thorough inspection, the vehicle would be designated with an Auction grade which is the overall rating of its condition. “S” means brand new; “R” is for repaired and “XX” stands for damaged car. In addition, the car is also graded by numeric figures indicating the quality of the vehicle is as low as the figure is.<br>
									<br>
									If the seller hasn’t provided an MT Report then you can put in a request for it. The admin will then try to acquire it and provide it to you. Buying a MT Report will have a charge.
									</div>
									<br>
									<h4>Downloading each MT Report will have a charge of <b>1200 taka</b> only.</h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section-->

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
<script src="js/wow.js"></script>
<script src="js/script.js"></script>

</body>
</html>
