<?php
	//Includes
	require "../login/validate_session.php";
	require "../render/page_builder.php";
	require "update_db.php";

	// sets the flags for deletion
	if (isset($_GET['id']) && isset($_GET['delete'])) {
	    $id = $_GET['id'];
	    $delete = $_GET['delete'];
	} else {
	    header("Location: list.php");
	}

	// compiles query and executes the DB update
	$query = build_delete_student_query($id, $delete);
	execute_upcert($query);
	header("Location: list.php");

?>
