<?php

/*
    update_db.php - Runs update queries against database.
    includes: query_db.php
    included by: Any page that creates, edits or deletes records in the DB
    TODO: SECURITY - Move all DB function files outside of webroot to prevent direct access
*/

//Includes
include "query_db.php";

//Populate update query with any posted data, fall-back to existing data from DB.  Returns a query string.
function build_update_query($orgId) {
    $data = get_company_detail($orgId);
    foreach ($data as $d) {
        $name = !empty($_POST["name"]) ? $_POST["name"] : $d['Company'];
        $url = !empty($_POST["url"]) ? $_POST["url"] : $d['URL'];
        $street = !empty($_POST["street"]) ? $_POST["street"] : $d['Address 1'];
        $city = !empty($_POST["city"]) ? $_POST["city"] : $d['City'];
        $state = !empty($_POST["state"]) ? $_POST["state"] : $d['State'];
        $num_employees = !empty($_POST["num_employees"]) && is_numeric($_POST["num_employees"]) ? $_POST["num_employees"] : $d['Number of Employees'];
        $revenue = !empty($_POST["revenue"]) && is_numeric($_POST["revenue"]) ? $_POST["revenue"] : $d['Yearly Revenue'];
        $desc = !empty($_POST["desc"]) ? $_POST["desc"] : $d['Description'];
    }

    $query = "
        UPDATE organizations SET
            OrganizationName=\"$name\",
            URL=\"$url\",
            StreetAddressLineOne=\"$street\",
            City=\"$city\",
            State=\"$state\",
            NumOfEmployees=$num_employees,
            YearlyRevenue=$revenue,
            Description=\"$desc\"
        WHERE OrganizationId = $orgId;
    ";
    log_query("build_create_company_query", $query);
    return $query;
}

//Create the necessary query to add a new company.  Name and description are required, other values are guessed.  Returns a query string.
function build_create_company_query($name, $desc) {
    $url = !empty($_POST["url"]) ? $_POST["url"] : "";
    $street = !empty($_POST["street"]) ? $_POST["street"] : "";
    $city = !empty($_POST["city"]) ? $_POST["city"] : "Seattle";
    $state = !empty($_POST["state"]) ? $_POST["state"] : "WA";
    $num_employees = !empty($_POST["num_employees"]) ? $_POST["num_employees"] : 0;
    $revenue = !empty($_POST["revenue"]) ? $_POST["revenue"] : 0;

    $query = "
        INSERT INTO organizations SET
        OrganizationName=\"$name\",
        URL=\"$url\",
        StreetAddressLineOne=\"$street\",
        City=\"$city\",
        State=\"$state\",
        NumOfEmployees=$num_employees,
        YearlyRevenue=$revenue,
        Description=\"$desc\",
        isDeleted=0
    ";
    //TODO: fix log_query method.
    log_query("build_create_company_query", $query);
    return $query;
}

//FIXME: This is a hack.  The org_list view shouldn't rely on internships being defined to include a company in the result set.
//Create the necessary query to add a placeholder internship for a new company.
//orgId is an auto-increment value returned from the create_company method and passed in by create.php.
function build_create_internship_for_company_query($orgId) {
    $now = date('Y-m-d H:i:s');
    $exp = date('Y-m-d H:i:s', strtotime("+12 weeks"));
    $query = "
        INSERT INTO internships SET
        OrganizationId=$orgId,
        PositionTitle=\"Placeholder_Internship_Title\",
        Description=\"Placeholder_Internship_Description\",
        DatePosted=\"$now\",
        LastUpdated=\"$now\",
        ExpirationDate=\"$exp\"
    ";
    log_query("build_create_company_query", $query);
    return $query;
}

//Toggle delete status of the passed in orgId.  Set $delete to true to delete company, false to restore
function build_delete_company_query($orgId, $delete) {
    $query = "
        UPDATE organizations SET
        isDeleted=$delete
        WHERE OrganizationId=$orgId
    ";
    return $query;
}

function log_query($function_name, $query) {
    file_put_contents("/tmp/query.log", $function_name + ": " + $query, FILE_APPEND);
}

?>
