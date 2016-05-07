<?php

//Includes
include "page_builder.php";
include "query_db.php";
include "update_db.php";


render_header($company_name);
render_nav();

//This validation is likely redundant.  Safety measure?
if (isset($_POST["name"]) && isset($_POST["desc"])) {
    $company_name = $_POST["name"];
    $company_desc = $_POST["desc"];
} else {
//TODO: This should redirect to an error page eventually
    echo "Something went wrong adding your record.";
    die;
}

//Add the records
echo add_company_toDB($company_name, $company_desc);

//body


render_footer();
?>
