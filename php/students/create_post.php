<?php
    require "update_db.php";
    $student = $_POST['student'];
    create_student($student);

    header("Location: list.php");
    die();
?>