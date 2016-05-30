<?php
	require "../login/validate_session.php";
    require "update_db.php";

    $note = $_POST['note'];
    insert_note($note);

    // The str GET parameter is only so that I could see what the completed sql looked like -- Austin
    header("Location: detail.php?id=" . $note['UserId']);
    die();
?>
