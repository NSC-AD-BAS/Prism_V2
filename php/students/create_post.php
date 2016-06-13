<?php
    require "../login/validate_session.php";
    require "../db/update_db.php";
    
    $student = $_POST['student'];
    create_student($student);

    header("Location: list.php");
    die();
?>
