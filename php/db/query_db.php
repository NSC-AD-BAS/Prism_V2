<?php

/*
    query_db.php - Stands up database connection and runs read-only queries against it.
    includes: db_connect.php
    included by: update_db and query_builder
    TODO: SECURITY - Move all DB function files outside of webroot to prevent direct access
*/

/*
    Handy DB Functions for everyone!
*/

//Stand-up and return a connect object
function db_connect() {
    include '../lib/db_connect.php';
    //create and verify connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connect Failed: " . mysqli_connect_error());
    }
    return $conn;
}

//Determine if logged-in user is an admin.  See the fixer, needs improvement
function isAdmin() {
    //FIXME: This needs to (eventually) evaluate that the user is both logged in *and* has admin credentials.
    //Change to false to see nav and detail buttons auto-magically disappear.
    return true;
}

//Get the result set from an arbitrary view (or table) name
function get_view_data($view) {
    $conn = db_connect();
    $sql  = "SELECT * FROM $view";
    $output = false;
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

//Get sorted results from an arbitrary view
function get_view_data_sorted($view, $field = "", $asc = "ASC") {
    if ($field === "") {
        return get_view_data($view);
    }
    $conn = db_connect();
    $sql = "SELECT * FROM $view ORDER BY $field $asc";
    $output = false;
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

/*
    Organization Specific DB Queries
*/

//Get the data from some view where OrgID = some ID.
function get_view_data_where($view, $orgId) {
    $conn = db_connect();
    $sql  = "SELECT * FROM $view WHERE OrganizationId = $orgId";
    $output = false;
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

//Return the list of all companies
function get_companies_list() {
    return get_view_data('org_list');
}

//Return a sorted list of companies
function get_companies_list_sorted($field = "", $asc = true) {
    return get_view_data_sorted('org_list', $field, $asc);
}

//Get the org detail for an org
function get_company_detail($id) {
    return get_view_data_where('org_detail', $id);
}

//Get the internships for an org
function get_internships_by_company($id) {
    return get_view_data_where('internships', $id);
}

//Get the contacts for an org
function get_contacts_by_company($id) {
    return get_view_data_where('org_contact_list', $id);
}

//Get all deleted companies
function get_deleted_companies() {
    return get_view_data('org_list_archived');
}

//Get the last error and return it.
function get_last_error($conn) {
    return mysqli_error($conn);
}

/*
    Internship Specific DB Queries
*/

// Returns internship list result
function get_internship_list($sort, $order) {
    $conn = db_connect();
    $sql = "SELECT DISTINCT *
            FROM internship_list
            ORDER BY $sort $order";
    $output = false;
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);

    return $output;
}

// Returns internship list result for certain search
// uses Full Text Search for quick searching techniques
function search_internship_list($query) {
    $conn = db_connect();

    /* enable FTS with this query
    $sql_fts = "ALTER TABLE internships
    ADD FULLTEXT(PositionTitle, Description, InternshipUrl);";
    $dummy_result = mysqli_query($conn, $sql_fts);
    while ($row = $dummy_result->fetch_assoc()) {
        $output[] = $row;
    }
    */

    // execute query
    $sql = "SELECT
                i.InternshipId,
                i.PositionTitle AS `Position Title`,
                o.OrganizationName AS `Organization`,
                CONCAT(o.City, \", \", o.State) AS `Location`
            FROM
                internships i
                    JOIN
                organizations o ON o.OrganizationId = i.OrganizationId
            WHERE
                UPPER(i.PositionTitle) LIKE UPPER(\"%${query}%\")
            OR
                UPPER(i.Description) LIKE UPPER(\"%${query}%\")
            OR
                UPPER(i.InternshipUrl) LIKE UPPER(\"%${query}%\")
            OR
                UPPER(o.OrganizationName) LIKE UPPER(\"%${query}%\")
            AND
                NOT i.isDeleted;";

    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    // clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);

    return $output;
}

// Returns intership detail result
function get_internship_detail($id) {
    $conn = db_connect();
    $sql = "SELECT DISTINCT *
            FROM internship_detail
            WHERE InternshipId = $id
            LIMIT 1;";
    $output = false;
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);

    return $output;
}

//Returns an array for the contact detail
function get_contact_detail($id)
{
    $conn = db_connect();
    $stmt = $conn->prepare("SELECT cts.*, orgs.OrganizationName
      FROM organization_contacts cts
      INNER JOIN organizations orgs
        ON cts.OrganizationId = orgs.OrganizationId
      WHERE cts.ContactId = ? limit 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($ContactId, $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
        $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL,
        $OrganizationName);

    $output = false;
    while ($stmt->fetch()) {
        $output[] = [$ContactId, $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
            $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL,
            $OrganizationName];
    }

    //clean-up result set and connection
    mysqli_close($conn);
    return $output;
}
?>
