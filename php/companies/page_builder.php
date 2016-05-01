<?php
//TODO: Utility functions, move to util folder
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

function render_nav() {
    //Pages may be added or re-ordered by adjusting this array
    $nav_pages = ["Internships", "Companies", "Students", "Admin"];
    echo "<nav>";
    echo "<ul>";
    foreach ($nav_pages as $page) {
        echo "<li class=\"left\"><a href=\"../" . strtolower($page) . "/list.php\">" . $page . "</a></li>";
    }
    echo "</ul>";
    echo "</nav>";
}

function render_footer() {
    echo "<br>";
    echo "<footer>";
    echo "<p>North Seattle College - PRISM &copy; 2016</p>";
    echo "</body>";
    echo "</html>";
}


?>
