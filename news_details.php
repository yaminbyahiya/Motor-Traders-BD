<?php session_start();
<html>
<head>
<?php require('files/head.php'); ?>
</head>

<body>
<div class="page-wrapper">

    <!-- Preloader -->
    <div class="preloader"></div>

    <!-- Main Header-->
    <?php $menu='news'; require('files/header.php'); ?>
    <!--End Main Header -->

    <!--Sidebar Page Container-->
    <div class="sidebar-page-container">
      <div class="auto-container">
          <div class="row clearfix">

                <!--Content Side-->
                <div class="content-side col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="blog-single">

                        <!--News Block-->
                        <div class="news-block-two">
                            <div class="inner-box">
                                
                                    <img src='news_pic/<?php echo $nid."_".$img; ?>' alt=''>
                                </div>
                                <div class="lower-box">
                                    <div class="post-date"><?php echo $d; ?><br><?php echo $m; ?></div>
                                    <div class="content">
                                        <ul class="post-meta">
                                          <li><span class="icon fa fa-user"></span><?php echo $name; ?></li>
                                            <!--<li><span class="icon fa fa-eye"></span>95 Views</li>
                                            <li><span class="icon fa fa-comment"></span>5 Comments</li>
                                            <li><span class="icon fa fa-tag"></span>Best Dealer, Maintanence</li>-->
                                        </ul>
                                        <h3><?php echo $title; ?></h3>
                                        <div class="text"><?php echo $details; ?></div>
                                    </div>
                                    
                                        <div class="pull-left">
                                            <ul class="social-icon-two">
                                                <li class="share">Did You Like This Post? Share on</li>
                                                <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                                                <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                                                <li><a href="#"><span class="fa fa-google-plus"></span></a></li>
                                                <li><a href="#"><span class="fa fa-linkedin"></span></a></li>
                                            </ul>
                                        </div>
                                        <div class="pull-right">
                                            <ul class="new-posts">
                                              <li><a href="#"><span class="fa fa-angle-left"></span>&ensp; Prev</a></li>
                                                <li><a href="#">Next &ensp;<span class="fa fa-angle-right"></span></a></li>
                                            </ul>
                                        </div>
									</div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!--Comments Area-->
                    <div class="comments-area">
						<?php
                    </div>

                    <div class="comment-form">
                        <div class="group-title"><h2>Leave a Reply</h2></div>
                        
								<div class="rating-box-mehedi">
									<a id=r0 onclick='fnRating(0)' title='0' class='rating-click-off'><span class="fa fa-thumbs-down"></span></a>
							</div>
                        
							<div class="row clearfix">
									<input type="text" name="publicName" placeholder="Your Name *" required>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 form-group">
									<input type="email" name="publicEmail" placeholder="Your Email *" required>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<textarea name="publicMsg" placeholder="Your Comments *"></textarea>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<input type=submit name="submitComm" class="theme-btn btn-style-one" value='Post Comment'>
								</div>
							</div>
					</div>

                </div>

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <aside class="sidebar sidebar-padding with-border">

                        <!-- Popular Posts -->
                        <div class="sidebar-widget popular-posts">
                            <div class="sidebar-title"><h2>Recent Posts</h2></div>

                            <?php

						</div>

                    </aside>
                </div>

            </div>
        </div>
    </div>
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