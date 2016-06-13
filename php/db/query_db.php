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

//Determine if logged-in user is an admin.
function isAdmin() {
    return $_SESSION["user_type"] == "Admin" || $_SESSION["user_type"] == "Faculty";
}

function isFaculty() {
    return $_SESSION["user_type"] == "Faculty";
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
    Users specific DB Queries
*/
function get_user_list() {
    return get_view_data('user_list');
}

function get_user_detail($userId) {
    $conn = db_connect();
    $sql  = "SELECT * FROM user_list WHERE `User ID` = $userId";
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

function dbOut($str){
    if($str!="") {
        $str = stripslashes(trim($str));
    }//strip out slashes entered for SQL safety
	return $str;
}

/*
    Changelog specific DB Queries
*/
function changeLogList(){
    //create connection
    $conn = db_connect();

    $sql = "SELECT * FROM change_list;";//set sql statement
    $result = mysqli_query($conn, $sql);//grab tables

    $changeLogs = [];
    while ($row = mysqli_fetch_assoc($result)) {
        array_push($changeLogs, $row);
    }

    mysqli_free_result($result);
    mysqli_close($conn);

    return array_reduce($changeLogs, function($html, $changeLog) {
        return $html . buildListItemFromChangeLog($changeLog);
    });
}

/*
    Students Specific DB Queries
*/
//Make this a stub so we don't need to update all the Student Queries just yet.
function create_connection() {
    return db_connect();
}

function get_many_rows($query) {
    $conn = create_connection();

    $rows = array();
    if ($result = mysqli_query($conn, $query)) {
        while ($row = mysqli_fetch_assoc($result)) {
            array_push($rows, $row);
        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);

    return $rows;
}

function get_row($query) {
    $conn = create_connection();

    if ($result = mysqli_query($conn, $query)) {
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    }
    mysqli_close($conn);

    return $row;
}

function get_all_students() {
    $query = "SELECT * FROM student_detail;";
    return get_many_rows($query);
}

function get_single_student($id) {
    $query = "SELECT * FROM student_detail WHERE UserId = " . $id . ";";
    return get_row($query);
}

function get_all_fields($id) {
    $query = "SELECT * FROM students WHERE UserId = " . $id . ";";
    return get_row($query);
}

function get_all_intern_capstone_statuses() {
    $query = "SELECT * FROM intern_capstone_status;";
    return get_many_rows($query);
}

function get_all_application_statuses() {
    $query = "SELECT * FROM application_status;";
    return get_many_rows($query);
}

function get_all_program_statuses() {
    $query = "SELECT * FROM program_status;";
    return get_many_rows($query);
}

function get_prev_student($id) {
    $query = "SELECT UserId FROM student_detail WHERE UserId < " . $id . " and isDeleted = 0 ORDER BY UserId DESC LIMIT 1;";
    $row = get_row($query);
    return $row["UserId"];
}

function get_next_student($id) {
    $query = "SELECT UserId FROM student_detail WHERE UserId > " . $id . " and isDeleted = 0 ORDER BY UserId LIMIT 1;";
    $row = get_row($query);
    return $row["UserId"];
}

function get_student_notes($userId) {
    $query = "SELECT
        un.User_NoteId AS `NoteId`,
        un.Note_Type AS `Type`,
        un.Note_Text AS `Text`
    FROM
        users u
            JOIN
        user_notes un ON u.UserId = un.UserId
    WHERE u.UserId = " . $userId;

   return get_many_rows($query);
}

function get_note($id) {
    $query = "SELECT
        u.UserId,
        un.User_NoteId AS `NoteId`,
        un.Note_Type AS `Type`,
        un.Note_Text AS `Text`
    FROM
        users u
            JOIN
        user_notes un ON u.UserId = un.UserId
    WHERE un.User_NoteId = " . $id;

    return get_row($query);
}

function get_students_matching_filters($filters) {
    $students = get_all_students();
    foreach ($filters as $filter) {
        $students = array_filter($students, $filter);
    }
    return $students;
}

function get_user_data($userId) {
    $query = "SELECT * FROM users WHERE UserId = " . $userId . ";";
    return get_row($query);
}

// The function get_user_profile is used on the profile page to get data for non-student users
function get_user_profile($userId) {
    $query = "SELECT users.UserId, users.FirstName AS `First Name`, users.MiddleName AS `Middle Name`, users.LastName AS `Last Name`, users.PhoneNumber AS `Phone`, users.EmailAddress AS `Email`
        FROM users
        WHERE users.UserId = " . $userId . ";";
    return get_row($query);
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
