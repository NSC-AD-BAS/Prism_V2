<?php

/*
    detail.php - Determine if we are viewing, editing or creating a company based on URL Query
    Render the company detail screen accordingly.
*/

//Includes
require "../login/validate_session.php";
require_once("../includes/config.php");

//Check URL params to set globals
//Company ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $create = false;
} elseif (isset($_GET['create']) && $_GET['create'] == "true") {
    $create = true;
} else {
    header("Location: list.php");
}

//Are we in Create or Edit Mode?
if ($create || (isset($_GET['edit']) && $_GET['edit'] == "true")) {
    $edit = true;
} else {
    $edit = false;
}
//Locale for currency
setlocale(LC_MONETARY,"en_US");

//If the company exists, get data necessary to render the page from the DB
if (!$create) {
    $data = get_company_detail($id);
    $company_name = $data[0]['Company'];
} else {
    $company_name = 'New Company';
}

//Don't hit the DB if we're not rendering these bits
if (!$edit && !$create) {
    $positions = get_internships_by_company($id);
    $company_contacts = get_contacts_by_company($id);
}

//If there are no errors, render the page
if ($data) {
    render_header('Companies', true);
    render_nav($company_name);
    renderCompanyDetail($data, $edit, $create);
    //Only show Contacts and Internships if we're not in edit mode.
    if (!$edit) {
        renderCompanyInternships($positions, $id);
        renderCompanyContacts($company_contacts, $id);
    }
} else {
    $msg = urlencode("Something went wrong getting Company Details for CompanyId: $id ");
    header("Location: error.php?$msg");
}


render_footer();
?>
