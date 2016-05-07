<?php
function db_connect() {
    include '../lib/db_connect.php';
    //create and verify connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connect Failed: " . mysqli_connect_error());
    }
    return $conn;
}

function get_companies_list() {
    $conn = db_connect();
    $sql  = "SELECT * from org_list";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

function get_company_detail($id) {
    $conn = db_connect();
    $sql  = "SELECT * from org_detail where OrganizationId = $id limit 1";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

function get_internships_by_company($id) {
    $conn = db_connect();
    $sql  = "SELECT * from internships where OrganizationId = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

function get_contacts_by_company($id) {
    $conn = db_connect();
    $sql  = "SELECT * from organization_contacts where OrganizationId = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    //TODO: Check for null before trying to return here (CodeCleanup)
    return $output;
}

function isAdmin() {
    //TODO: This needs to (eventually) evaluate that the user is both logged in *and* has admin credentials.
    //Change to false to see nav and detail buttons auto-magically disappear.
    return true;
}

?>
