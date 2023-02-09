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

    <?php $menu='cookie'; require('files/header.php'); ?>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/about-us.jpg);" aria-label="Motortrader SUV running through water puddle">

    </section>
    <!--End Page Title-->

    <!--Page Info-->
    <section class="page-info">
        <div class="auto-container">
            <ul class="bread-crumb">
                <li><a href="index.php">Home</a></li>
                <li>Pages</li>
                <li class="current">Community & Posting Rules</li>
            </ul>
        </div>
    </section>
    <!--End Page Info-->

    <!--About Section-->
    <section class="about-section" style='padding-top:0px;'>
        <div class="auto-container">
            <!--Sec Title-->
            <div class="sec-title" style='margin-bottom:20px;'>
                <h2>Community & Posting Rules</h2>
            </div>
            <div class="row clearfix">
                <!--Content Column-->
                <div class="content-column col-md-12 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <div class="text" style='text-align:justify'>
<style>
.square {
	list-style-list: circle;
	list-style-position: inside;
}
.square li {
	margin-bottom: 5px;
	background-color: #fff;
}
.square li:before {
	font-size:20px;
	content: "•"; 			/* Insert content that looks like bullets */
	color: black; 			/* Or a color you prefer */
	display: inline-block;
	padding-right: 15px;
}
</style>
						
<h2 style='margin-bottom:10px;'>Stay safe on Motortraderbd.com</h2>
<div style='color:#555; margin-bottom:30px;'>At Motortraderbd.com we are 100% committed to making sure that your experience on our site is as safe as possible.<br>Here you can find advice on how to stay safe while trading on Motortraderbd.com.</div>

<h3 style='margin-top:40px; margin-bottom:10px;'>General safety advice</h3>
<div class='' style='color:#555; margin-bottom:30px;'>
<ul class='square'>
  <li><b>Keep things local.</b> Meet the seller in person, check the item and make sure you are satisfied with it before you make a payment. Where available, use Doorstep Delivery and have items delivered to you directly.</li>
  <li><b>Exchange item and payment at the same time.</b> Buyers – don't make any payments before receiving an item. Sellers – don't send an item before receiving payment.</li>
  <li><b>Use common sense.</b> Avoid anything that appears too good to be true, such as unrealistically low prices and promises of quick money.</li>
  <li><b>Never give out financial information.</b> This includes bank account details, eBay/PayPal info, and any other information that could be misused.</li>
  <li><b>When you apply for a job.</b> Research the job and the employer before you apply. Don’t give out personal information before meeting the employer in person. Avoid going to remote locations for an interview.</li>
</ul>
</div>

<h3 style='margin-top:40px; margin-bottom:10px;'>Scams and frauds to watch out for</h3>
<div class='' style='color:#555; margin-bottom:30px;'>
<ul class='square'>
  <li><b>Fake payment services.</b> Motortraderbd.com does not offer any form of payment scheme or protection. Please report any emails claiming to offer such services. Avoid using online payment services or escrow sites unless you are 100% sure that they are genuine.</li>
  <li><b>Fake information requests.</b> Motortraderbd.com never sends emails requesting your personal details. If you receive an email asking you to provide your personal details to us, do not open any links. Please report the email and delete it.</li>
  <li><b>Fake fee requests.</b> Avoid anyone that ask for extra fees to buy or sell an item or service. Motortraderbd.com never requests payments for its basic services, and doesn't allow items that are not located in Bangladesh, so import and brokerage fees should never be required.</li>
  <li><b>Requests to use money transfer services such as Western Union or MoneyGram.</b> These services are not meant for transactions between strangers and many scams are run through them. Avoid requests to use these services.</li>
</ul>
</div>

<h3 style='margin-top:40px; margin-bottom:10px;'>Motortraderbd.com's safety measures</h3>
<div class='' style='color:#555; margin-bottom:30px;'>
We work continuously to ensure you have a safe, enjoyable experience on Motortraderbd.com.<br>
Our safety measures include:
<ul class='square'>
  <li>Hiding your email address on ads you post to protect you from spam.</li>
  <li>Giving you the option to hide your phone number on ads you post to protect you from spam.</li>
  <li>Making constant improvements to our technology to detect and prevent suspicious or inappropriate activity behind the scenes.</li>
  <li>Tracking reports of suspicious or illegal activity to prevent offenders from using the site again.</li>
</ul>
</div>

<h3 style='margin-top:40px; margin-bottom:10px;'>Reporting a safety issue</h3>
<div class='' style='color:#555; margin-bottom:30px;'>
If you feel that you have been the victim of a scam, please report your situation to us immediately. If you have been cheated, we also recommend that you contact your local police department.<br>
<br>
Motortraderbd.com is committed to ensuring the privacy of its users and therefore does not share information about its users publicly. However, we are committed to the safety of our users and will cooperate with the police department should we receive any requests for information in connection with fraudulent or other criminal activity.
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
