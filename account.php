<?php session_start();
require('files/session.php');
if($u!="" && $session==true) { die("<script>window.location='index.php';</script>"); }
?>

<!DOCTYPE html>
<html>
<head>
<?php require('files/head.php'); ?>
</head>

<body>
<div class="page-wrapper">
 	
    <!-- Preloader -->
    <div class="preloader"></div>
 	
    <?php $menu='account'; require('files/header.php'); ?>
    
    <!--Register Section-->
    <section class="register-section" style="padding-top:40px;">
        <div class="auto-container">
            <div class="row clearfix">
                
                <!--Form Column-->
                <div class="form-column column col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
                    <div class="form-title">
                        <h2>Login &nbsp;Now</h2>
                    </div>
                    
                    <!--Login Form-->
                    <div class="styled-form login-form">
                        <form name='frmLogin' method="post" action="login.php">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 col-sm-12" style="margin-bottom: 10px;">
                                        <a href='rashik/facebook.php'><img src='images/login_facebook.png' width=200 title='' alt='Login with Facebook'></a>
                                    </div>
    								<div class="col-md-4 col-lg-4 col-sm-12" style="margin-bottom: 10px;">
    								    <a href='rashik/gmail-callback.php' ><img src='images/login_gmail.png' width=200 title='' alt='Login with Gmail'></a>
    								</div>
									<div class="col-md-4 col-lg-4 col-sm-12" style="margin-bottom: 10px;">
										<a href='rashik/apple-login.php'><img src='images/login_apple.png' width=200 title='' alt='Login with Apple ID'></a>
									</div>
                                </div>
							</div>
							
							<hr style='margin-bottom:30px;'>
							
							<div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                                <input type="email" name="email" minlength='3' maxlength=50 value="" placeholder="Email Address *" required>
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="pass" minlength='3' maxlength=20 value="" placeholder="Enter Password *" required>
								<!-- pattern -->
                            </div>
                            <div class="clearfix">
                                <div class="form-group pull-left">
									<input type='submit' name='submitLogin' value='LOGIN' class="theme-btn btn-style-one">
                                </div>
                                <!--
								<div class="form-group social-links-two pull-right">
                                    Or login with <a href="#" class="img-circle facebook"><span class="fa fa-facebook-f"></span></a> <a href="#" class="img-circle twitter"><span class="fa fa-twitter"></span></a> <a href="#" class="img-circle google-plus"><span class="fa fa-google-plus"></span></a>
                                </div>
								-->
								<div class="form-group submit-text pull-left">
                                	&nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" id="remember-me" name="remember" style='cursor:pointer;' value='yes'><label class="remember-me" for="remember-me">&nbsp; Remember Me</label>
                                </div>
                            </div>
							
							<a href='forgot-password.php' class='theme-btn btn-style-three' style='color:#000;'>FORGOT PASSWORD ?</a><br>
							
                        </form>
                    </div>
                </div>
                
                <!--Form Column-->
                <div class="form-column column col-lg-6 col-md-6 col-sm-12 col-xs-12">
                
                    <div class="form-title">
                        <h2>Register &nbsp;Here</h2>
                    </div>
                    
                    <!--Register Form-->
                    <div class="styled-form register-form">
                        <script>
						function validFrmRegister()
						{
							var a;
							a = document.frmRegister.name.value;		if(a=="" || a==null) { return false; }
							a = document.frmRegister.email.value;		if(a=="" || a==null) { return false; }
							a = document.frmRegister.pass1.value;		if(a=="" || a==null) { return false; }
							if(a==document.frmRegister.pass2.value) {} 	else { alert('Password did not match. Please check.'); return false; }
							return confirm('Are you sure you want to register on MotorTrader ?');
						}
						</script>
						
						<form name='frmRegister' method="post" action="account_register_submit.php" onsubmit='return validFrmRegister()'>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-user"></span></span>
                                <input type="text" name="name" minlength='3' maxlength=50 value="" placeholder="Your Name *" required>
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-envelope-o"></span></span>
                                <input type="email" name="email" minlength='3' maxlength=50 value="" placeholder="Email Address *" required>
                            </div>
							<div class="form-group">
                                <span class="adon-icon"><span class="fa fa-phone"></span></span>
                                <input type="text" name="mobile" maxlength=11 value="" placeholder="Mobile No." pattern="01[3-9]{1}[0-9]{8}">
                            </div>
							<div class="form-group">
                                <span class="adon-icon"><span class="fa fa-map"></span></span>
                                <select name='location'><option>Dhaka</option><option>Chittagong</option><option>Rajshahi</option><option>Khulna</option><option>Barishal</option><option>Sylhet</option><option>Rangpur</option><option>Mymensingh</option></select>
                            </div>
                            <div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="pass1" minlength='8' maxlength=20 value="" placeholder="Enter Password *" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                            </div>
							<div class="form-group">
                                <span class="adon-icon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="pass2" minlength='8' maxlength=20 value="" placeholder="Re-Enter Password *" required>
                            </div>
                            <div class="clearfix">
                                <div class="form-group pull-left">
									<input type='submit' name='submitRegister' value='REGISTER HERE' class="theme-btn btn-style-one">
                                </div>
                                <div class="form-group submit-text pull-right">
                                	*** You must be a registered user to submit content
                                </div>
                            </div>
							
							<!-- captcha -->
							
                        </form>
                    </div>
                    
                </div>
                
            </div>
        </div>
    </section>
    <!--End Register Section-->
    
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
<script src="js/jquery-ui.js"></script>
<script src="js/wow.js"></script>
<script src="js/script.js"></script>

</body>
</html>
