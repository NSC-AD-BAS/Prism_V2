<?php
	// require statements
	require "../login/validate_session.php";
	require 'query_db.php';
    require "../render/page_builder.php";

    // get data from query to identify the proper record
    $studentId = $_GET["id"];
	$student = get_single_student($studentId);
	$isDeleted = $student["isDeleted"];

	$studentFullName = sprintf("%s %s", $student["Student First Name"], $student["Student Last Name"]);
	
	//Toggle Delete button text
	if ($isDeleted) {
	    $text = "Restore";
	    $delete = 0;
	} else {
	    $text = "Delete";
	    $delete = 1;
	}

	//Render the page
	render_header($studentFullName, false);
	render_nav($studentFullName);

	$out = '
	    <p class="alert">Are you sure you want to ' . $text . ' ' . $studentFullName . '?</p>
	    <hr>
	    <a class="button" href="delete.php?id=' . $studentId . '&delete=' . $delete . '"><div>Yes, ' . $text . '</div></a>
	    <a class="button" href="detail.php?id=' . $studentId . '"><div>No</div></a>
	';

	echo $out;

	render_footer();
?>
