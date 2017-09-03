<?php
  include('config.php');
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // pass username into variable
    $myusername = mysqli_real_escape_string($conn, $_POST['inputUsername']);
    // pass username and string into variable
    $myUserImg = ('default.png');
    // pass email into variable
    $myemail = mysqli_real_escape_string($conn, $_POST['inputEmail']);
    // pass password into variable
    $mypassword = mysqli_real_escape_string($conn, $_POST['inputPasswordOne']);

    date_default_timezone_set('Europe/London');
    $date = date('Y-m-d H:i:s', time());

    $userLogin = mysqli_query($conn,
      "INSERT INTO users (dateCreated, username, userImg, password, email) VALUES('$date', '$myusername', '$myUserImg', '$mypassword', '$myemail')");
    $row = mysqli_fetch_array($userLogin, MYSQLI_ASSOC);

    header("location: login.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />

  <script src="assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="assets/js/Chart.js" type="text/javascript"></script>
	<script src="assets/js/map.js" type="text/javascript"></script>
  <script src="https://www.google.com/recaptcha/api.js?onload=loadCaptcha&render=explicit" async defer></script>
	<!--<script src="assets/js/modernizr.custom.js"></script>-->
	
    <!-- TEST --><link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <!-- TEST --><link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

<script type="text/javascript">
  /* var loadCaptcha = function() {
    grecaptcha.render('googleCaptcha', {
      'sitekey': '6Lc6JyQUAAAAADFXg6K77pVsqx8R7N958rhtno1p',
      'theme': 'light',
      'hl': 'en-GB', 
      'callback': alert("YES"),
      'expired-callback': alert("NO")
    });
  };
  function registerBtn() {
    if (grecaptcha.getResponse() == "") {
      alert("Please complete verification!");
    } else {
      alert("YAYAYYAY! :)");
    }
  }; */
</script>

</head>

<body background="assets/img/another.jpg" style="width:100%;height:100%;background-size:cover;border:none;margin:0;padding:0;">

<div class="form-wrapperr" style="height:auto;">
  
  <form method="post" action="">
    <h3>Register Here</h3>

    <div class="form-item">
      <input type="text" id="inputUsername" name="inputUsername" required="required" placeholder="Username" autocomplete="off" autofocus />
    </div>
    
    <div class="form-item">
      <input type="text" id="inputEmail" name="inputEmail" required="required" placeholder="Email Address" autocomplete="off" />
    </div>

    <div class="form-item">
		  <input type="password" id="inputPasswordOne" name="inputPasswordOne" required="required" placeholder="Password" autocomplete="off" />
    </div>

    <div id="googleCaptcha" style="margin-top:10px;"></div>
    
    <div class="button-panel">
		  <input id="registerBtn" onclick="registerBtn" type="submit" class="button" title="Register Here" name="register" value="Register"></input>
    </div>
  </form>

  <div class="reminder">
    <p>Already a member? <a href="login.php">Login now</a></p>
  </div>
</div>

</body>
</html>