<?php
include_once('fb-config.php');
session_destroy();
unset($_SESSION['fbUserId']);
unset($_SESSION['fbUserName']);
unset($_SESSION['fbUserEmail']);
unset($_SESSION['fbAccessToken']);
header('location: https://motortraderbd.com/rashik/');
exit;
?>