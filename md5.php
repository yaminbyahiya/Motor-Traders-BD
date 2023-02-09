<?php
$u = $_REQUEST['u'];
$p = $_REQUEST['p'];
$c = str_rot13($p);
$p2 = md5($p.$c);
echo "$u<br>$p<br>$c<br>$p2";
?>