<?php

//Includes
include "../render/page_builder.php";
include "../render/render_company.php";
include "../db/query_db.php";
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

//Allow column sorting
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
} else {
    $sort = "";
}
if (isset($_GET['order'])) {
    $order = $_GET['order'];
} else {
    $order = "ASC";
}

//Get ugly view names from nicer url args
if ($sort == "comp") {
    $field = "`Organization Name`";
} else if ($sort == "loc") {
    $field = "Location";
} else if ($sort == "avail") {
    $field = "`Available Internships`";
} else {
    //someone passed in something they oughtn't have, default to company alpha sort
    $field = "`Organization Name`";
}

//Render the default page
render_header('Companies', false);
render_nav('Company List');
if (!$archived) {
    renderCompanyList(get_companies_list_sorted($field, $order), false);
} else {
    renderCompanyList(get_deleted_companies(), true);
}
render_footer();

?>
