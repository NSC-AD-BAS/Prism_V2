<?php

/*
    update_db.php - Runs update queries against database.
    includes: none
    included by: Any page that creates, edits or deletes records in the DB
    TODO: SECURITY - Move all DB function files outside of webroot to prevent direct access
*/

//TODO: Input validation at calling function
function create_company($query) {
    $conn = db_connect();
    mysqli_query($conn, $query);
    $orgId = mysqli_insert_id($conn);
    return $orgId;
}

//TODO: Handle return statements properly in calling code
function update_db($query) {
    $conn = db_connect();
    $result;
    if (!mysqli_query($conn, $query)) {
        $result = get_last_error($conn);
    } else {
        $result = mysqli_query($conn, $query);
    }
    mysqli_close($conn);
    return $result;
}

function create_internship_for_company($query) {
    return update_db($query);
}

function update_company($query) {
    return update_db($query);
}

?>
