<?php
	require "../login/validate_session.php";
	// This is just the code which is called by the form. The sql is processed in update_db.php
    require_once("../includes/config.php");

    $note = $_POST['note'];
    edit_note($note);

    // The str GET parameter is only so that I could see what the completed sql looked like -- Austin
    header("Location: detail.php?id=" . $note['UserId']);
    die();
?>
