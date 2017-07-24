<?php 
// Create the session, if not done so already.
// If creating more than one session, use session_id() or session_name().
session_start();

// Destroy all session variables.
$_SESSION = array();

// ini_get = get values of config option.
// Destroy session and session cookie.
if (ini_get("session.use_cookies")) {
	$params = session_get_cookie_params();
	setcookie(session_name(), '', time() - 42000, 
		$params["path"], $params["domain"],
		$params["secure"], $params["httponly"]
	);
}

// And finally, destroy the session.
session_destroy();
header('Location: login.html');
?>