<?php 
	// Create variables for email and password through using input id's.
	$username = mysql_real_escape_string($_POST['username']);
	$pass = mysql_real_escape_string($_POST['password']);

	// Check the table for inputted email and password.
	$query = "SELECT username, password FROM users WHERE username = "' . $username . '" AND password = "' . $pass . '"";
	$result = mysql_query($query);

	// Check if the user exists in the table.
	if (mysql_num_rows($result) == 1 ) {
		echo ("Success!");

		// If true, store this username within the session - for later use.
		session_start();
		$_SESSION['username'] = $username;
	}
	else {
		echo ("Failure!");
	}
?>