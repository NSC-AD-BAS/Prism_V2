<?php
	// This is just the code which is called by the form. The sql is processed in update_db.php
    require "update_db.php";
    $student = $_POST['student'];
    $sql = edit_student($student);

    // The str GET parameter is only so that I could see what the completed sql looked like -- Austin
    header("Location: list.php?str=" . substr($sql,0, 20));
    die();
?>