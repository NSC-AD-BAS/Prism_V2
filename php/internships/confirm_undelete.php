<?php
# confirm_undelete php file: updates entry's isDeleted if necessary, redirects
# Author: Tim Davis
# Author: Kellan Nealy

require "../login/validate_session.php";
require_once("../includes/config.php");

# Make sure POST parameters have been passed
if (isset($_POST["intId"])) {
    $intId = $_POST["intId"];

    if (isset($_POST["yes"])) {
        # User said yes to undeleting the entry
        undelete_internship($intId);
        header("Location: detail.php?id=" . $intId);
    }

    if (isset($_POST["no"])) {
        # User said no to undeleting the entry
        # TODO: Go back to where we came from (deleted interships list ?)
        header("Location: list.php");
    }
} else {
    header("Location: list.php");
}

?>
