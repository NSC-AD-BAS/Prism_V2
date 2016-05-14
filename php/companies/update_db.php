<?php

function add_company_toDB($name, $desc) {
    $now = date('Y-m-d H:i:s');
    if (!empty($name) && !empty($desc)) {
        $conn = db_connect();
        mysqli_autocommit($conn, FALSE);

        //Create Org and get orgId from auto-increment
        $createOrg = build_company_query($name, $desc);
        mysqli_query($conn, $createOrg);
        $orgId = mysqli_insert_id($conn);

        //Create Internship for org with a few initial values
        $addInternship = build_internship_query($orgId, $now);
        mysqli_query($conn, $addInternship);

        //Try to commit all the queries as a transaction
        if (!mysqli_commit($conn)) {
            print("Transaction commit failed\n");
            exit();
        }
    } else {
        echo "<p>We could not add the company.  Please make sure you fill out all fields</p>";
    }
    mysqli_close($conn);
    return $orgId;
}

function update_company($query) {
    $conn = db_connect();
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    return $result;
}

//Query Builders.  TODO: Maybe move these somewhere else (CodeCleanup)
function build_company_query($name, $desc) {
    $query = "
        INSERT INTO organizations SET
        OrganizationName=\"$name\",
        Description=\"$desc\",
        City=\"Seattle\",
        State=\"WA\",
        YearlyRevenue=0,
        NumOfEmployees=0,
        isArchived=0

    ";
    return $query;
}

//Populate internship with temporary data so we can render the company on the list.
function build_internship_query($orgId, $now) {
    $exp = date('Y-m-d  H:i:s', strtotime("+12 weeks"));
    $query = "
        INSERT INTO internships SET
        OrganizationId=$orgId,
        PositionTitle=\"EDIT_ME\",
        Description=\"EDIT_ME_TOO\",
        DatePosted=\"$now\",
        LastUpdated=\"$now\",
        ExpirationDate=\"$exp\"
    ";
    return $query;
}


?>
