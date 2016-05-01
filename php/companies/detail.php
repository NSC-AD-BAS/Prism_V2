<?php

//Includes
include "page_builder.php";
include "query_db.php";

//Stuff specific to rendering *this* page
function render_body($info) {
    //We don't know the company name until we have the $data back from the db.  Specifically for page/tab title...
    $id = $info[0]['OrganizationId'];
    render_detail_header($info[0]['Company']);
    $available_positions = get_available_positions($id);
    $num_available_positions = get_num_available_positions($available_positions);

    //Render company detail
    echo "<main>";
    echo "<input id=\"searchbox\" type=\"text\" placeholder=\" Search\" />";
    echo "<div class=\"wrapper\">";
    //Basic Company Info
    foreach ($info as $i) {
        echo "<h1>" . $i['Company'] . " - Company Detail</h1>";
        echo "<div class=\"detail_table\">";
        echo "<table>";
        echo "<tr><td>Company Name</td><td>" . $i['Company'] . "</td></tr>";
        echo "<tr><td>Company URL</td><td><a href=\"" . $i['URL'] . "\">" . $i['URL'] . "</a></td></tr>";
        echo "<tr><td>Company Address</td><td>" . $i['Address 1'] . "<br>" . $i['City'] . ", " . $i['State'] . "</td></tr>";
        echo "<tr><td>Number of Employees</td><td>" . number_format($i['Number of Employees']) . "</td></tr>";
        echo "<tr><td>(Approx.) Annual Revenue</td><td>" . money_format("%n", $i['Yearly Revenue']) . "</td></tr>";
        echo "<tr><td>Company Statement</td><td>" . $i['Statement'] . "</td></tr>";
        echo "<tr><td>Description</td><td>" . $i['Description'] . "</td></tr>";
    }
    echo "<tr><td>Total Internships Available</td><td>" . $num_available_positions . "</td></tr>";
    echo "<tr><td>Available Position(s)</td><td>";
        //TODO: Link each of these to respective Internships view
        foreach ($available_positions as $pos) {
            echo $pos['PositionTitle'] . " (" . $pos['SlotsAvailable'] . ") <br>";
        }
    echo "</td></tr>";

    //Close open tags
    echo "</table>";
    echo "</div>";
    echo "</main>";
}

function get_available_positions($id) {
    return get_internships_by_company($id);
}

function get_num_available_positions($roles) {
    foreach ($roles as $role) {
        $num_positions += $role['SlotsAvailable'];
    }
    return $num_positions;
}

//Company ID
$id = $_GET['id'];

//Is Edit Mode?
if (isset($_GET['edit'])) {
    $edit = $_GET['edit'];
} else {
    $edit = false;
}

//Locale for currency
setlocale(LC_MONETARY,"en_US");

//Build the page
render_nav();
render_body(get_company_detail($id));
render_footer();

?>
