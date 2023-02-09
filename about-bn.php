<?php session_start();
require('files/session.php');
//if($u!="" && $session==true) { die("<script>window.location='index-bn.php';</script>"); }
?>

<!DOCTYPE html>
<html>
<head>
<?php require('files/head-bn.php'); ?>
</head>

<body>
<script>
localStorage.setItem("mt_comp1",1);
localStorage.setItem("mt_comp2",2);
</script>

<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <?php $menu='about'; require('files/header-bn.php'); ?>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/about-us.jpg);" aria-label="Motortrader SUV running over water puddle">

    </section>
    <!--End Page Title-->

    <!--Page Info-->
    <section class="page-info">
        <div class="auto-container">
            <ul class="bread-crumb">
                <li><a href="index-bn.php">হোম</a></li>
                <li>পেজেস</li>
                <li class="current">আমাদের পরিচিতি</li>
            </ul>
        </div>
    </section>
    <!--End Page Info-->

    <!--About Section-->
    <section class="about-section">
        <div class="auto-container">
            <!--Sec Title-->
            <div class="sec-title">
                <h2>মোটরট্রেডার</h2>
            </div>
            <div class="row clearfix">
                <!--Content Column-->
                <div class="content-column col-md-4 col-sm-12 col-xs-12">
                    <div class="inner-column">
                        <div class="image"><img src="images/logo.png" alt="MotorTrader" /></div>
						<div class="bold-text"><q> বেছে নিন গাড়ি ঠিক আপনার প্রয়োজন অনুসারে </q> <span class="theme_color">&mdash; মোটরট্রেডার</span></div>
                        <div class="text">মোটরট্রেডার বাংলাদেশ দেশের প্রথম গাড় বেচাকেনার অনলাইন মার্কেটপ্লেস যেখানে নতুন এবং পুরাতন গাড়ির সবচেয়ে বড় লিস্টিং পাওয়া যাবে, যা থেকে সবাই বেছে নিতে পারবে তাদের পছন্দের গাড়িটি। আমাদের মূল লক্ষ্য হবে যেন বেচাকেনার প্রতিটি ধাপ হয় খুবই সহজ আর লেনদেন হয় ঝামেলা মুক্ত।</div>
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
                                    <h3><a href="#">আমাদের কাজ</a></h3>
                                    <div class="text">মোটরট্রেডার একটি ক্লাসিফাড ওয়েবসাইট যা মোটর গাড়ির বেচাকেনার জন্য আলাদাভাবে তৈরি। আগ্রহী ক্রেতা এবং বিক্রেতাদের জন্য স্বচ্ছ এবং সহজলভ্য একটি মার্কেটপ্লেস তৈরি করা হল এর মূল লক্ষ্য।</div>
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
                                    <h3><a href="#">আমাদের লক্ষ্য</a></h3>
                                    <div class="text">মোটরট্রেডার গাড়ি বেচাকেনায় বাংলাদেশের সবচাইতে বড় মার্কেটপ্লেস হিসেবে নিজেদের প্রতিষ্ঠিত করতে চায়। যেখানে থাকবে গাড়ির সবচাইতে বড় ইনভেন্টরি এবং অর্জন করবে ক্রেতা ও বিক্রেতাদের আস্থা।</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End About Section-->

	<?php require('files/why_choose_us-bn.php'); ?>

    <?php require('files/footer-bn.php'); ?>

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
