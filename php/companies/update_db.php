<?php

//TODO: Input validation at calling function
function create_company($query) {
    $conn = db_connect();
    mysqli_query($conn, $query);
    $orgId = mysqli_insert_id($conn);
    return $orgId;
}

//TODO: Define generic update query for these two
function create_internship_for_company($query) {
    $conn = db_connect();
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    return $result;
}

function update_company($query) {
    $conn = db_connect();
    $result = mysqli_query($conn, $query);
    mysqli_close($conn);
    return $result;
}

?>
