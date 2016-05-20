<?php
# confirm_edit php file: updated entry, redirects
# Author: Tim Davis
# Author: Kellan Nealy

include("update_db.php");
include_once("../login/login_utils.php");

# Session management
session_start();
if (!is_logged_in()) {
    to_login();
}

# TODO: clean-up

# Make sure POST parameters have been passed
if (isset($_POST["intId"])) {

    # All the internship data
    $intId = $_POST["intId"];
    $positionTitle = $_POST["PositionTitle"];
    $description = $_POST["Description"];
	$internshipUrl = "";
    $organizationId = $_POST["OrganizationId"];
    $datePosted = $_POST["DatePosted"];
    $startDate = "";
    $endDate = "";
    $location = "";
    $expirationDate = $_POST["ExpirationDate"];

    # These variables are allowed to be blank
    if (isset($_POST["StartDate"])) {
        $startDate = $_POST["StartDate"];
    }
    if (isset($_POST["EndDate"])) {
        $endDate = $_POST["EndDate"];
    }
    if (isset($_POST["Location"])) {
        $location = $_POST["Location"];
    }

    $internship_data = array(
        "PositionTitle" => $positionTitle,
        "Description" => $description,
        "InternshipUrl" => $internshipUrl,
        "OrganizationId" => $organizationId,
        "DatePosted" => $datePosted,
        "StartDate" => $startDate,
        "EndDate" => $endDate,
        "Location" => $location,
        "ExpirationDate" => $expirationDate);

    update_internship($internship_data, $intId);
    header("Location: list.php");
}

?>
