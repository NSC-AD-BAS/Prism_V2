<?php
	// require statements
	require 'query_db.php';
    require "../companies/page_builder.php";

    // get data from query to identify the proper record
    $studentId = $_GET["id"];
	$student = get_single_student($studentId);
	$isDeleted = $student[]

	$studentFullName = sprintf("%s %s", $student["Student First Name"], $student["Student Last Name"]);
	

?>