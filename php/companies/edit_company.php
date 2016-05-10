<?php

//Includes
include "page_builder.php";
include "query_db.php";
include "update_db.php";

//Passed along as a hidden input
$orgId = $_POST["orgId"];

//Query builder.  TODO: Maybe move this somewhere else. (CodeCleanup)
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
        $statement = !empty($_POST["statement"]) ? $_POST["statement"] : $d['Statement'];
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
            Statement=\"$statement\",
            Description=\"$desc\"
        WHERE OrganizationId = $orgId;
    ";
    return $query;
}

//Run the update and take the user back to detail screen for org.
//DEBUG FOR QUERY BUILDER
//build_update_query($orgId);
update_company(build_update_query($orgId));
header("Location: detail.php?id=$orgId");
?>
