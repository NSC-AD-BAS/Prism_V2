<?php

//Includes
include "page_builder.php";
include "query_db.php";

//Stuff specific to rendering *this* page
function render_body($info, $edit) {
    //We don't know the company name until we have the $data back from the db.  Specifically for page/tab title...
    $id = $info[0]['OrganizationId'];
    render_detail_header($info[0]['Company']);
    $available_positions = get_available_positions($id);
    $num_available_positions = get_num_available_positions($available_positions);
    $company_contacts = get_company_contacts($id);

    //Render company detail
    echo "<main>";
    echo "<input id=\"searchbox\" type=\"text\" placeholder=\" Search\" />";
    echo "<div class=\"wrapper\">";
    //Basic Company Info
    foreach ($info as $i) {
        //Short var names are much nicer to work with...
        $name = $i['Company'];
        $url = $i['URL'];
        $street = $i['Address 1'];
        $city_state = $i['City'] . ", " . $i['State'];
        $num_employees = $i['Number of Employees'];
        $revenue = $i['Yearly Revenue'];
        $statement = $i['Statement'];
        $desc = $i['Description'];
        echo "<h1>" . $i['Company'] . " - Company Detail</h1>";
        echo "<div class=\"detail_table\">";
        //Open Company Detail Table
        echo "<table>";
        echo "<tr><td>Company Name</td><td>";
        echo ($edit == true) ?  "<input class=\"textbox\" type=\"text\" placeholder=\"" . $name . "\" >" : $name . "</td></tr>";
        echo "<tr><td>Company URL</td><td>";
        echo ($edit == true) ?  "<input class=\"textbox\" type=\"text\" placeholder=\"" . $url . "\" >" : "<a href=\"" . $url . "\">" . $url . "</a></td></tr>";
        echo "<tr><td>Company Address</td><td>";
        echo ($edit == true) ?  "<input class=\"textbox\" type=\"text\" placeholder=\"" . $street . "\" ><br><input class=\"textbox\" type=\"text\" placeholder=\"" . $city_state . "\" >" : $street . "<br>" . $city_state . "</td></tr>";
        echo "<tr><td>Number of Employees</td><td>";
        echo ($edit == true) ?  "<input class=\"textbox\" type=\"text\" placeholder=\"" . number_format($num_employees) . "\" >" : number_format($num_employees) . "</td></tr>";
        echo "<tr><td>(Approx.) Annual Revenue</td><td>";
        echo ($edit == true) ?  "<input class=\"textbox\" type=\"text\" placeholder=\"" . money_format("%n", $revenue) . "\" >" : money_format("%n", $revenue) . "</td></tr>";
        echo "<tr><td>Company Statement</td><td>";
        echo ($edit == true) ?  "<input class=\"textbox\" type=\"text\" placeholder=\"" . $statement . "\" >" : $statement . "</td></tr>";
        echo "<tr><td>Description</td><td>";
        echo ($edit == true) ?  "<input class=\"textbox\" type=\"text\" placeholder=\"" . $desc . "\" >" : $desc . "</td></tr>";
    }
    echo "<tr><td>Total Internships Available</td><td>" . $num_available_positions . "</td></tr>";
    echo "<tr><td>Available Position(s)</td><td>";
    //TODO: Link each of these to respective Internships detail view
    foreach ($available_positions as $pos) {
        echo $pos['PositionTitle'] . " (" . $pos['SlotsAvailable'] . ") <br>";
    }
    echo "</td></tr>";
    echo "<tr><td>Company Contact(s)</td><td>";
    //Open Company Contact inner table
    echo "<table>";
    foreach ($company_contacts as $contact) {
        $first = $contact['ContactFirstName'];
        $last = $contact['ContactLastName'];
        $title = $contact['Title'];
        $email = $contact['EmailAddress'];
        $office = $contact['OfficeNumber'];
        $ext = $contact['OfficeExtension'];
        $cell = $contact['CellNumber'];
        $ref = $contact['Referral'];
        $hiring = $contact['Hiring'];
        $advise = $contact['OnADAdvisoryCommittee'];
        $linkedIn = $contact['LinkedInURL'];
        echo "<tr><td>Name</td><td>" . $first . " " . $last . "</td></tr>";
        echo "<tr><td>Title</td><td>" . $title . "</td></tr>";
        echo "<tr><td>Email</td><td><a href=\"mailto:" . $email . "\">" . $email . "</a></td></tr>";
        if (!empty($ext)) {
            echo "<tr><td>Office Number</td><td>" . $office . " (ext. " . $ext . ")</td></tr>";
        } else {
            echo "<tr><td>Office Number</td><td>" . $office . "</td></tr>";
        }
        echo "<tr><td>Cell Number</td><td>" . $cell . "</td></tr>";
        echo "<tr><td>Referral</td><td>" . $ref . "</td></tr>";
        echo "<tr><td>Hiring (Full Time Positions)</td><td>" . $hiring . "</td></tr>";
        echo "<tr><td>Advisory Committee</td><td>" . $advise . "</td></tr>";
        echo "<tr><td>Linked In</td><td><a href=\"" . $linkedIn . "\">" . $linkedIn . "</td></tr>";
        echo "<hr>";
    }
    echo "</table>"; //Close Company Contact inner table
    echo "</table>"; //Close Company Detail Table
    echo "</div>";   //Close detail_table div
    show_buttons($id, $edit);  //Sew Buttons!
    echo "</div>";   //Close wrapper div
    echo "</main>";
}

function get_available_positions($id) {
    return get_internships_by_company($id);
}

function get_num_available_positions($roles) {
    $num_positions = 0;
    foreach ($roles as $role) {
        $num_positions += $role['SlotsAvailable'];
    }
    return $num_positions;
}

function get_company_contacts($id) {
    return get_contacts_by_company($id);
}

function show_buttons($id, $edit) {
    echo "<div class=\"lower_nav\">";
    if ($edit) {
        //TODO: Implement Save (obvi)
        echo "<a class=\"button\" href=\"detail.php?id=$id\"><div>Save</div></a>";
        echo "<a class=\"button\" href=\"detail.php?id=$id\"><div>Cancel</div></a>";
    } else {
        echo "<a class=\"button\" href=\"list.php\"><div>Back to List</div></a>";
        if (isAdmin()) {
            echo "<a class=\"button\" href=\"detail.php?id=$id&edit=true\"><div>Edit</div></a>";
            //TODO: similar logic to edit w/o pre-populated fields in textboxes
            echo "<a class=\"button\" href=\"detail.php?id=$id&create=true\"><div>Create new Company</div></a>";
            //TODO: link to delete confirmation modal, hook up to archive / delete
            echo "<a class=\"button\" href=\"delete.php?type=company&id=$id\"><div>Delete</div></a>";
        }
    }
    echo "</div>";
}

//Company ID
$id = $_GET['id'];

//Is Edit Mode?
if (isset($_GET['edit']) && $_GET['edit'] == "true") {
    $edit = true;
} else {
    $edit = false;
}

//Locale for currency
setlocale(LC_MONETARY,"en_US");

//Build the page
render_nav();
render_body(get_company_detail($id), $edit);

render_footer();

?>
