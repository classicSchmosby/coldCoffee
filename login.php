<?php
  include('config.php');
  session_start();

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // pass username into variable
    $myusername = mysqli_real_escape_string($conn, $_POST['inputUsername']);
    // pass password into variable
    $mypassword = mysqli_real_escape_string($conn, $_POST['inputPassword']);

    date_default_timezone_set('Europe/London');
    $date = date('Y-m-d H:i:s', time());

    $pswd = $_POST['inputPassword'][0];

    $auditQuery = mysqli_query($conn,
      "INSERT INTO auditUserLogin (FK_Username, password, loginDate) VALUES('$_POST[inputUsername]', '$pswd', '$date')");
    $auditRow = $row = mysqli_fetch_array($auditQuery, MYSQLI_ASSOC);

    $sql = "SELECT userId FROM users WHERE username = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    if ($count == 1) {
      $_SESSION['login_user'] = $myusername;
      header("location: home.php");
    } else {
      // $error = "incorrect details!";
      echo("<script type='text/javascript'>");
        echo("alert('no!');");
        echo("document.getElementById('loginError').style.display='inline';");
      echo("</script>");
    }
  }
?>




<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />

  <script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/Chart.js"></script>
	<script src="assets/js/map.js"></script>
	<!--<script src="assets/js/modernizr.custom.js"></script>-->
	
    <!-- TEST --><link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic' rel='stylesheet' type='text/css'>
    <!-- TEST --><link href='http://fonts.googleapis.com/css?family=Raleway:400,300,700' rel='stylesheet' type='text/css'>

</head>
<body background="assets/img/another.jpg" style="height:100%;width:100%;background-size:cover;border:none;margin:0;padding:0;">
<div class="form-wrapperr" style="height:auto;">
  
  <!-- Uses login.php to process the login. Checks entered details are matching of anything within the email table and password table -->
  <form method="POST">
    <h3>Sign In Here</h3>
	
    <div class="form-item">
		<input style="color:#fff;padding-left:5px;font-size:1.55em;border:1px solid #fff;border-radius:5px;" type="text" id="username" name="inputUsername" required="required" placeholder="Username" autocomplete="off" autofocus />
    
    <div class="form-item">
		<input style="color:#fff;padding-left:5px;font-size:1.55em;border:1px solid #fff;border-radius:5px;" type="password" id="password" name="inputPassword" required="required" placeholder="Password" autocomplete="off" />
    </div>
    
    <div class="button-panel">
		<input type="submit" class="button" title="Register Here" name="register" value="Sign In"></input>
    </div>
  </form>

  <div class="reminder">
    <p>Not a member? <a href="register.php">Sign up now</a></p>
    <p><a href="resetPassword_Send.html">Forgot your password?</a></p>
    <p id="loginError" style="display:none;">These details are incorrect!</p>
  </div>
</div>

</body>
</html>