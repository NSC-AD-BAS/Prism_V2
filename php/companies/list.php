<?php

//Includes
include "../render/page_builder.php";
include "../render/render_company.php";
include "db/query_db.php";
include_once("../login/login_utils.php");

# Session management
session_start();
if (!is_logged_in()) {
    to_login();
}

//Toggle showing deleted / archived companies
if (isset($_GET['archived']) && $_GET['archived'] == "true") {
    $archived = true;
} else {
    $archived = false;
}

//Render the page
render_header('Companies', false);
render_nav('Company List');
if (!$archived) {
    renderCompanyList(get_companies_list(), false);
} else {
    renderCompanyList(get_deleted_companies(), true);
}
render_footer();

?>
