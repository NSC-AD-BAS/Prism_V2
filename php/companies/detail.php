<?php

//TODO: Get column headers and td names from column names in DB, not hard-coded.

//Includes
include "page_builder.php";
include "query_db.php";

//Check URL params to set globals
//Company ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header("Location: list.php");
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

//Don't hit the DB if we're not rendering these bits
if (!$edit) {
    $positions = get_internships_by_company($id);
    $company_contacts = get_contacts_by_company($id);
}

//Actually Build the page!
render_header('Companies', true);
render_nav($company_name);
renderCompanyDetail($data, $edit);

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
    $out = "
        <div class=\"wrapper\">
        <div class=\"detail_table\">
        <form action=\"edit_company.php?id=$id\" method=\"post\">
        <table>
            <!-- pass along the orgId -->
            <input type=\"hidden\" name=\"orgId\" value=\"" . $id . "\">
            <tr><td>Company Name</td><td><strong>" . displayValue($name, 'name', $edit, false) . "</strong></td></tr>
            <tr><td>Company URL </td><td>   " . displayValue($url, 'url', $edit, true)  . "</td></tr>
            <tr><td>Company Address</td><td>
                <table>
                    <td><tr>" . displayValue($street, 'street', $edit, false) . "&nbsp;</td></tr>
                    <br>
                    <td><tr>" . displayValue($city, 'city', $edit, false) . ", " . displayValue($state, 'state', $edit, false) . "</td></tr>
                </table></td></tr>
            <tr><td>Number of Employees</td><td> " . displayValue(number_format($num_employees), 'num_employees', $edit, false) . "</td></tr>
            <tr><td>Annual Revenue</td><td>      " . displayValue(money_format("%n", $revenue), 'revenue', $edit, false) . "</td></tr>
            <tr><td>Description</td><td>         " . displayValue($desc, 'desc', $edit, false) . "                        </td></tr>
        </table>
        <hr>

        ";
        //Sew Buttons...
        $out .= "<div class=\"lower_nav\">";
            if ($edit) {
                $out .= "
                <div class=\"lower_nav\">
                    <input type=\"submit\" class=\"button\" value=\"Save\"></td></tr>
                    <input type=\"submit\" class=\"button\" value=\"Cancel\"></td></tr>
                </div>
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
        </form><!--close form-->
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
        <hr>
        <table>
        <tr><td><strong>Title</strong></td><td><strong>Description</strong></td></tr>
    ";
    foreach ($positions as $pos) {
        $internshipId = $pos['InternshipId'];
        $title = $pos['PositionTitle'];
        $desc = $pos['Description'];
        $out .= "
            <tr>
                <td><a href=\"../internships/detail.php?id=" . $internshipId . "\">" . $title . "</a></td>
                <td><a href=\"../internships/detail.php?id=" . $internshipId . "\">" . $desc .  " </a></td>
            </tr>
        ";
    }
    //Buttons
    $out .= "
        </table>
        <hr>
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
    //TODO: check for empty before iterating through null set (CodeCleanup)
    $out = "
        <div class=\"wrapper\">
        <div class=\"detail_table\">
        <table>
        <h3>Company Contacts</h3>
    ";
    foreach ($company_contacts as $contact) {
        $contactId = $contact['ContactId'];
        $orgId = $contact['OrganizationId'];
        $first = $contact['ContactFirstName'];
        $last = $contact['ContactLastName'];
        $title = $contact['Title'];
        $email = $contact['EmailAddress'];
        $office = $contact['OfficeNumber'];
        $ext = $contact['OfficeExtension'];
        $cell = $contact['CellNumber'];
        $ref = $contact['Referral'];
        $hiring = $contact['Hiring'] ? "Yes" : "No";
        $advise = $contact['OnADAdvisoryCommittee'] ? "Yes" : "No";
        $linkedIn = $contact['LinkedInURL'];

        $out .= "
            <hr>
            <tr><td>Name</td><td>" . $first . " " . $last ."</td></tr>
            <tr><td>Title</td><td>" . $title ."</td></tr>
            <tr><td>Email Address</td><td>" . displayValue($email, 'email', false, true) ."</td></tr>
            <tr><td>Office Phone</td><td>" . $office . "</td><td>ext. </td><td>" . $ext . "</td></tr>
            <tr><td>Cell Phone</td><td>" . $cell . "</td></tr>
            <tr><td>Referral</td><td>" . $ref . "</td></tr>
            <tr><td>Hiring Full Time Positions</td><td>" . $hiring . "</td></tr>
            <tr><td>On AD Advisory Committee</td><td>" . $advise . "</td></tr>
            <tr><td>LinkedIn</td><td>" . displayValue($linkedIn, 'linkedIn', false, true) ."</td></tr>
            </table>
            <hr>
        ";

        //Buttons...
        if (isAdmin()) {
            //FIXME: contacts/create.php not yet implemented
            $out .= "
                <a class=\"button\" href=\"../contacts/edit.php?id=" . $contactId . "\"><div>Edit Contact</div></a>
                <a class=\"button\" href=\"../contacts/create.php?orgId=" . $orgId . "\"><div>Add Contact</div></a>
            ";
        }
    }

    $out .= "
        </div>
        </div>
    ";
    echo $out;
}

//Display a static value or a text box.  $post is the variable passed if we're working with a form.
function displayValue($value, $post, $edit, $isURL) {
    $out = "";
    $textbox = "<input class=\"textbox\" type=\"text\" placeholder=\"" . $value . "\" name=\"" . $post . "\" >";
    if (!$isURL) {
        //Standard type (value => value)
        $out = $edit ? $textbox : $value;
    } else {
        //Otherwise, build a URL
        if (strpos($value, "@") === false) {
            //Not an email address
            $out = $edit ? $textbox : "<a href=\"" . $value . "\">" . $value . "</a>";
        } else {
            $out = $edit ? $textbox : "<a href=\"mailto:" . $value . "\">" . $value . "</a>";
        }
    }
    return $out;
}

?>
