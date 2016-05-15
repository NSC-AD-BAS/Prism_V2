<?php

//Includes
include "query_db.php";

function build_update_query($orgId) {
    $data = get_company_detail($orgId);
    foreach ($data as $d) {
        $name = !empty($_POST["name"]) ? $_POST["name"] : $d['Company'];
        $url = !empty($_POST["url"]) ? $_POST["url"] : $d['URL'];
        $street = !empty($_POST["street"]) ? $_POST["street"] : $d['Address 1'];
        $city = !empty($_POST["city"]) ? $_POST["city"] : $d['City'];
        $state = !empty($_POST["state"]) ? $_POST["state"] : $d['State'];
        $num_employees = !empty($_POST["num_employees"]) ? $_POST["num_employees"] : $d['Number of Employees'];
        $revenue = !empty($_POST["revenue"]) ? $_POST["revenue"] : $d['Yearly Revenue'];
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
    return $query;
}

//Query Builders.  TODO: COMMENT EACH QUERY
//TODO: Rename to build_company_create_query
function build_company_query($name, $desc) {
    $query = "
        INSERT INTO organizations SET
        OrganizationName=\"$name\",
        Description=\"$desc\",
        City=\"Seattle\",
        State=\"WA\",
        YearlyRevenue=0,
        NumOfEmployees=0,
        isArchived=0
    ";
    return $query;
}

//Populate internship with temporary data so we can render the company on the list.
//TODO: Rename to build_internship_create_query
function build_internship_query($orgId, $now) {
    $exp = date('Y-m-d  H:i:s', strtotime("+12 weeks"));
    $query = "
        INSERT INTO internships SET
        OrganizationId=$orgId,
        PositionTitle=\"Placeholder_Internship_Title\",
        Description=\"Placeholder_Internship_Description\",
        DatePosted=\"$now\",
        LastUpdated=\"$now\",
        ExpirationDate=\"$exp\"
    ";
    return $query;
}

?>
