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
								<a class="brand" href="#">KnoWare</a>
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
							<div class="span6">
								<h1>Learn From Your Mistakes</h1>
								<p>The philosophy behind <strong>KnoWare</strong> is that we need to learn from our mistakes.</p>
								<p><strong>KnoWare</strong> allows you to add thoughts or ideas, keep them in a review state for a period of time and them approve or reject it.</p>
								<p>In the review period you test your idea and at the end of the review period <strong>KnoWare</strong> will alert you that you have to update the status. You can then approve it or reject it.</p>
								<p>A rejected/approved thesis can be put back into review state too.</p>		
							</div>
							<div class="span6">
								<form action = "login.php" method = "POST">
									<fieldset>
										<legend>Sign Up!</legend>
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
