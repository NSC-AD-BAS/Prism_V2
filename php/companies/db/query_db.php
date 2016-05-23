<?php

/*
    query_db.php - Stands up database connection and runs read-only queries against it.
    includes: db_connect.php
    included by: update_db and query_builder
    TODO: SECURITY - Move all DB function files outside of webroot to prevent direct access
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

function get_view_data($view) {
    $conn = db_connect();
    $sql  = "SELECT * FROM $view";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

function get_view_data_where($view, $orgId) {
    $conn = db_connect();
    $sql  = "SELECT * FROM $view WHERE OrganizationId = $orgId";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

function get_companies_list() {
    return get_view_data('org_list');
}

function get_company_detail($id) {
    return get_view_data_where('org_detail', $id);
}

function get_internships_by_company($id) {
    return get_view_data_where('internships', $id);
}

function get_contacts_by_company($id) {
    return get_view_data_where('org_contact_list', $id);
}

function get_deleted_companies() {
    return get_view_data('org_list_archived');
}

function get_last_error($conn) {
    return mysqli_error($conn);
}

function isAdmin() {
    //FIXME: This needs to (eventually) evaluate that the user is both logged in *and* has admin credentials.
    //Change to false to see nav and detail buttons auto-magically disappear.
    return true;
}

?>
