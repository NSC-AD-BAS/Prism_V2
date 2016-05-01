<?php
# query_db php file: db read-access layer
# Author: Tim Davis
# Author: Kellan Nealy

# Returns db connection
function db_connect() {
    require("../lib/db_connect.php");
    # Establish and verify connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connect Failed: " . mysqli_connect_error());
    }
    return $conn;
}

# Returns internship list result
function get_internship_list() {
    # Get connection
    $conn = db_connect();

    # SQL query
    $sql = "SELECT DISTINCT *
            FROM internship_list;";

    # Get query results
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }

    # Clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);

    return $output;
}

# Returns intership detail result
function get_internship_detail($id) {
    # Get connection
    $conn = db_connect();

    # SQL query
    $sql = "SELECT DISTINCT *
            FROM internship_detail
            WHERE InternshipId = $id
            LIMIT 1;";

    # Get query results
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }

    # Clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);

    return $output;
}

?>
