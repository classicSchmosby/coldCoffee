<?php
	define('DB_SERVER', 'localhost:3306');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_DATABASE', 'mycycle');

	$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

	date_default_timezone_set('Europe/London');
	$date = date('Y-m-d H:i:s', time());

	$reviewTitle = ($_POST[reviewTitle]);
	$reviewDesc = ($_POST[reviewDesc]);

	$af = mysqli_query($conn,
		"INSERT INTO rating (ratingTitle, ratingDescription, datePosted) VALUES('$reviewTitle', '$reviewDesc', '$date')");

	header("Location: reviewLocation.php");
?>