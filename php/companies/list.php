<?php

//Includes
include "page_builder.php";
include "query_db.php";
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

function renderCompanyList($data, $archived) {
    $out = '
        <ul class="outer">
            <li class="tableHead">
            <ul class="inner">
                <li>Company Name</li>
                <li>Location</li>
                <li>Internships Available</li>
            </ul>
        ';
        foreach ($data as $d) {
            $available = $archived ? 0 : $d['Available Internships'];
            $out .= '
            <li><a href="detail.php?id=' . $d['OrganizationId'] . '">
                <ul class="inner">
                    <li>' . $d['Organization Name'] . '</li>
                    <li>' . $d['Location'] . '</li>
                    <li>' . $available . '</li>
                </ul>
            </a></li>
            ';
        }
    $out .= '</ul>';
    if (isAdmin()) {
        $out .= '
            <hr>
            <a class="button" href="create.php"><div>Create new Company</div></a>
        ';
    }

    //Toggle archive display text
    if (!$archived) {
        $out .= '<a class="aside" href="list.php?archived=true">Show Deleted</a>';
    } else {
        $out .= '<a class="aside" href="list.php">Hide Deleted</a>';
    }

    echo $out;
}

render_header('Companies', false);
render_nav('Company List');
if (!$archived) {
    renderCompanyList(get_companies_list(), false);
} else {
    renderCompanyList(get_deleted_companies(), true);
}
render_footer();

?>
