<?php

//Includes
include "page_builder.php";
include "query_db.php";
include "update_db.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: list.php");
}

$query = "UPDATE organizations SET isArchived=true WHERE OrganizationId=$id";
update_company($query);
header("Location: list.php");

?>
