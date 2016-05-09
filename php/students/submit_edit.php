<?php
    require "update_db.php";
    $student = $_POST['student'];
    edit_student($student);

    header("Location: list.php");
    die();
?>
