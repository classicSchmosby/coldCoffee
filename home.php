<?php
	include('session.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>

  	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/loginPanel.css" type="text/css">

    <script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/Chart.js"></script>
	<script src="assets/js/map.js"></script>
	<!--<script src="assets/js/modernizr.custom.js"></script>-->
	
    <!-- TEST --><link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <!-- TEST --><link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

    <title>MyCycle</title>
    </head>
    <body>

	<!-- Menu -->
	<nav class="menu" id="theMenu">
		<div class="menu-wrap">
			<h1 class="logo"><a href="#">Menu</a></h1>
			<h2><a href="index.html" class="smoothScroll">Home</a></h2>

			<h2 onclick="userItem_list()"><a id="userListItem" href="#"><?php echo($login_session); ?></a></h2>
			<!-- <i class="icon-remove menu-close"></i> -->
			<a id="userItem_login" href="login.html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;Login<br /></a>
			<a id="userItem_logout" href="logout.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;Logout<br /></a>
			<a id="userItem_register" href="register.html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;Register<br /></a>
			<a id="userItem_account" href="myAccount.html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;My Account<br /></a>
			<a id="userItem_passw" href="resetPassword_Send">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;Reset Password<br /></a>

			<a href="map.html" class="smoothScroll">Map</a>
			<a href="#services" class="smoothScroll">Services</a>
			<a href="#portfolio" class="smoothScroll">Portfolio</a>
			<a href="#about" class="smoothScroll">About</a>
			<a href="blog.html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;Blog</a>
			<a href="faq.html">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&gt;&nbsp;FAQ</a>
			<a href="contact.html" class="smoothScroll">Contact</a>
			<br />
			<a href="https://www.facebook.com/" style="color:#428BCA;"><i class="icon-facebook"></i></a>
			<a href="https://twitter.com/" style="color:#428BCA;"><i class="icon-twitter"></i></a>
			<a href="www.google.com" style="color:#428BCA;"><i class="icon-dribbble"></i></a>
			<a href="https://mail.google.com/mail/u/0/?tab=wm#inbox" style="color:#428BCA;"><i class="icon-envelope"></i></a>
		</div>
		<!-- Menu button -->
		<div id="menuToggle"><i id="menuToggleBtn" class="glyphicon glyphicon-align-right"></i></div>
	</nav>
	
	<!-- ========== HEADER SECTION ========== -->
	<section id="home" name="home"></section>
	<div id="headerwrap">
		<div class="container">
			<br />
			<div class="row">
				<br />
				<br />
				<br />
				<div class="col-lg-6 col-lg-offset-3">
				</div>
			</div>
		</div><!-- /container -->
	</div><!-- /headerwrap -->
	
	
	<!-- ========== WHITE SECTION ========== -->
	<div id="w">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
				<h3>WELCOME TO MyCycle. A FREE EASY TO USE ROUTE TRACKER. CRAFTED WITH LOVE BY LEE AND RYAN. <br/>
				<bold>IDEAL FOR ENTHUSIASTS AND AMATEURS ALIKE.</bold>
				</h3>
				</div>
			</div>
		</div><!-- /container -->
	</div><!-- /w -->
	
	<!-- ========== SERVICES - GREY SECTION ========== -->
	<section id="services" name="services"></section>
	<div id="g">
		<div class="container">
			<div class="row">
				<h3>OUR SERVICES</h3>
				<br>
				<br>
				<div class="col-lg-4">
					<img src="iconWork/ready-icon.png" class="stepsIcons" />
					<h4>READY</h4>
					<p style="color:#428BCA">Use our clean and easy interface to setup your profile to work out how far you need to ride to achieve your goals. be that fitness orientated, to make more friends or even just to enjoy the activity!</p>
				</div>
				<div class="col-lg-4">
					<img src="iconWork/set-icon.png" class="stepsIcons" />
					<h4>SET</h4>
					<p style="color:#428BCA">Use our easy to use map to calculate a route and set way points and checkpoints to keep track of where you are.</p>
				</div>
				<div class="col-lg-4">
					<img src="iconWork/go-icon.png" class="stepsIcons" />
					<h4>GO</h4>
					<p style="color:#428BCA">You're on your way! Now your route has been calculated, go out and enjoy yourself!</p>
				</div>
				<div class="col-lg-4">
					<img src="iconWork/rest-icon.png" class="stepsIcons" />
					<h4>REST</h4>
					<p style="color:#428BCA">Take advantage of our interactive maps system to find cafes and restaurants around your cycle route for you to stop and take a break.</p>
				</div>
			</div>
		</div><!-- /container -->
	</div><!-- /g -->
	
	
		</div><!-- /container -->
	</div><!-- /dg -->
	
	<section id="portfolio" name="portfolio"></section>
	<div id="portfoliowrap">
		<div class="container">
			<div class="row"><a href="map.html">
				
				<br>
				<br>
				<p id="maptitle"><b>CLICK HERE TO START</b></p>
				<p id="maptitle"><b>NAVIGATING WITH OUR MAP.</b></p>

			</div></a>
		</div><!-- /container -->
	</div><!-- /portfoliowrap -->
	
	<!-- ========== WHITE SECTION ========== -->
	<div id="w">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-lg-offset-2">
				<h3>WE WORK HARD TO DELIVER A <strong>HIGH QUALITY SERVICE</strong>. OUR AIM IS YOUR COMPLETE <strong>SATISFACTION.</strong>
				</h3>
				</div>
			</div>
		</div><!-- /container -->
	</div><!-- /w -->
	
	<!-- ========== ABOUT - GREY SECTION ========== -->
	<section id="about" name="about"></section>
	<div id="g" align="center">
		<div class="container" align="center">
			<div class="row" align="center">
				<h3>ABOUT US</h3>
				<div class="col-lg-2"></div>
				<div class="col-lg-8">
				<p>Two guys from the Watton area. We both love developing our code and making the best products as possible.</p>
				<p>Check out the <a href="blog.html" class="whiteTextLinks"><u>blog</u></a> of how this project started, and how it developed.</p>
				</div>
				<div class="col-lg-3" align="center" vertical-align="center"></div>
				<div class="col-lg-3 team" align="center" vertical-align="center">
					<img class="img-circle" src="assets/img/user.png" height="90" width="90" vertical align="center" />
					<h4 class="userClass"><a href="#" class="whiteTextLinks">Lee Grix</a></h4>
					<h5 class="userDesc">Owner, Founder, CEO, CFO, CIO, Senior Programmer, Senior Designer, Project Manager, Born Leader.</h5>
					<p><i>"I wonna be the very best, like no one ever was!"</i></p>
					<p>
						<a class="whiteTextLinks" href="https://www.linkedin.com/feed/" title="LinkedIn"><i class="icon-linkedin-sign"></i></a>
						<a class="whiteTextLinks" href="index.html" title="Email"><i class="icon-envelope"></i></a>
					</p>
				</div>

				<div class="col-lg-3" align="center" vertical-align="center"></div>
				<div class="col-lg-3 team" align="center" vertical-align="center">
					<img class="img-circle" src="assets/img/patrick.png" height="90" width="90" />
					<h4 class="userClass"><a href="#" class="whiteTextLinks">Ryan Easter</a></h4>
					<h5 class="userDesc">Janitor.</h5>
					<p><i>"Is mayonnaise an instrument?"</i></p>
					<p>
						<a class="whiteTextLinks" href="https://www.linkedin.com/feed/" title="LinkedIn"><i class="icon-linkedin-sign"></i></a>
						<a class="whiteTextLinks" href="index.html" title="Email"><i class="icon-envelope"></i></a>
					</p>
				</div>
			</div>
		</div><!-- /container -->
	</div><!-- /g -->
	</div><!-- /f -->
	
	<div id="c">
		<div class="container">
			<p>Created by <a href="#" class="whiteTextLinks">Lee Grix</a> And <a href="#" class="whiteTextLinks">Ryan Easter</a> - Powered by <a href="http://getbootstrap.com/" class="whiteTextLinks">Bootstrap.</a></p>
		</div>
	</div>
	
	<script src="assets/js/classie.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/smoothscroll.js"></script>
	<script src="assets/js/main.js"></script>
	<script type="text/javascript">
        window.scrollTo = function (x, y) {
            return true;
        }
    </script>
</body>
<div class="se-pre-con"></div>
<script type="text/javascript">
	$(document).ready(function() {
		$('#userDrop').click(function() {
			$('#userItem_login, #userItem_logout, #userItem_register, #userItem_account, #userItem_passw').toggle();
		});
	});
</script>
</html>