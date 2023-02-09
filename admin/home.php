<?php session_start();
if(isset($_SESSION['mta-user']) && isset($_SESSION['mta-pass'])) { $u = $_SESSION['mta-user']; }
else { echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=index.php\">"; die(); }
?>

<html>
<head>
<?php require_once('head.php'); ?>
</head>

<body>
<?php
//$pg = $_REQUEST['pg'];
require_once('menu.php');
?>
</body>

</html>
