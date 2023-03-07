<?php
session_start();
error_reporting(0);
include("include/config.php");
if (isset($_POST['submit'])) {
	$puname = $_POST['username'];
	$ppwd = md5($_POST['password']);
	$ret = mysqli_query($con, "SELECT * FROM users WHERE email='$puname' and password='$ppwd'");
	$num = mysqli_fetch_array($ret);
	if ($num > 0) {
		$_SESSION['login'] = $_POST['username'];
		$_SESSION['id'] = $num['id'];
		$pid = $num['id'];
		$host = $_SERVER['HTTP_HOST'];
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 1;
		// For stroing log if user login successfull
		$log = mysqli_query($con, "insert into userlog(uid,username,userip,status) values('$pid','$puname','$uip','$status')");
		header("location:dashboard.php");
	} else {
		// For stroing log if user login unsuccessfull
		$_SESSION['login'] = $_POST['username'];
		$uip = $_SERVER['REMOTE_ADDR'];
		$status = 0;
		mysqli_query($con, "insert into userlog(username,userip,status) values('$puname','$uip','$status')");
		$_SESSION['errmsg'] = "Invalid username or password";

		header("location:user-login.php");
	}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<title>User-Login</title>
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
					<h1 class="login-title">Patient Login</h1>
					<form method="post">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="username" id="email" class="form-control" placeholder="email@example.com">
						</div>
						<div class="form-group mb-4">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="enter your passsword">
						</div>
						<span style="color:red;"><?php echo $_SESSION['errmsg']; ?><?php echo $_SESSION['errmsg'] = ""; ?></span>

						<input name="submit" id="login" class="btn btn-block login-btn" type="submit" value="Login">
					</form>
					<a href="forgot-password.php" class="forgot-password-link">Forgot password?</a>
					<p class="login-wrapper-footer-text">Don't have an account? <a href="registration.php" class="text-reset">Register
							here</a></p>
				</div>
			</div>
			<div class="col-sm-6 px-0 d-none d-sm-block">
				<img src="assets/images/patient.avif" alt="login image" class="login-img">

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