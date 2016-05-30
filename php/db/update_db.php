<?php

/*
    update_db.php - Runs update queries against database.
    includes: none
    included by: Any page that creates, edits or deletes records in the DB
    TODO: SECURITY - Move all DB write functions outside of webroot to prevent direct access
*/

/*
    Organization Specific DB Queries
*/

//Create a company and return the orgId
function create_company($query)
{
    $conn = db_connect();
    mysqli_query($conn, $query);
    $orgId = mysqli_insert_id($conn);
    return $orgId;
}

//Update the DB with the given query
function update_db($query)
{
    $conn = db_connect();
    $result = true;
    if (!mysqli_query($conn, $query)) {
        $result = get_last_error($conn);
    }
    mysqli_close($conn);
    return $result;
}

//Create an internship at company create time.  FIXME: This shouldn't be necessary when we get the view updated
function create_internship_for_company($query)
{
    return update_db($query);
}

//Nicely named stub.
function update_company($query)
{
    return update_db($query);
}

/*
    Internship Specific DB Queries
*/

// TODO: do not show internships that are past their expiration date
// Creates an internship given the data
function add_internship($internship_data)
{
    $conn = db_connect();

    // get the max column value for InternshipID so we can correctly add to the table
    $new_id = mysqli_insert_id($conn);

    // generate last updated datetime
    $lastUpdated = date('Y-m-d H:i:s');

    //TODO: Move to query_builder.
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

    //TODO: return the result to calling script and pass error to error page.
    if (!$result) {
        echo "INSERT INTO internships table failed";
    }
}

// Updates an internship given the id and replacement data
function update_internship($internship_data, $intId)
{
    $conn = db_connect();

    // generate last updated datetime
    $lastUpdated = date('Y-m-d H:i:s');

    //TODO: Move to query_builder.
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

    //TODO: return the result to calling script and pass error to error page.
    if (!$result) {
        echo $result;
        echo "INSERT INTO internships table failed";
    }
}

// Deletes an internship given the id
function delete_internship($intId)
{
    $delete = 1; // 1 = deleted
    delete_undelete_internship($intId, $delete);
}

// Undeletes an internship given the id
function undelete_internship($intId)
{
    $delete = 0; // 0 = not deleted
    delete_undelete_internship($intId, $delete);
}

// Helper function for deleting and undeleting an internship
// Deletes or undeletes an internship given the id and delete value
function delete_undelete_internship($intId, $delete_undelete)
{
    //NOTE: I have no idea why this include is required here but I couldn't get delete to work without it.
    //TODO: We should figure out what gives and remove this.  Maybe the nested call from delete/undelete?
    include("../db/query_db.php");
    $conn = db_connect();

    $sql = "UPDATE internships
				SET isDeleted = " . $delete_undelete . "
				WHERE InternshipId = " . $intId;

    $result = mysqli_query($conn, $sql);

    //TODO: return the result to calling script and pass error to error page.
    if (!$result) {
        echo "UPDATE internships table failed";
    }
}

// Updates the given contact to the new values and logs the changes
// Returns if it worked or not.
function updateContact($ContactId, $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
                       $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL)
{
    $Hiring = intval(boolval($Hiring));
    $OnADAdvisoryCommittee = intval(boolval($OnADAdvisoryCommittee));
    $conn = db_connect();
    $stmt = $conn->prepare("UPDATE organization_contacts SET
      ContactFirstName = ?, ContactLastName = ? , Title = ? , OfficeNumber = ? , OfficeExtension = ? , CellNumber = ? ,
      EmailAddress = ? , Referral = ? , Hiring = ? , OnADAdvisoryCommittee = ? , LinkedInURL = ? WHERE ContactId = ? ");
    $stmt->bind_param("ssssssssiisi", $ContactFirstName, $ContactLastName, $Title, $OfficeNumber, $OfficeExtension,
        $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL, $ContactId);

    if (!$stmt->execute()) {
        $message = "Failed contact update action";
        $userid = 1;
        $stmtlog = $conn->prepare("INSERT INTO change_log (UserId, Message)  VALUES (?, ?)");
        $stmtlog->bind_param("is", $userid, $message);
        $stmtlog->execute();
        return $stmt->error;
    } else {
        $message = "User Steve Balo edited contact " . $ContactFirstName . " " . $ContactLastName . ".";
        $userid = 1;  // Hard coded userid will change once sessions are properly implemented, then pull
        // userid from that
        $stmtlog = $conn->prepare("INSERT INTO change_log  (UserId, Message) VALUES (?, ?)");
        $stmtlog->bind_param("is", $userid, $message);
        $stmtlog->execute();
        return true;
    }
}

//Creates a new contact with the given values
//Returns if it worked ot not.
function createContact($OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
                       $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL)
{
    $Hiring = intval(boolval($Hiring));
    $OnADAdvisoryCommittee = intval(boolval($OnADAdvisoryCommittee));
    $conn = db_connect();
    $stmt = $conn->prepare("INSERT INTO organization_contacts  (OrganizationId, ContactFirstName, ContactLastName, Title, OfficeNumber,
       OfficeExtension, CellNumber, EmailAddress, Referral, Hiring, OnADAdvisoryCommittee, LinkedInURL)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
    $stmt->bind_param("issssssssiis", $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber, $OfficeExtension,
        $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL);

    $userid = 1;

    if (!$stmt->execute()) {
        $message = "Failed contact create action";
        $stmtlog = $conn->prepare("INSERT INTO change_log (UserId, Message)  VALUES (?, ?)");
        $stmtlog->bind_param("is", $userid, $message);
        $stmtlog->execute();
        return $stmt->error;
    } else {
        // Insert into change log
        $message = "User Steve Balo created contact " . $ContactFirstName . " " . $ContactLastName . ".";
        $stmtlog = $conn->prepare("INSERT INTO change_log  (UserId, Message) VALUES (?, ?)");
        $stmtlog->bind_param("is", $userid, $message);
        $stmtlog->execute();
        return true;
    }
}
?>