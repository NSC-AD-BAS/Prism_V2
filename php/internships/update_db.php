<?php
# update_db php file: db write-access layer
# Author: Tim Davis
# Author: Kellan Nealy
include "query_db.php";

# takes in an associative array of all the column values for an internship
# uses INSERT INTO to add to the DB
function add_internship($internship_data) {
	$conn = db_connect();

	# get the max column value for InternshipID so we can correctly add to the table
	$new_id = mysqli_insert_id($conn);

	# generate last updated datetime
	$lastUpdated = date('Y-m-d H:i:s');

	$queryFormat = "insert internships(
		InternshipId,
		PositionTitle,
		Description,
		OrganizationId,
		DatePosted,
		StartDate,
		EndDate,
		SlotsAvailable,
		LastUpdated,
		ExpirationDate)
		values ('%d', '%s', '%s', '%d', '%s', '%s', '%s', '%d', '%s', '%s');";

	$sql = sprintf($queryFormat,
		$new_id,
		$internship_data['PositionTitle'],
		$internship_data['Description'],
		$internship_data['OrganizationId'],
		$internship_data['DatePosted'],
		$internship_data['StartDate'],
		$internship_data['EndDate'],
		$internship_data['SlotsAvailable'],
		$lastUpdated,
		$internship_data['ExpirationDate']);

	echo $sql . " is the query!";

	/*
	# column names in first line of query are unnecessary if we want to take those away
	$sql = "INSERT INTO `internships`
		(`InternshipId`, `PositionTitle`, `Description`, `OrganizationId`, `DatePosted`,
			`StartDate`, `EndDate`, `SlotsAvailable`, `LastUpdated`, `ExpirationDate`)
		VALUES ($internship_data['InternshipId'],$internship_data['PositionTitle'],$internship_data['Description'],
			$internship_data['OrganizationId'],[$internship_data['DatePosted'],$internship_data['StartDate'],
			$internship_data['EndDate'],$internship_data['SlotsAvailable'],$internship_data['LastUpdated'],
			$internship_data['ExpirationDate']);"
	*/

	$result = mysqli_query($conn, $sql);
	if (!$result) {
		echo "INSERT INTO internships table failed";
	}
}

function update_internship($internship_data) {
	# virtually the same code as above but with different query command
}

?>
