<?php
	require "../students/update_db.php";
	require_once("../login/login_utils.php");

	# Session management
	session_start();
	if (!is_logged_in()) {
	    to_login();
	}

	$userData = $_POST["user"];
	// Different update queries are called depending on the user type
	if ($_SESSION["user_type"] == "Student") {	
		update_student_profile($userData);
	}
	else {
		update_user_profile($userData);
	}
	header("Location: detail.php");
	die();
?>