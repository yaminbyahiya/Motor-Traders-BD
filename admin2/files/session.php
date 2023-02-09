<?php
//already logged in, session found
if(isset($_SESSION['mta-user']) && isset($_SESSION['mta-pass']) && isset($_SESSION['mta-ts']))
{
	if($ts - $_SESSION['mta-ts']<600)
	{
		$u = $_SESSION['mta-user'];
		$_SESSION['mta-ts'] = $ts;
	}
	else { die("<script>window.location='logout.php';</script>"); }
}
else { die("<script>window.location='logout.php';</script>"); }
