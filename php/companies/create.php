<?php

//Includes
include "page_builder.php";
include "query_db.php";

render_header('', false);
render_nav('Create New Company');
    echo "<div class=\"wrapper\">";
    echo "<div class=\"detail_table\">";
    echo "<table>";
    echo "<form action=\"add_company.php\" method=\"post\">";
    echo "<tr><td>Company Name</td></tr>";
    echo "<td><input class=\"textbox\" type=\"text\" placeholder=\"Company Name\" name=\"name\"></td></tr>";
    echo "<tr><td>Company Description</td></tr>";
        echo "<td><input class=\"textbox\" type=\"text\" placeholder=\"Company Description\" name=\"desc\"></td></tr>";
    echo "</table>";
    echo "<div class=\"lower_nav\">";
        echo "<input type=\"submit\" class=\"button\" value=\"Add\"></td></tr>";
        echo "<input type=\"submit\" class=\"button\" value=\"Cancel\"></td></tr>";
    echo "</div>";
    echo "</form>";
    echo "</div>";
    echo "</div>";

render_footer();
?>
