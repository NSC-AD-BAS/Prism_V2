<?php
# update_db php file: db write-access layer
# Author: Tim Davis
# Author: Kellan Nealy

include("query_db.php");

# TODO: do not show internships that are past their expiration date

# Creates an internship give the data
function add_internship($internship_data) {
	$conn = db_connect();

	# get the max column value for InternshipID so we can correctly add to the table
	$new_id = mysqli_insert_id($conn);

	# generate last updated datetime
	$lastUpdated = date('Y-m-d H:i:s');

	$queryFormat = "INSERT internships(
		InternshipId,
		PositionTitle,
		Description,
		OrganizationId,
		DatePosted,
		StartDate,
		EndDate,
		LastUpdated,
		ExpirationDate)
		values ('%d', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s');";

	$sql = sprintf($queryFormat,
		$new_id,
		$internship_data['PositionTitle'],
		$internship_data['Description'],
		$internship_data['OrganizationId'],
		$internship_data['DatePosted'],
		$internship_data['StartDate'],
		$internship_data['EndDate'],
		$lastUpdated,
		$internship_data['ExpirationDate']);

	$result = mysqli_query($conn, $sql);
	if (!$result) {
		echo "INSERT INTO internships table failed";
	}
}

# Updates an internship given the id and replacement data
function update_internship($internship_data, $intId) {
	$conn = db_connect();

	# generate last updated datetime
	$lastUpdated = date('Y-m-d H:i:s');

	$queryFormat = "REPLACE internships(
		InternshipId,
		PositionTitle,
		Description,
		OrganizationId,
		DatePosted,
		StartDate,
		EndDate,
		LastUpdated,
		ExpirationDate)
		values ('%d', '%s', '%s', '%d', '%s', '%s', '%s', '%s', '%s');";

	$sql = sprintf($queryFormat,
		$intId,
		$internship_data['PositionTitle'],
		$internship_data['Description'],
		$internship_data['OrganizationId'],
		$internship_data['DatePosted'],
		$internship_data['StartDate'],
		$internship_data['EndDate'],
		$lastUpdated,
		$internship_data['ExpirationDate']);

	$result = mysqli_query($conn, $sql);
	if (!$result) {
		echo "INSERT INTO internships table failed";
	}
}

# Deletes an internship given the id
function delete_internship($intId) {
	$delete = 1; // 1 = deleted
	delete_undelete_internship($intId, $delete);
}

# Undeletes an internship given the id
function undelete_internship($intId) {
	$delete = 0; // 0 = not deleted
	delete_undelete_internship($intId, $delete);
}

# Helper function for deleting and undeleting an internship
# Deletes or undeletes an internship given the id and delete value
function delete_undelete_internship($intId, $delete_undelete) {
	$conn = db_connect();

	$sql = "UPDATE internships
				SET isDeleted = " . $delete_undelete . "
				WHERE InternshipId = " . $intId;

	$result = mysqli_query($conn, $sql);
	if (!$result) {
		echo "UPDATE internships table failed";
	}
}

?>
