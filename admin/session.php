<?php
if(isset($_SESSION['mta-user']) && isset($_SESSION['mta-pass'])) { $u = $_SESSION['mta-user']; }
else { echo "<meta HTTP-EQUIV=\"REFRESH\" content=\"0; url=index.php\">"; die(); }

date_default_timezone_set('Asia/Dhaka');
?>
