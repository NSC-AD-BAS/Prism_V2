<?php

//Includes
include "page_builder.php";
include "query_db.php";
include "update_db.php";

if (isset($_POST["name"]) && isset($_POST["desc"])) {
    $company_name = $_POST["name"];
    $company_desc = $_POST["desc"];
} else {
//TODO: This should be an error page eventually
    echo "Something went wrong adding your record.";
    die;
}

render_list_header($company_name);
echo "<main>";

//body
if (add_company_toDB($company_name, $company_desc)) {
    echo "LOOKS GOOD";
} else {
    echo "Something bad happened.";
}


echo "</main>";
render_nav();
render_footer();
?>
