<?php

/*
    delete_company.php - Delete or restore a company (toggle its isDeleted flag in the DB)
*/

//Includes
require "../login/validate_session.php";
require_once("../includes/config.php");

//Disallow direct access
if (isset($_GET['id']) && isset($_GET['delete'])) {
    $id = $_GET['id'];
    $delete = $_GET['delete'];
} else {
    header("Location: list.php");
}

//Build and run the delete/restore query
$query = build_delete_company_query($id, $delete);
update_company($query);

//Bounce user back to company list
header("Location: list.php");

?>
