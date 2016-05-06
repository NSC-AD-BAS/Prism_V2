<?php

function add_company_toDB($name, $desc) {
    if (!empty($name) && !empty($desc)) {
        $conn = db_connect();
        $sql  = "INSERT into organizations (OrganizationName, Description) VALUES ('$name', '$desc')";
        $result = mysqli_query($conn, $sql);
    } else {
        $result = null;
    }
    mysqli_close($conn);
    return $result;
}
