<?php session_start();require('files/session.php');function monthname3($m) {if($m=="01" || $m==1) { return "Jan"; }elseif($m=="02" || $m==2) { return "Feb"; }elseif($m=="03" || $m==3) { return "Mar"; }elseif($m=="04" || $m==4) { return "Apr"; }elseif($m=="05" || $m==5) { return "May"; }elseif($m=="06" || $m==6) { return "Jun"; }elseif($m=="07" || $m==7) { return "Jul"; }elseif($m=="08" || $m==8) { return "Aug"; }elseif($m=="09" || $m==9) { return "Sep"; }elseif($m=="10" || $m==10) { return "Oct"; }elseif($m=="11" || $m==11) { return "Nov"; }elseif($m=="12" || $m==12) { return "Dec"; }}?><!DOCTYPE html>
<html>
<head>
<?php require('files/head.php'); ?>
</head>

<body>
<div class="page-wrapper">

  <!-- Preloader -->
  <div class="preloader"></div>

  <?php $menu='news'; require('files/header.php'); ?>

    </header>
    <!--End Main Header -->

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/news.jpg);">
        <div class="auto-container">
            <h1></h1>
        </div>
    </section>
    <!--End Page Title-->

    <!--Page Info-->
    <section class="page-info">
        <div class="auto-container">
            <ul class="bread-crumb">
                <li><a href="index.php?lang=En">Home</a></li>
                <li>Pages</li>
                <li class="current">News</li>
            </ul>
        </div>
    </section>
    <!--End Page Info-->

    <!--News Page Section-->
    <section class="news-page-section">
    	<div class="auto-container">
        	<div class="row clearfix">

            	<?php				require('files/dbcon.php');				$sql = "select name, nid, title, title2, img, verifyOn from `$db`.`mt_news` where status='y' and verifyBy is not null and verifyOn is not null order by verifyOn desc limit 0, 9;";				$r = mysqli_query($dbcon, $sql) or die("$sql");				while($row = mysqli_fetch_array($r, MYSQLI_BOTH))				{					$name = $row['name'];					$nid = $row['nid'];					$t1 = $row['title'];					$t2 = $row['title2'];					$img = $row['img'];					$dt = $row['verifyOn'];					$d = substr($dt,8,2);					$m = monthname3(substr($dt,5,2));										echo "<!--News Block-->					<div class='news-block col-lg-4 col-md-6 col-sm-6 col-xs-12'>						<div class='inner-box'>							<div class='image'>								<img src='news_pic/".$nid."_".$img."' alt='' height=250 />								<a class='overlay-link' href='news_details.php?nid=".$nid."'><span class='icon fa fa-link'></span></a>							</div>							<div class='lower-box'>								<div class='post-date'>$d<br>$m</div>								<div class='content'>									<div class='author'>$name</div>									<h3><a href='news_details.php?nid=".$nid."'>$t1</a></h3>									<div class='text'>t2</div>								</div>							</div>						</div>					</div>";				}				mysqli_close($dbcon);				?>								<!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
                	<div class="inner-box">
                    	<div class="image">
                        	<img src="images/resource/news-1.jpg" alt="" />
                            <a class="overlay-link" href="news-single.php"><span class="icon fa fa-link"></span></a>
                        </div>
                        <div class="lower-box">
                        	<div class="post-date">21 <br> Nov</div>
                        	<div class="content">
                            	<div class="author">By Jack Stonney</div>
                                <h3><a href="news-single.php">Distributed throughout the all over country.</a></h3>
                                <div class="text">Great explorer of the truth, the master builder of human happiness.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
                	<div class="inner-box">
                    	<div class="image">
                        	<img src="images/resource/news-2.jpg" alt="" />
                            <a class="overlay-link" href="news-single.php"><span class="icon fa fa-link"></span></a>
                        </div>
                        <div class="lower-box">
                        	<div class="post-date">14 <br> Oct</div>
                        	<div class="content">
                            	<div class="author">By Joe Venanda</div>
                                <h3><a href="news-single.php">Get some usefull maintanence tips from our expets.</a></h3>
                                <div class="text">There anyone who loves or pursues or sed desires to obtain pain of itself.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
                	<div class="inner-box">
                    	<div class="image">
                        	<img src="images/resource/news-3.jpg" alt="" />
                            <a class="overlay-link" href="news-single.php"><span class="icon fa fa-link"></span></a>
                        </div>
                        <div class="lower-box">
                        	<div class="post-date">05 <br> Jun</div>
                        	<div class="content">
                            	<div class="author">By Lee Philipson</div>
                                <h3><a href="news-single.php">High quality cars only we selling to our customers.</a></h3>
                                <div class="text">Which toil and pain can procure him some great pleasure to take a trivial.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
                	<div class="inner-box">
                    	<div class="image">
                        	<img src="images/resource/news-4.jpg" alt="" />
                            <a class="overlay-link" href="news-single.php"><span class="icon fa fa-link"></span></a>
                        </div>
                        <div class="lower-box">
                        	<div class="post-date">18 <br> May</div>
                        	<div class="content">
                            	<div class="author">By Lee Philipson</div>
                                <h3><a href="news-single.php">Vehicles are distributed throughout the all over country.</a></h3>
                                <div class="text">Which toil and pain can procure him some great pleasure to take a trivial.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
                	<div class="inner-box">
                    	<div class="image">
                        	<img src="images/resource/news-5.jpg" alt="" />
                            <a class="overlay-link" href="news-single.php"><span class="icon fa fa-link"></span></a>
                        </div>
                        <div class="lower-box">
                        	<div class="post-date">07 <br> Apr</div>
                        	<div class="content">
                            	<div class="author">By Jack Stonney</div>
                                <h3><a href="news-single.php">Distributed throughout the all over country.</a></h3>
                                <div class="text">Great explorer of the truth, the master builder of human happiness.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
                	<div class="inner-box">
                    	<div class="image">
                        	<img src="images/resource/news-6.jpg" alt="" />
                            <a class="overlay-link" href="news-single.php"><span class="icon fa fa-link"></span></a>
                        </div>
                        <div class="lower-box">
                        	<div class="post-date">24 <br> Mar</div>
                        	<div class="content">
                            	<div class="author">By Joe Venanda </div>
                                <h3><a href="news-single.php">Get some usefull maintanence tips from our expets.</a></h3>
                                <div class="text">There anyone who loves or pursues or sed desires to obtain pain of itself.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
                	<div class="inner-box">
                    	<div class="image">
                        	<img src="images/resource/news-7.jpg" alt="" />
                            <a class="overlay-link" href="news-single.php"><span class="icon fa fa-link"></span></a>
                        </div>
                        <div class="lower-box">
                        	<div class="post-date">12 <br> Mar</div>
                        	<div class="content">
                            	<div class="author">By Joe Venanda </div>
                                <h3><a href="news-single.php">Get some usefull maintanence tips from our expets.</a></h3>
                                <div class="text">There anyone who loves or pursues or sed desires to obtain pain of itself.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
                	<div class="inner-box">
                    	<div class="image">
                        	<img src="images/resource/news-8.jpg" alt="" />
                            <a class="overlay-link" href="news-single.php"><span class="icon fa fa-link"></span></a>
                        </div>
                        <div class="lower-box">
                        	<div class="post-date">26 <br> feb</div>
                        	<div class="content">
                            	<div class="author">By Lee Philipson</div>
                                <h3><a href="news-single.php">Vehicles are distributed throughout the all over country.</a></h3>
                                <div class="text">Which toil and pain can procure him some great pleasure to take a trivial.</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--News Block-->
                <div class="news-block col-lg-4 col-md-6 col-sm-6 col-xs-12">
                	<div class="inner-box">
                    	<div class="image">
                        	<img src="images/resource/news-9.jpg" alt="" />
                            <a class="overlay-link" href="news-single.php"><span class="icon fa fa-link"></span></a>
                        </div>
                        <div class="lower-box">
                        	<div class="post-date">04 <br> feb</div>
                        	<div class="content">
                            	<div class="author">By Jack Stonney</div>
                                <h3><a href="news-single.php">Distributed throughout the all over country.</a></h3>
                                <div class="text">Great explorer of the truth, the master builder of human happiness.</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
			<!--Styled Pagination-->
            <div class="styled-pagination text-center">
                <ul class="clearfix">
                	<li><a href="#"><span class="fa fa-caret-left"></span></a></li>
                    <li><a href="#" class="active">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#"><span class="fa fa-caret-right"></span></a></li>
                </ul>
            </div>
            <!--End Styled Pagination-->
        </div>
    </section>
    <!--End News Page Section-->

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
