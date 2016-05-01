<?php

//Includes
include "page_builder.php";
include "query_db.php";

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
                echo "<a href=\"detail.php?id=" . $d['OrganizationId'] . "\">";
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


//Build the page
render_list_header('Companies');
render_nav();
render_body('Companies', get_companies_list());
render_footer();

?>
