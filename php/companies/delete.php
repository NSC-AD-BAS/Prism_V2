<?php

//Includes
include "page_builder.php";
include "query_db.php";

//Company ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: list.php");
}

$data = get_company_detail($id);
$company_name = $data[0]['Company'];

render_header($company_name, false);
render_nav($company_name);

$out = '
    <p class="alert">Are you sure you want to delete ' . $company_name . '?</p>
    <hr>
    <a class="button" href="delete_company.php?id=' . $id . '"><div>Yes, Delete</div></a>
    <a class="button" href="detail.php?id=' . $id . '"><div>No</div></a>
';

echo $out;

render_footer();
?>
