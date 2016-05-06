<?php

//Includes
include "page_builder.php";
include "query_db.php";

//Check URL params to set globals
//Company ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    //TODO: If $id isn't set, redirect user to the list view
    $id = 1;
}
//Is Edit Mode?
if (isset($_GET['edit']) && $_GET['edit'] == "true") {
    $edit = true;
} else {
    $edit = false;
}
//Locale for currency
setlocale(LC_MONETARY,"en_US");


//Hit the DB, get data necessary to render the page
$data = get_company_detail($id);
$company_name = $data[0]['Company'];
$positions = get_available_positions($id);
$num_available_positions = get_num_available_positions($positions);
$company_contacts = get_company_contacts($id);

//Actually Build the page!
render_header('Companies', true);
render_nav($company_name);
renderCompanyDetail($data, $edit);
//show_buttons($id, $edit);
//Only show Contacts and Internships if we're not in edit mode.
if (!$edit) {
    renderCompanyInternships($positions);
    renderCompanyContacts($company_contacts);
}

render_footer();


/* Rendering Functions */
//Company Data
function renderCompanyDetail($data, $edit) {
    //set nicer globals
    foreach ($data as $d) {
        $id = $d['OrganizationId'];
        $name = $d['Company'];
        $url = $d['URL'];
        $street = $d['Address 1'];
        $city = $d['City'];
        $state = $d['State'];
        $num_employees = $d['Number of Employees'];
        $revenue = $d['Yearly Revenue'];
        $statement = $d['Statement'];
        $desc = $d['Description'];
    }

    //Company Detail Table
    //TODO: check $edit to determine <form>
    $out = "
        <div class=\"wrapper\">
        <div class=\"detail_table\">
        <table>
            <tr><td>Company Name</td><td><strong>" . displayValue($name, $edit, false) . "</strong></td></tr>
            <tr><td>Company URL </td><td>   " . displayValue($url,  $edit, true)  . "</td></tr>
            <tr><td>Company Address</td><td>
                <table>
                    <td><tr>" . displayValue($street,  $edit, false) . "&nbsp;</td></tr>
                    <br>
                    <td><tr>" . displayValue($city,  $edit, false) . ", " . displayValue($state, $edit, false) . "</td></tr>
                </table></td></tr>
            <tr><td>Number of Employees</td><td> " . displayValue(number_format($num_employees), $edit, false) . "</td></tr>
            <tr><td>Annual Revenue</td><td>      " . displayValue(money_format("%n", $revenue) , $edit, false) . "</td></tr>
            <tr><td>Company Statement</td><td>   " . displayValue($statement, $edit, false) . "                   </td></tr>
            <tr><td>Description</td><td>         " . displayValue($desc, $edit, false) . "                        </td></tr>
        </table>
        <hr>
        ";
        //Sew Buttons...
        $out .= "<div class=\"lower_nav\">";
            if ($edit) {
                $out .= "
                    <a class=\"button\" href=\"detail.php?id=$id\"><div>Save</div></a>
                    <a class=\"button\" href=\"detail.php?id=$id\"><div>Cancel</div></a>
                ";
            } else {
                $out .= "
                    <a class=\"button\" href=\"list.php\"><div>Company List</div></a>
                ";
                if (isAdmin()) {
                    $out .= "
                        <a class=\"button\" href=\"detail.php?id=$id&edit=true\"><div>Edit</div></a>
                        <a class=\"button\" href=\"create.php\"><div>Create Company</div></a>
                        <a class=\"button\" href=\"delete.php?type=company&id=$id\"><div>Delete</div></a>
                    ";
                }
            }
            $out .= "
        </div> <!--lower_nav-->
        </div> <!--detail_table-->
        </div> <!--wrapper-->
        ";
    echo $out;
}

function renderCompanyInternships($positions) {
    $out = "
        <div class=\"wrapper\">
        <div class=\"detail_table\">
        <h3>Available Internships</h3>
        <ul class=\"outer\">
            <li class=\"tableHead\">
            <ul class=\"inner\">
                <li>Title</li>
                <li>Description</li>
                <li># Available</li>
            </ul>
        ";
        foreach ($positions as $pos) {
            $internshipId = $pos['InternshipId'];
            $title = $pos['PositionTitle'];
            $desc = $pos['Description'];
            $slots = $pos['SlotsAvailable'];
            $out .= "
                <li><a href=\"../internships/detail.php?id=" . $internshipId . "\">
                <ul class=\"inner\">
                    <li>" . $title . "</li>
                    <li> " . $desc . " </li>
                    <li> ( " . $slots . " ) </li>
                </ul>
            </a></li>
            ";
        }
        //Sew Buttons...
        $out .= "
            <a class=\"button\" href=\"../internships/list.php\"><div>Internship List</div></a>
        ";
        if (isAdmin()) {
            $out .= "
                <a class=\"button\" href=\"../internships/create.php\"><div>Create Internship</div></a>
            ";
        }
    $out .= "
        </div> <!--lower_nav-->
        </div> <!--detail_table-->
        </div> <!--wrapper-->
    ";
    echo $out;
}

function renderCompanyContacts($company_contacts) {
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
    }
    $out = "
        <div class=\"wrapper\">
        <div class=\"detail_table\">
        <table>
        <h3>Company Contacts</h3>
        <tr><td>Name</td><td>" . $first . " " . $last ."</td></tr>
        <tr><td>Title</td><td>" . $title ."</td></tr>
        <tr><td>Email Address</td><td>" . displayValue($email, false, true) ."</td></tr>
        <tr><td>Office Phone</td><td>" . $office . "</td><td>ext. </td><td>" . $ext . "</td></tr>
        <tr><td>Office Phone</td><td>" . $cell . "</td></tr>
        <tr><td>Referral</td><td>" . $ref . "</td></tr>
        <tr><td>Hiring Full Time Positions</td><td>" . $hiring . "</td></tr>
        <tr><td>Advisory Committee</td><td>" . $advise . "</td></tr>
        <tr><td>LinkedIn</td><td>" . displayValue($linkedIn, false, true) ."</td></tr>
        </table>
        </div>
        </div>
    ";
    echo $out;
}

//Display a static value or a text box
function displayValue($value, $edit, $isURL) {
    $out = "";
    $textbox = "<input class=\"textbox\" type=\"text\" placeholder=\"" . $value . "\" >";
    if (!$isURL) {
        //Standard type (value => value)
        $out = $edit ? $textbox : $value;
    } else {
        //Otherwise, build a URL
        $out = $edit ? $textbox : "<a href=\"" . $value . "\">" . $value . "</a>";
    }
    return $out;
}

//Query and Data Functions
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

?>
