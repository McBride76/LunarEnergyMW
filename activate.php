<?php

$page_title = 'Lunar Energy : Activate';
include("includes/head.php");
include("includes/login_functions.inc.php");

// if x and y don't exist, redirect user
if (isset($_GET['x'], $_GET['y'])
	&& filter_var($_GET['x'], FILTER_VALIDATE_EMAIL)
	&& (strlen($_GET['y']) == 32 ) ) {

	// update the database
	require_once('mysqli_connect.php'); 
	$q = "UPDATE users_cred SET active=NULL WHERE 
		(email='" . mysqli_real_escape_string($dbc, $_GET['x']) . "' AND 
		active='" . mysqli_real_escape_string($dbc, $_GET['y']) . "') 
		LIMIT 1";
	$r = mysqli_query($dbc, $q) or die("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));
	
	// print customized message
	if (mysqli_affected_rows($dbc) == 1) {
		echo '<div class="activate-msg-container img-bg-black"><p class="txt-center">Your account is now active and you may <a href="login.php">login</a></p></div>';
	}
	else {
		echo '<div class="activate-msg-container img-bg-black"><p class="error txt-center">Your account could not be activated. Please re-check the link or <a href="">contact</a> the system administrator.</p></div>';
	}
	
	mysqli_close($dbc);
	
}  else { // redirect
	redirect_user();
}  // end of main if 

?>