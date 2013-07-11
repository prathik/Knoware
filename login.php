<?php
require("class/knoware-load.php");
$user = new UserState();
if( isset( $_POST['login'] ) && $_POST['login'] == 'login' ) {
	$var = $user->sign_in_user( $_POST['username'], $_POST['password']);
	if( $var ) {
		header("Location: ./");
	} else {
		//echo "Invalid username or password";
		//echo "<br />Sorry about the design of this page - its being built.";
		$showMessage = 1;
	}
}

if( isset($_GET['action']) && $_GET['action'] == 'logout' ) {
	if( $user->sign_out_user() ) {
		header("Location: ./");
	} 
}

if( isset( $_POST['register'] ) && $_POST['register'] == "register" ) {
	if( $user->register_user( $_POST['username'], $_POST['email'], $_POST['password'], $_POST['fullname'] ) ) {
		//echo "You have been successfully registerd.";
		//echo "<br />Page under construction.";
		$showMessage = 2;
	} else {
		$showMessage = 3;
	}
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
	<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
		<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
			<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
					<title>KnoWare</title>
					<meta name="description" content="">
					<meta name="viewport" content="width=device-width">

					<link rel="stylesheet" href="css/bootstrap.min.css">
					<style>
						body {
							padding-top: 60px;
							padding-bottom: 40px;
						}
					</style>
					<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
					<link rel="stylesheet" href="css/main.css">

					<script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
				</head>
				<body>
					<!--[if lt IE 7]>
					<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
					<![endif]-->

					<!-- This code is taken from http://twitter.github.com/bootstrap/examples/hero.html -->

					<div class="navbar navbar-inverse navbar-fixed-top">
						<div class="navbar-inner">
							<div class="container">
								<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</a>
								<a class="brand" href="./">KnoWare</a>
								<div class="nav-collapse collapse">
									<form method = "POST" action = "login.php" class="navbar-form pull-right">
										<input name = "username" class="span2" type="text" placeholder="Username">
										<input name =  "password" class="span2" type="password" placeholder="Password">
										<input name = "login" type = "hidden" value = "login" />
										<button type="submit" class="btn btn-primary">Login</button>
									</form>
								</div><!--/.nav-collapse -->
							</div>
						</div>
					</div>

					<div class="container">

						<div class="row">
							<div class = "span4"></div>
							<div class="span4">
								<?php if($showMessage == 3) { ?>
								<form action = "login.php" method = "POST">
									<fieldset>
										<legend>Sign Up!</legend>

										<p class = "text-error">Username or email ID has already been used.</p>
										<label>Full Name</label>
										<input type = "text" class= "input-xlarge" name = "fullname" placeholder = "Full Name" />
										<label>Username</label>
										<input type = "text" class = "input-xlarge" name= "username" placeholder="Username" />
										<label>Email Id</label>
										<input type = "text" class = "input-xlarge" name = "email" placeholder = "Email" />
										<span class = "help-block">Alerts will be sent to this email id.</span>	
										<label>Password</label>
										<input type = "password" class = "input-xlarge" name = "password" /> <br />
										<input type = "hidden" name = "register" value = "register" />
										<button type = "submit" class = "btn btn-primary">Sign Up!</button>
									</fieldset>
								</form>
								<?php } else if($showMessage == 1) {?>
								<form action = "login.php" method = "POST">
									<fieldset>
										<legend>Login</legend>
										<p class = "text-error">Invalid username or password.</p>
										<label>Username</label>
										<input type = "text" class = "input-xlarge" name = "username" placeholder = "Username" />
										<label>Password</label>
										<input type = "password" class = "input-xlarge" name= "password" placeholder = "Password" />
										<input type = "hidden" name = "login" value = "login" />
										<br />
										<button type = "submit" class = "btn btn-primary">Login</button>
									</fieldset>
								</form>
								<?php } else if($showMessage ==2) { ?>
								<h3>Success!</h3>
								<p class = "text-success">You have been successfully registerd. Please login to start using KnoWare.</p>
								<?php } ?>

							</div>
							<div class="span4">
							</div>
						</div>

						<hr>

						<div class = "row">
							<div class = "span12 text-center">
								<p>KnoWare by Prathik Raj</p>
							</div>
						</div>

					</div> <!-- /container -->

					<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
					<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>

						<script src="js/vendor/bootstrap.min.js"></script>

						<script src="js/login.js"></script>
					</body>
				</html>
