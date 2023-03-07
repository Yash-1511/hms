<?php
session_start();
error_reporting(0);
include("include/config.php");
if (isset($_POST['submit'])) {
	$uname = $_POST['username'];
	$upassword = $_POST['password'];

	$ret = mysqli_query($con, "SELECT * FROM admin WHERE username='$uname' and password='$upassword'");
	$num = mysqli_fetch_array($ret);
	if ($num > 0) {
		$_SESSION['login'] = $_POST['username'];
		$_SESSION['id'] = $num['id'];
		header("location:dashboard.php");
	} else {
		$_SESSION['errmsg'] = "Invalid username or password";
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin-Login</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
	<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
	<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
	<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
	<link rel="stylesheet" href="assets/css/styles.css">
	<link rel="stylesheet" href="assets/css/plugins.css">
	<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	<style>
        body {
            font-family: 'Lexend';
            box-sizing: border-box;
            overflow: hidden;
            background-color: #fff;
            min-height: 100vh;
        }

        .brand-wrapper {
            width: 300px;
            padding-top: 7px;
            padding-bottom: 8px;
        }

        .brand-wrapper .logo {
            height: 40px;
        }

        .login-section-wrapper {
            display: -webkit-box;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            flex-direction: column;
            padding: 68px 100px;
            background-color: #fff;
        }

        @media (max-width: 991px) {
            .login-section-wrapper {
                padding-left: 50px;
                padding-right: 50px;
            }
        }

        @media (max-width: 575px) {
            .login-section-wrapper {
                padding-top: 20px;
                padding-bottom: 20px;
                min-height: 100vh;
            }
        }

        .login-wrapper {
            width: 300px;
            max-width: 100%;
            padding-top: 24px;
            padding-bottom: 24px;
        }

        @media (max-width: 575px) {
            .login-wrapper {
                width: 100%;
            }
        }

        .login-wrapper label {
            font-size: 14px;
            font-weight: bold;
            color: #b0adad;
        }

        .login-wrapper .form-control {
            border: none;
            border-bottom: 1px solid #e7e7e7;
            border-radius: 0;
            padding: 9px 5px;
            min-height: 40px;
            font-size: 18px;
            font-weight: normal;
            margin-bottom: 20px;
        }

        .login-wrapper .form-control::-webkit-input-placeholder {
            color: #b0adad;
        }

        .login-wrapper .form-control::-moz-placeholder {
            color: #b0adad;
        }

        .login-wrapper .form-control:-ms-input-placeholder {
            color: #b0adad;
        }

        .login-wrapper .form-control::-ms-input-placeholder {
            color: #b0adad;
        }

        .login-wrapper .form-control::placeholder {
            color: #b0adad;
        }

        .login-wrapper .login-btn {
            padding: 13px 25px;
            width: 100%;
            background-color: rgb(99 102 241);
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            color: #fff;
            box-shadow: none;
            margin-bottom: 14px;
            display: inline-block;
        }

        .login-wrapper .login-btn:hover {
            border: 1px solid #fdbb28;
            background-color: #fff;
            color: #fdbb28;
        }

        .login-wrapper a.forgot-password-link {
            color: #080808;
            font-size: 14px;
            text-decoration: underline;
            display: inline-block;
            margin-bottom: 54px;
        }

        @media (max-width: 575px) {
            .login-wrapper a.forgot-password-link {
                margin-bottom: 16px;
            }
        }

        .login-wrapper-footer-text {
            font-size: 16px;
            color: #000;
            margin-bottom: 0;
        }

        .login-title {
            font-size: 30px;
            color: #000;
            margin-bottom: 25px;
        }

        .login-img {
            width: 100%;
            height: 100vh;
            -o-object-fit: cover;
            object-fit: cover;
            -o-object-position: left;
            object-position: left;
        }

        .footer-link {
            position: absolute;
            bottom: 1rem;
            text-align: center;
            width: 100%;
        }

    </style>
</head>

<body class="login">
<div class="container-fluid">
        <div class="row">
            <div class="col-sm-6 login-section-wrapper">
                <div class="brand-wrapper">
                    <img src="assets/images/logo1.png" alt="logo" class="logo">
                    
                </div>
                <div class="login-wrapper my-auto">
                    <h1 class="login-title">Admin Login</h1>
                    <form method="post">
                        <div class="form-group">
                            <label for="email">Username</label>
                            <input type="text" name="username" id="email" class="form-control"
                                placeholder="johndoe1112">
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="enter your passsword">
                        </div>
						<span style="color:red;"><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg'] = ""); ?></span>
                        <input name="submit" id="login" class="btn btn-block login-btn" type="submit" value="Login">
						<a href="../../index.php">Bacto Home Page</a>
                    </form>
                </div>
            </div>
            <div class="col-sm-6 px-0 d-none d-sm-block">
                <img src="assets/images/admin.avif" alt="login image" class="login-img">

            </div>
        </div>
    </div>
	
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/modernizr/modernizr.js"></script>
	<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="vendor/switchery/switchery.min.js"></script>
	<script src="vendor/jquery-validation/jquery.validate.min.js"></script>

	<script src="assets/js/main.js"></script>

	<script src="assets/js/login.js"></script>
	<script>
		jQuery(document).ready(function() {
			Main.init();
			Login.init();
		});
	</script>

</body>
<!-- end: BODY -->

</html>