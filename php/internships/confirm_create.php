<?php
# confirm_create php file: creates entry, redirects
# Author: Tim Davis
# Author: Kellan Nealy

require "../login/validate_session.php";
include("../db/update_db.php");
include("../db/query_db.php");

# Make sure POST parameters have been passed
if (isset($_POST['PositionTitle'])
    && isset($_POST['OrganizationId']) && isset($_POST['DatePosted'])
    && isset($_POST['StartDate']) && isset($_POST['EndDate'])
    && isset($_POST['ExpirationDate']) && isset($_POST['Description'])) {

	# need to follow up with DB people about how to setup link between org and internship
	$internship_data = array("PositionTitle"=>$_POST['PositionTitle'], "OrganizationId"=>$_POST['OrganizationId'],
		"DatePosted"=>$_POST['DatePosted'], "StartDate"=>$_POST['StartDate'], "EndDate"=>$_POST['EndDate'],
		"ExpirationDate"=>$_POST['ExpirationDate'], "Description"=>$_POST['Description']);

	add_internship($internship_data);
	header("Location: list.php");
}

?>
