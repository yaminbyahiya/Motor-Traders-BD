<?php
include_once('fb-config.php');

if(isset($_SESSION['fbUserId']) and $_SESSION['fbUserId']!="")
{
	header('location: https://motortraderbd.com/profile.php');
	exit;
}

$permissions = array('email'); // Optional permissions
$loginUrl = $helper->getLoginUrl('https://motortraderbd.com/rashik/fb-callback.php', $permissions);
?>

<!doctype html>
<html lang="en-US">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Login with Facebook using PHP SDK</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
	<!--
		<div class="bg-light border-bottom shadow-sm sticky-top">
		</div> <!--/.container- ->
		<div class="container">
			<div class="row">
				<div class="col-sm-12 col-md-4 m-auto">
					<div class="border p-5 mb-5">
						<form method="post">
							<div class="form-group">
								<a href="<?php echo htmlspecialchars($loginUrl); ?>" class="btn btn-primary btn-block"><i class="fab fa-facebook-square"></i> Log in with Facebook!</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div> <!--/.container- ->
	-->
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    
</body>
</html>

<?php 
$link = "https://www.facebook.com/login.php?skip_api_login=1&api_key=456984988962128&kid_directed_site=0&app_id=456984988962128&signed_next=1&next=https%3A%2F%2Fwww.facebook.com%2Fv3.2%2Fdialog%2Foauth%3Fclient_id%3D456984988962128%26state%3D9d5df1bfeda47d75194a0a008e7afdc3%26response_type%3Dcode%26sdk%3Dphp-sdk-5.7.0%26redirect_uri%3Dhttps%253A%252F%252Fmotortraderbd.com%252Frashik%252Ffb-callback.php%26scope%3Demail%26ret%3Dlogin%26fbapp_pres%3D0%26logger_id%3Dd50fa71a-b892-40a9-88db-2a3209c2df61%26tp%3Dunspecified&cancel_url=https%3A%2F%2Fmotortraderbd.com%2Frashik%2Ffb-callback.php%3Ferror%3Daccess_denied%26error_code%3D200%26error_description%3DPermissions%2Berror%26error_reason%3Duser_denied%26state%3D9d5df1bfeda47d75194a0a008e7afdc3%23_%3D_&display=page&locale=en_GB&pl_dbl=0";

die("<script>window.location = '$link';</script>");

//echo "<hr>$loginUrl<hr>".htmlspecialchars($loginUrl);
//die("<script>window.location = '".htmlspecialchars($loginUrl)."';</script>");
?>