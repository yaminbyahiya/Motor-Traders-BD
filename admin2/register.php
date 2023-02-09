<?php
require_once("files/common_top.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php require_once("files/head.php"); ?>
	<title>Register - BackOffice</title>
</head>

<body class="signup-page">
    <div class="signup-box">
        <?php require_once("files/logo_title_dev.php"); ?>
		
        <div class="card">
            <div class="body">
                <form id="sign_up" method="POST">
                    <div class="msg">Register a new user</div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">person</i></span>
                        <div class="form-line"><input type="text" class="form-control" name="namesurname" placeholder="Name" maxlength="50" required autofocus></div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">email</i></span>
                        <div class="form-line"><input type="email" class="form-control" name="email" placeholder="Email Address" maxlength="50" required></div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">lock</i></span>
                        <div class="form-line"><input type="password" class="form-control" name="password" minlength="6" maxlength="20" placeholder="Password" required></div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="material-icons">lock</i></span>
                        <div class="form-line"><input type="password" class="form-control" name="confirm" minlength="6" maxlength="20" placeholder="Confirm Password" required></div>
                    </div>
                    <!--
					<div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">I read and agree to the <a href="javascript:void(0);">terms of usage</a>.</label>
                    </div>
					-->
                    <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">SIGN UP</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="index.php">Click here to LOGIN</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="../../plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/examples/sign-up.js"></script>
</body>

</html>