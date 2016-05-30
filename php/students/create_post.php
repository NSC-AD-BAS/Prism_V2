<?php
    require "../login/validate_session.php";
    require_once("../includes/config.php");
    
    $student = $_POST['student'];
    create_student($student);

    header("Location: list.php");
    die();
?>
