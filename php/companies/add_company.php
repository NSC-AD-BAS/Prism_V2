<?php

//Includes
include "page_builder.php";
include "update_db.php";
include "query_builder.php";

//This validation is likely redundant.  Safety measure?
if (isset($_POST["name"]) && isset($_POST["desc"])) {
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    //Add the company to the DB and get the orgId returned
    $query = build_create_company_query($name, $desc);
    $orgId = create_company($query);

    if ($orgId > 0) {
        //Org Create succeeded, add internship
        $msg = urlencode("Created Company");
        $query = build_create_internship_for_company_query($orgId);
        $result = create_internship_for_company($query);
        if (!$result) {
            $msg .= urlencode(", Create Internship Failed");
            header("Location: error.php?msg=$msg");
        } else {
            $msg .= urlencode(", Created Internship");
            header("Location: detail.php?id=$orgId&edit=true");
        }
    } else {
        $msg = urlencode("Create Company Failed");
        header("Location: error.php?msg=$msg");
    }
} else {
    $msg = urlencode("POST Variables not set.");
    header("Location: error.php?msg=$msg");
}
?>
