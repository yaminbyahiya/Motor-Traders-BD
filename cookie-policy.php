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
                <li class="current">Cookie Policy</li>
            </ul>
        </div>
    </section>
    <!--End Page Info-->

    <!--About Section-->
    <section class="about-section" style='padding-top:0px;'>
        <div class="auto-container">
            <!--Sec Title-->
            <div class="sec-title" style='margin-bottom:20px;'>
                <h2>Cookie Policy</h2>
            </div>
            <div class="row clearfix">
                <!--Content Column-->
                <div class="content-column col-md-12 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <div class="text" style='text-align:justify'>
The acknowledgment of cookies isn't a necessity for visiting the site and during normal browsing.  However the role of cookies and its use is necessary for use of certain features on the website, such as posting, signing up, purchasing “MT Report”, boosting posts, submitting news blogs, contacting, and advertising. Cookies are minuscule content records which distinguish your PC to our worker as an extraordinary client when you visit certain pages on the website and they are put away by your Internet browser on your PC's hard drive. Cookies can be utilized to perceive your Internet Protocol address, saving you time while you are on, or need to enter, the website. We just use cookies for your benefit in utilizing the site (for instance to recollect who you are the point at which you need to revise your purchases without having to return your email address) and not for acquiring or utilizing some other sensitive data about a user jeopardizing privacy unless it is benefit to enhance your experience and improve our systems. Limiting the collection of cookies is optional however will limit user towards 100% functionality of the website. It is our ethical responsibility and assertion that our utilization of cookies doesn't contain any close to home or private sensitive information and are free from malware and viruses. You can ignore or erase comparative information utilized by browser additional items, for example, Flash cookies, by changing the extra's settings or visiting the Web webpage of its producer. Since cookies permit you to use majority portion of motortraderbd.com's features, we suggest that you leave them turned on for better user experience.
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
