<?php
# confirm_delete php file: updates entry's isDeleted if necessary, redirects
# Author: Tim Davis
# Author: Kellan Nealy

include "../db/update_db.php";
include_once("../login/login_utils.php");

# Session management
session_start();
if (!is_logged_in()) {
    to_login();
}

# Make sure POST parameters have been passed
if (isset($_POST["intId"])) {
    $intId = $_POST["intId"];

    if (isset($_POST["yes"])) {
        # User said yes to deleting the entry
        delete_internship($intId);
        header("Location: list.php");
    }

    if (isset($_POST["no"])) {
        # User said no to deleting the entry
        # TODO: Go back to where we came from
        header("Location: detail.php?id=" . $intId);
    }
} else {
    header("Location: list.php");
}

?>
