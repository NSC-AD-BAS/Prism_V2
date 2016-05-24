<?php

/*
    delete.php - Delete / restore confirmation page.  Determines and toggles current state, calls delete_company.php to do the dirty work
*/

//Includes
include "../render/page_builder.php";
include "db/query_db.php";

//Company ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: list.php");
}

//Get the data
$data = get_company_detail($id);
$company_name = $data[0]['Company'];
$isDeleted = $data[0]['isDeleted'];

//Toggle Delete button text
if ($isDeleted) {
    $text = "Restore";
    $delete = 0;
} else {
    $text = "Delete";
    $delete = 1;
}

//Render the page
render_header($company_name, false);
render_nav($company_name);

//Maybe move this to render_company method?
$out = '
    <p class="alert">Are you sure you want to ' . $text . ' ' . $company_name . '?</p>
    <hr>
    <a class="button" href="delete_company.php?id=' . $id . '&delete=' . $delete . '"><div>Yes, ' . $text . '</div></a>
    <a class="button" href="detail.php?id=' . $id . '"><div>No</div></a>
';
echo $out;
render_footer();

?>
