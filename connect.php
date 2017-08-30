<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create the connection
$conn = new mysqli_connect($servername, $username, $password);
// Check the connection
if($conn->connect_error) {
	die("Connection Failed " . $conn->connect_error);
}
else {
echo "<script>";
echo "window.location.href = 'myAccount.html';";
echo "</script>";
}
?>

----- OR -----

<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create the connection
$conn = new mysqli_connect($servername, $username, $password);

// Check the connection
if($conn->connect_error) {
	die("Connection Failed " . $conn->connect_error);
}
else {
	// Create variables for email and password through using input id's.
	$username = mysql_real_escape_string($_POST['username']);
	$pass = mysql_real_escape_string($_POST['password']);

	// Check the table for inputted email and password.
	$query = "SELECT username, password FROM users WHERE username = "' . $username . '" AND password = "' . $pass . '"";
	$result = mysql_query($query);

	// Check if the user exists in the table.
	if (mysql_num_rows($result) == 1 ) {
		echo "<script>";
		echo "window.location.href = 'myAccount.html';";
		echo "</script>";

		// If true, store this username within the session - for later use.
		session_start();
		$_SESSION['username'] = $username;
		echo "Hello, " . $username;
	}
	else {
		echo ("No such account exists!");
	}
	$loginCount = "INSERT INTO account(loginCount)";
	$loginCount .= " VALUES (1)";
}
?>