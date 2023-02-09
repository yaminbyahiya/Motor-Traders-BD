<?php
include_once('fb-config.php');
if(isset($_SESSION['fbUserId']) and $_SESSION['fbUserId']!=""){
	header('location: https://motortraderbd.com/rashik/welcome.php');
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
	
	<div class="bg-light border-bottom shadow-sm sticky-top">
		
		</div> <!--/.container-->
	
	
	
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
    </div> <!--/.container-->
	
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    
</body>
</html>