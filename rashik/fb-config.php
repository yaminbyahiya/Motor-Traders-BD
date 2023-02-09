<?php
include_once('php-graph-sdk-5.x/src/Facebook/autoload.php');
if (!session_id()) {
    session_start();
}
$fb = new Facebook\Facebook(array(
	'app_id' => '456984988962128', // Replace with your app id
	'app_secret' => '574968ebcc4f81a14de6081cf9ded1b8',  // Replace with your app secret
	'default_graph_version' => 'v3.2',
));

$helper = $fb->getRedirectLoginHelper();
$_SESSION['FBRLH_state']=$_GET['state'];
?>