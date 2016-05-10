<?php

//Includes
include "page_builder.php";
include "query_db.php";
include "update_db.php";

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

//Add the records and send em to the edit screen!
$orgId = add_company_toDB($company_name, $company_desc);
header("Location: detail.php?id=$orgId&edit=true");

?>
