<?php
	// This is just the code which is called by the form. The sql is processed in update_db.php
    require "../login/validate_session.php";
    require "../db/update_db.php";
    
    $student = $_POST['student'];
    edit_student($student);


    header("Location: detail.php?id=" . $student['id']);
    die();
?>
