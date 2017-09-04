<!-- <?php
	include('session.php');
	//header("Location: home.php");
	header("refresh:3;url=home.php");
?> -->

<!DOCTYPE html>
<html style="background-color:#fff;">
<head>
	<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
    <link href="assets/css/main.css" rel="stylesheet">

    <script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/Chart.js"></script>
	<script src="assets/js/map.js"></script>
	<title>Redirect</title>
</head>
<body style="background-color:#fff;">

<h2 class="mainText">Welcome, <?php echo($login_session); ?></h2>
<h2 class="mainText">You will be redirected to your profile page shortly.</h2>
<h2 class="mainText">Your profile is being created. Please wait.<span id="wait"></span></h2>

<br />

<div id="redirectLoaderWrapper">
	<img id="redirectLoader" src="assets/img/gears.gif">
</div>

</body>
<script type="text/javascript">
window.dotsGoingUp = true;
var dots = window.setInterval( function() {
	var wait = document.getElementById("wait");
	if ( window.dotsGoingUp ) 
    	wait.innerHTML += ".";
	else {
    	wait.innerHTML = wait.innerHTML.substring(1, wait.innerHTML.length);
    	if ( wait.innerHTML === "")
        	window.dotsGoingUp = true;
	}
	if ( wait.innerHTML.length > 5 )
    	window.dotsGoingUp = false;
}, 300);
</script>
</html>