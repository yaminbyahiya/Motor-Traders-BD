<?php
//index.php

//Include Configuration File
include('gmail-config.php');

$login_button = '';

//This $_GET["code"] variable value received after user has login into their Google Account redirct to PHP script then this variable value has been received
if(isset($_GET["code"]))
{
    //It will Attempt to exchange a code for an valid authentication token.
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    //This condition will check there is any error occur during geting authentication token. If there is no any error occur then it will execute if block of code/
    if(!isset($token['error']))
    {
        //Set the access token used for requests
        $google_client->setAccessToken($token['access_token']);

        //Store "access_token" value in $_SESSION variable for future use.
        $_SESSION['gmAccessToken'] = $token['access_token'];

        //Create Object of Google Service OAuth 2 class
        $google_service = new Google_Service_Oauth2($google_client);

        //Get user profile data from google
        $data = $google_service->userinfo->get();
        //var_dump($data);
		
        $tmpName = "";
		//Below you can find Get profile data and store into $_SESSION variable
        if(!empty($data['given_name']))
        {
            $tmpName = $data['given_name'];
        }

        if(!empty($data['family_name']))
        {
            $tmpName.= $data['family_name'];
        }
		
		$_SESSION['gmUserName'] = $tmpName;

        if(!empty($data['email']))
        {
            $_SESSION['gmUserEmail'] = $data['email'];
        }

        /*
		if(!empty($data['gender']))
        {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if(!empty($data['picture']))
        {
            $_SESSION['user_image'] = $data['picture'];
        }
		*/
    }
}

//This is for check user has login into system by using Google account, if User not login into system then it will execute if block of code and make code for display Login link for Login using Google account.
if(!isset($_SESSION['gmAccessToken']))
{
    //Create a URL to obtain user authorization
    //$login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="../images/login_gmail.png" alt="No Image"/></a>';
	
	$link = "https://accounts.google.com/o/oauth2/auth?response_type=code&access_type=online&client_id=547018059758-t5lrlp2i4207bfk7mmrbpv5ane3j7ab4.apps.googleusercontent.com&redirect_uri=https%3A%2F%2Fmotortraderbd.com%2Frashik%2Fgmail-callback.php&state&scope=email%20profile&approval_prompt=auto";
	header("Location: $link");
	exit;
}

if($login_button == '')
{
	header('Location: ../files/session_social_login.php');
	exit;
}
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>PHP Login using Google Account</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />

</head>
<body>
<div class="container">
    <br />
    <h2 align="center">PHP Login using Google Account</h2>
    <br />
    <div class="panel panel-default">
        <?php
        if($login_button == '')
        {
			echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
            echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
            echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
            echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
            echo '<h3><a href="logout.php">Logout</h3></div>';
        }
        else
        {
            echo '<div align="center">'.$login_button . '</div>';
        }
        ?>
    </div>
</div>
</body>
</html>
