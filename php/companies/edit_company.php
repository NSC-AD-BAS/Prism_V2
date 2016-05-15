<?php
/*
    edit_company.php - landing page for the edit company detail form submission.
    $_POST params are passed along to query_builder and the query sent back is run by update_db.
*/

//Includes
include "update_db.php";
include "query_builder.php";

//Disallow direct access
if (!isset($_POST["orgId"])) {
  header("Location: list.php");
}

//Passed along as a hidden input
$orgId = $_POST["orgId"];

$query = build_update_query($orgId);
//DEBUG: Uncomment to print the built query to the page for sanity checking, testing in Sequel
//echo $query;
update_company($query);
header("Location: detail.php?id=$orgId");
?>
