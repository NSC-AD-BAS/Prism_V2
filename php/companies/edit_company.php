<?php
/*
    edit_company.php - landing page for the edit company detail form submission.
    $_POST params are passed along to query_builder and the query sent back is run by update_db.
*/

//Includes
require "../login/validate_session.php";
require_once("../includes/config.php");

//Disallow direct access
if (!isset($_POST["id"])) {
  header("Location: list.php");
}

//Passed along as a hidden input
$id = $_POST["id"];

$query = build_update_query($id);

update_company($query); //TODO: Verify success / fail and redirect accordingly
header("Location: detail.php?id=$id");
?>
