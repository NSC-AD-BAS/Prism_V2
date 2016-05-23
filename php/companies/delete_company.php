<?php

//Includes
include "../render/page_builder.php";
include "db/query_builder.php";
include "db/update_db.php";

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
