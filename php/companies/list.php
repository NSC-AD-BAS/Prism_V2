<?php

//TODO: Utility function, move to util folder
function render_header($list_name) {
    echo "<!DOCTYPE html>";
    echo "<html lang=\"en\">";
    echo "<head>";
    echo "<title>PRISM - " . $list_name . "List</title>";
    echo "<meta charset=\"utf-8\">";
    echo "<link rel=\"stylesheet\" href=\"../style/site.css\">";
    echo "</head>";
    echo "<body>";
}

//TODO: Utility function, move to util folder
function render_nav() {
    //Pages may be added or re-ordered by adjusting this array
    $webroot =
    $nav_pages = ["Internships", "Companies", "Students", "Admin"];
    echo "<nav>";
    echo "<ul>";
    foreach ($nav_pages as $page) {
        echo "<li class=\"left\"><a href=\"../" . strtolower($page) . "/list.php\">" . $page . "</a></li>";
    }
    echo "</ul>";
    echo "</nav>";
}

//TODO: Utility function, move to util folder
function render_footer() {
    echo "<br>";
    echo "<footer>";
    echo "<p>North Seattle College - PRISM &copy; 2016</p>";
    echo "</body>";
    echo "</html>";
}

//TODO: Utility function, move to util folder
function db_connect() {
    include '../lib/db_connect.php';
    //create and verify connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connect Failed: " . mysqli_connect_error());
    } else {
        echo "<p>DB Connection OK</p>";
    }
    return $conn;
}

//Stuff specific to rendering *this* page
function render_body($list_name, $data) {

    //Table header
    $table_header = ["Company Name", "Location", "Positions Available"];
    echo "<main>";
    echo "<input id=\"searchbox\" type=\"text\" placeholder=\" Search\" />";
    echo "<h1>" . $list_name . "</h1>";

    //Build the table
    echo "<ul class=\"outer\">";
        echo "<li class=\"tableHead\">";
            echo "<ul class=\"inner\">";
            foreach ($table_header as $header) {
                echo "<li>" . $header . "</li>";
            }
            echo "</ul>";
        foreach ($data as $d) {
            echo "<li>";
                echo "<a href=\"#\">";
                echo "<ul class=\"inner\">";
                    echo "<li>" . $d['Organization Name'] . "</li>";
                    echo "<li>" . $d['Location'] . "</li>";
                    echo "<li>" . $d['Number of Positions'] . "</li>";
                echo "</ul>";
                echo "</a>";
            echo "</li>";
        }
        echo "</li>";
    echo "</ul>";

    echo "</main>";
}

function get_companies_list() {
    $conn = db_connect();
    $sql  = "SELECT * from org_list";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    //clean-up result set and connection
    mysqli_free_result($result);
    mysqli_close($conn);
    return $output;
}

//Build the page
render_header('Companies');
render_nav();
render_body('Companies', get_companies_list());
render_footer();

?>
