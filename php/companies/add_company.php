<?php

//Includes
include "page_builder.php";
include "update_db.php";
include "query_builder.php";

//This validation is likely redundant.  Safety measure?
if (isset($_POST["name"]) && isset($_POST["desc"])) {
    $company_name = $_POST["name"];
    $company_desc = $_POST["desc"];
} else {
    render_header($company_name);
    render_nav();
    render_footer();
    echo "Something went wrong adding your record.";
    exit();
}

//Add the company to the DB and get the orgId returned
$query = build_create_company_query($company_name, $company_desc);
$orgId = create_company($query); //TODO: Check for result before proceeding

//Add the internship to the DB
$now = date('Y-m-d H:i:s');
$query = build_create_internship_for_company_query($orgId, $now);
create_internship_for_company($query); //TODO: Check for result before redirecting to edit screen

//Drop user on the edit detail page. #workflow.
header("Location: detail.php?id=$orgId&edit=true");

?>
