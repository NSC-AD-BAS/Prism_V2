<?php

//Includes
include "page_builder.php";
include "query_builder.php";
include "update_db.php";

if (isset($_GET['id']) && isset($_GET['delete'])) {
    $id = $_GET['id'];
    $delete = $_GET['delete'];
} else {
    header("Location: list.php");
}

$query = build_delete_company_query($id, $delete);
update_company($query);
header("Location: list.php");

?>
