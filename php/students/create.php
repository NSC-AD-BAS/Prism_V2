<?php
    $student = $_POST['student'];
    echo $student["name"];
    foreach($student as $field => $value) {
        echo $field . ": " . $value . "<br>";
    }
?>
