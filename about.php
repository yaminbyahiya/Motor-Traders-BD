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

    <?php $menu='about'; require('files/header.php'); ?>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/about-us.jpg);", aria-label="Motortrader SUV running over water puddle">

    </section>
    <!--End Page Title-->

    <!--Page Info-->
    <section class="page-info">
        <div class="auto-container">
            <ul class="bread-crumb">
                <li><a href="index.php">Home</a></li>
                <li>Pages</li>
                <li class="current">About Us</li>
            </ul>
        </div>
    </section>
    <!--End Page Info-->

    <!--About Section-->
    <section class="about-section">
        <div class="auto-container">
            <!--Sec Title-->
            <div class="sec-title">
                <h2>About MotorTrader</h2>
            </div>
            <div class="row clearfix">
                <!--Content Column-->
                <div class="content-column col-md-4 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <div class="image"><img src="images/logo.png" alt="MotorTrader" /></div>
						<div class="bold-text"><q> We have the right products to fit your needs </q> <span class="theme_color">&mdash; MotorTrader</span></div>
                        <div class="text">MotorTrader Bangladesh encompasses the only digital platform catering to potential buyers in regards to helping their needs in acquiring a new vehicle. Our platform’s soul agenda is to create an online marketplace which is transparent for both the buyer and seller eradicating any doubts of legitimacy. We are a dedicated business for vehicle classifieds and our website’s simplicity and ease of use ensure potential client’s satisfaction.</div>
                    </div>
                </div>

				<!--Blocks Column-->
                <div class="blocks-column col-md-8 col-sm-12 col-xs-12">
                    <div class="row clearfix">
                        <!--About Block-->
                        <div class="about-block col-md-6 col-sm-6 col-xs-12">
                            <div class="inner-box">
                                <div class="image">
                                    <img src="images/pg_about/mission.png" alt="Motortrader Pickup truck on beach" />
                                </div>
                                <div class="lower-box">
                                    <h3>Our Mission</h3>
                                    <div class="text">MotorTrader is a classified website that deals with trading of motor vehicles. The main aim is to have a transparent and accessible marketplace for interested buyers and sellers.</div>
                                </div>
                            </div>
                        </div>

                        <!--About Block-->
                        <div class="about-block col-md-6 col-sm-6 col-xs-12">
                            <div class="inner-box">
                                <div class="image">
                                    <img src="images/pg_about/vision.png" alt="Motortrader man driving audi car" />
                                </div>
                                <div class="lower-box">
                                    <h3>Our Vision</h3>
                                    <div class="text">MotorTrader aspires to be the biggest market place for motor vehicles online. The addition of wide range of products and services will help create value for the customers as well as the company</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section-->

	<?php require('files/why_choose_us.php'); ?>

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
