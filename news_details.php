<?php session_start();require('files/session.php');if(isset($_REQUEST['nid'])) { $nid = $_REQUEST['nid']; } else { die("<script>window.location='news.php';</script>"); }if(isset($_POST['submitComm']) && isset($_POST['publicName']) && isset($_POST['publicEmail']) && isset($_POST['publicMobile']) && isset($_POST['publicMsg'])){	$n = $_POST['publicName'];	$e = $_POST['publicEmail'];	$m = $_POST['publicMobile'];	$l = $_POST['publicLoc'];	$c = $_POST['publicMsg'];	$p = $_POST['ratings'];		require('files/ts.php');	require('files/dbcon.php');		$sl = fnRowID("mt_news_comments");	$sql = "insert into `$db`.`mt_news_comments` values ('$sl', '$nid', '$n', '$e', '$m', '$l', '$c', '$p', 'y', '$now', NULL, NULL);";	mysqli_query($dbcon, $sql) or die($sql);	mysqli_close($dbcon);		die("<script>alert('You comment was submiitted successfully and pending for verification.'); window.location='news.php';</script>");}require('files/dbcon.php');$newsFound = false;$status = $uid = "";$sql = "select * from `$db`.`mt_news` where nid='$nid';";$r = mysqli_query($dbcon, $sql) or die($sql);while($row = mysqli_fetch_array($r, MYSQLI_BOTH)){	$newsFound = true;	$status = $row['status'];	$uid = $row['userid'];		$name = $row['name'];	$title = $row['title'];	$details = $row['details'];	$img = $row['img'];	$dt = $row['verifyOn'];	$d = substr($dt,8,2);	$m = monthname3(substr($dt,5,2));}if($newsFound==false) { die("<script>alert('WARNING!!! News/Article is not available, or not found.'); window.location='news.php';</script>"); }else {	if($u==$uid || (isset($_SESSION['mta-user']) && isset($_SESSION['mta-pass']))) { $public = false; }	elseif($status=="" || $status=="n") { die("<script>alert('WARNING!!! News/Article is not available now.'); window.location='news.php';</script>"); }	else { $public = true; }}function monthname3($m) {if($m=="01" || $m==1) { return "Jan"; }elseif($m=="02" || $m==2) { return "Feb"; }elseif($m=="03" || $m==3) { return "Mar"; }elseif($m=="04" || $m==4) { return "Apr"; }elseif($m=="05" || $m==5) { return "May"; }elseif($m=="06" || $m==6) { return "Jun"; }elseif($m=="07" || $m==7) { return "Jul"; }elseif($m=="08" || $m==8) { return "Aug"; }elseif($m=="09" || $m==9) { return "Sep"; }elseif($m=="10" || $m==10) { return "Oct"; }elseif($m=="11" || $m==11) { return "Nov"; }elseif($m=="12" || $m==12) { return "Dec"; }}function fnDate($dt) {	return monthname3(substr($dt,5,2))." ".substr($dt,8,2).", ".substr($dt,0,4);}?><!DOCTYPE html>
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
                                								<?php								if($status=='n') { echo "<h3 style='padding:5px 10px; background-color:#FF0000; color:#FFFFFF;'>Unverified and Unpublished News/Article. Please wait for approval from the Admin to available for general users.</h3><br>"; }								?>																<div class="image">
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
                                    									<!--									<div class="post-share-options clearfix">
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
									</div>									-->									
                                </div>
                            </div>
                        </div>

                    </div>

                    <!--Comments Area-->
                    <div class="comments-area">
						<?php						$comm = 0;						$sql = "select count(sl) from `$db`.`mt_news_comments` where status='y' and nid='$nid';";						$r = mysqli_query($dbcon, $sql) or die($sql);						while($row = mysqli_fetch_array($r, MYSQLI_BOTH))						{							$comm = $row[0];						}						echo "<div class='group-title'><h2>Comments ($comm)</h2></div>";												if($comm>0)						{							$sql = "select * from `$db`.`mt_news_comments` where status='y' and nid='$nid' order by verifyOn desc limit 0,5;";							$r = mysqli_query($dbcon, $sql) or die($sql);							while($row = mysqli_fetch_array($r, MYSQLI_BOTH))							{								echo "<div class='comment-box'>									<div class='comment'>										<div class='author-thumb'><img src='profile_pic/0.png' alt=''></div>										<div class='comment-inner'>											<div class='comment-info clearfix'>".$row['name']."&nbsp; – &nbsp;".$row['location']."&nbsp; – &nbsp;".fnDate($row['createdOn'])."</div>											<div class='rating'>";												for($i=1; $i<=$row['ptn']; $i++)												{													echo "<span class='fa fa-star'></span>";												}												for($j=$i; $j<=5; $j++)												{													echo "<span class='fa fa-star-o'></span>";												}											echo "</div>											<div class='text'>".$row['comments']."</div>										</div>									</div>								</div>";							}						}						?>
                    </div>
					<?php if($u!=$uid || $public==true) { ?>				   <!-- Comment Form -->
                    <div class="comment-form">
                        <div class="group-title"><h2>Leave a Reply</h2></div>
                        						<style>						.rating-box-mehedi {							display: inline-block;							position: relative;						}						.rating-box-mehedi #r0 {							margin-left:0px;							padding-left:15px;							padding-right:15px;							border-left:1px solid #ebebeb;						}						.rating-box-mehedi a {							position:relative;							display:inline-block;							padding-left:15px;							padding-right:15px;							border-right:1px solid #ebebeb;						}						.rating-box-mehedi a:hover {							color:#000;						}												.rating-click-off {							background-color:#FFFFFF;						}						.rating-click-on {							color:#000;							background-color:#FFCF00;						}						</style>												<script>						function fnRating(r) {							var rv = document.getElementById("ratings").value;														if((r==0 && rv=="0/5") || (r==1 && rv=="1/5") || (r==2 && rv=="2/5") || (r==3 && rv=="3/5") || (r==4 && rv=="4/5") || (r==5 && rv=="5/5")) {								/* same rating button clicked */							}							else 							{								rv = rv.substring(0,1);								document.getElementById("r"+rv).classList.remove('rating-click-on');								document.getElementById("r"+rv).classList.add('rating-click-off');								/* if(document.getElementById("r").classList.contains('rating')) {} */																document.getElementById("r"+r).classList.remove('rating-click-off');								document.getElementById("r"+r).classList.add('rating-click-on');																document.getElementById("ratings").value = r + "/5";							}						}						</script>												<form name='frmComm' method="post" action="news_details.php?nid=<?php echo $nid; ?>" onsubmit='return confirm("Are you sure you want to submit comments ?")'>							<div class="rating-box">
								<div class="rating-box-mehedi">									<div class="text"> Your Rating : <input type="text" name="ratings" id="ratings" value="5/5" required readonly></div>
									<a id=r0 onclick='fnRating(0)' title='0' class='rating-click-off'><span class="fa fa-thumbs-down"></span></a>									<a id=r1 onclick='fnRating(1)' title='1' class='rating-click-off'><span class="fa fa-star"></span></a>									<a id=r2 onclick='fnRating(2)' title='2' class='rating-click-off'><span class="fa fa-star"></span> <span class="fa fa-star"></span></a>									<a id=r3 onclick='fnRating(3)' title='3' class='rating-click-off'><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></a>									<a id=r4 onclick='fnRating(4)' title='4' class='rating-click-off'><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></a>									<a id=r5 onclick='fnRating(5)' title='5' class='rating-click-on'><span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span> <span class="fa fa-star"></span></a>								</div>
							</div>
                        
							<div class="row clearfix">								<div class="col-md-6 col-sm-6 col-xs-12 form-group">
									<input type="text" name="publicName" placeholder="Your Name *" required>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-12 form-group">
									<input type="email" name="publicEmail" placeholder="Your Email *" required>
								</div>								<div class="col-md-6 col-sm-6 col-xs-12 form-group">									<input type="text" name="publicMobile" placeholder="Your Mobile *" required>								</div>								<div class="col-md-6 col-sm-6 col-xs-12 form-group">									<select name='publicLoc' required><option value="" disabled selected>Select Your Location *</option><option>Dhaka</option><option>Chittagong</option><option>Rajshahi</option><option>Khulna</option><option>Barishal</option><option>Sylhet</option><option>Rangpur</option><option>Mymensingh</option></select>								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<textarea name="publicMsg" placeholder="Your Comments *"></textarea>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
									<input type=submit name="submitComm" class="theme-btn btn-style-one" value='Post Comment'>
								</div>
							</div>													<input type='hidden' name='nid' value='<?php echo $nid; ?>'>                        </form>
					</div>					<?php } ?>

                </div>				<!--Content Side-->

                <!--Sidebar Side-->
                <div class="sidebar-side col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <aside class="sidebar sidebar-padding with-border">

                        <!-- Popular Posts -->
                        <div class="sidebar-widget popular-posts">
                            <div class="sidebar-title"><h2>Recent Posts</h2></div>

                            <?php							$sql = "select * from `$db`.`mt_news` where nid<>'$nid' and status='y' order by verifyOn desc limit 0,5;";							$r = mysqli_query($dbcon, $sql) or die($sql);							while($row = mysqli_fetch_array($r, MYSQLI_BOTH))							{								echo "<article class='post'>								<figure class='post-thumb'><img src='news_pic/".$row['nid']."_".$row['img']."' style='width:80px; height:80px;' alt=''><a class='overlay' href='news_details.php?nid=".$row['nid']."'><span class='icon flaticon-unlink'></span></a></figure>								<div class='text'><a href='news_details.php?nid=".$row['nid']."'>".$row['title']."</a></div>								<ul class='post-meta'>								<li><span class='icon fa fa-user'></span>".$row['name']."</li>								<li><span class='icon fa fa-calendar'></span>".substr($row['createdOn'],8,2)." ".monthname3(substr($row['createdOn'],5,2))."</li>								</ul>								</article>\n";							}							?>

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
