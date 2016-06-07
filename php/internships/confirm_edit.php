<?php
# confirm_edit php file: updated entry, redirects
# Author: Tim Davis
# Author: Kellan Nealy

require "../login/validate_session.php";
include("../db/update_db.php");
include("../db/query_db.php");

# Make sure POST parameters have been passed
if (isset($_POST["intId"])) {

    $now = date('Y-m-d');
    $exp = date('Y-m-d', strtotime("+12 weeks"));

    # All the internship data
    $intId = $_POST["intId"];
    $positionTitle = $_POST["PositionTitle"];
    $description = $_POST["Description"];
	$internshipUrl = "";
    $organizationId = $_POST["OrganizationId"];
    $datePosted = $_POST["DatePosted"];
    $startDate = !empty($_POST["StartDate"]) ? $_POST["StartDate"] : $now;
    $endDate = !empty($_POST["StartDate"]) ? $_POST["StartDate"] : $exp;
    $expirationDate = $_POST["ExpirationDate"];

    $internship_data = array(
        "PositionTitle" => $positionTitle,
        "Description" => $description,
        "InternshipUrl" => $internshipUrl,
        "OrganizationId" => $organizationId,
        "DatePosted" => $datePosted,
        "StartDate" => $startDate,
        "EndDate" => $endDate,
        "ExpirationDate" => $expirationDate);

    update_internship($internship_data, $intId);
    header("Location: list.php");
}

?>
