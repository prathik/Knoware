<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
	<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
		<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
			<!--[if gt IE 8]><!--> <html class="no-js" ng-app> <!--<![endif]-->
				<head>
					<meta charset="utf-8">
					<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
					<title>KnoWare - Online Knowledge Storage And Verification Tool</title>
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
				<body ng-controller="KnoWareController">
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
									<ul class="nav">
										<li class="active"><a href="#">Home</a></li>
										<li><a href="#about">About</a></li>
										<li><a href="#contact">Contact</a></li>
										<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
										<ul class="dropdown-menu">
											<li><a href="#">Action</a></li>
											<li><a href="#">Another action</a></li>
											<li><a href="#">Something else here</a></li>
											<li class="divider"></li>
											<li class="nav-header">Nav header</li>
											<li><a href="#">Separated link</a></li>
											<li><a href="#">One more separated link</a></li>
										</ul>
										</li>
									</ul>
								</div><!--/.nav-collapse -->
								<div class="span2 pull-right">
									<p class = "navbar-text">Hello {{user.name}}</p>
								</div>
							</div>
						</div>
					</div>

					<div class="container">

						<div class="row">
							<div class="span6">
								<h2>Learn From Your Mistakes</h2>
								<p>The philosophy behind <strong>KnoWare</strong> is that we need to learn from our mistakes.</p>
								<p><strong>KnoWare</strong> allows you to add thoughts or ideas, keep them in a review state for a period of time and them approve or reject it.</p>
								<p>In the review period you test your idea and at the end of the review period <strong>KnoWare</strong> will alert you that you have to update the status. You can then approve it or reject it.</p>
								<p>A rejected/approved thesis can be put back into review state too!</p>		
							</div>
							<div class="span6">
								<h2>Sign Up!</h2>
								<form>
									<fieldset>
										<legend>Enter your details</legend>
										<label>Username</label>
										<input type = "text" class = "input-xlarge" name= "name" placeholder="Username" />
										<label>Email Id</label>
										<input type = "text" class = "input-xlarge" name = "email" placeholder = "Email" />
										<span class = "help-block">Alerts will be sent to this email id.</span>

										<button class = "btn btn-primary">Sign Up!</button>
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
						<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular.min.js"></script>
						<script src="js/main.js"></script>
					</body>
				</html>