<?php

/*
    render_company.php - Build all of the company html strings based on passed-in arguments
*/

//Company List
function renderCompanyList($data, $archived) {
    //TODO: Probably tighten this up a bit.
    //Initialize search ordering to ascending
    $comp_order = "ASC";
    $loc_order = "ASC";
    $avail_order = "DESC";

    //Initialize column names
    $comp_header = "Company Name ";
    $loc_header = "Location ";
    $avail_header = "Internships Available ";

    if (isset($_GET['sort'])) {
        if ($_GET['sort'] == "comp") {
            if ($_GET['order'] == "ASC") {
                $comp_order = "DESC";
                $comp_header .= " &#9660;";
            } else {
                $comp_header .= " &#9650;";
            }
        }
        if ($_GET['sort'] == "loc") {
            if ($_GET['order'] == "ASC") {
                $loc_order = "DESC";
                $loc_header .= " &#9660;";
            } else {
                $loc_header .= " &#9650;";
            }
        }
        if ($_GET['sort'] == "avail") {
            if ($_GET['order'] == "ASC") {
                $avail_order = "DESC";
                $avail_header .= " &#9660;";
            } else {
                $avail_header .= " &#9650;";
            }
        }
    } else {
        $comp_order = "DESC";
        $comp_header .= " &#9660;";
    }
    $out = '
        <ul class="outer">
            <li class="tableHead">
            <ul class="inner">
                <li><a href="?sort=comp&order=' . $comp_order . '">' . $comp_header . '</a></li>
                <li><a href="?sort=loc&order=' . $loc_order . '">' . $loc_header . '</a></li>
                <li><a href="?sort=avail&order=' . $avail_order . '">' . $avail_header . '</a></li>
            </ul>
        ';
        foreach ($data as $d) {
            $available = $archived ? 0 : $d['Available Internships'];
            $out .= '
            <li><a href="detail.php?id=' . $d['OrganizationId'] . '">
                <ul class="inner">
                    <li>' . $d['Organization Name'] . '</li>
                    <li>' . $d['Location'] . '</li>
                    <li>' . $available . '</li>
                </ul>
            </a></li>
            ';
        }
    $out .= '</ul>';

    //Admins can create new companies
    if (isAdmin()) {
        $out .= '
            <hr>
            <a class="button" href="detail.php?create=true"><div>Create new Company</div></a>
        ';
    }

    //Toggle archive display text
    if (!$archived) {
        $out .= '<a class="aside" href="list.php?archived=true">Show Deleted</a>';
    } else {
        $out .= '<a class="aside" href="list.php">Hide Deleted</a>';
    }

    echo $out;
}

//Company Detail
function renderCompanyDetail($data, $edit, $create) {
    //If we're not creating a new company, hit the DB for the company data
    if (!$create) {
        //set nicer variable names
        foreach ($data as $d) {
            $id = $d['OrganizationId'];
            $name = $d['Company'];
            $url = $d['URL'];
            $street = $d['Address 1'];
            $city = $d['City'];
            $state = $d['State'];
            $num_employees = $d['Number of Employees'];
            $revenue = $d['Yearly Revenue'];
            $desc = $d['Description'];
            $deleted = $d['isDeleted'];
        }
        $delete_text = $deleted ? "Restore" : "Delete";
    } else {
        //friendly defaults for placeholder text
        $city = "Seattle";
        $state = "WA";
        $num_employees = 100;
        $revenue = 0;
        $deleted = 0;
        //nulls
        $name = "Company Name ";
        $desc = "Description ";
        $url = "Web Address";
        $street = "Street Address";
    }
    $form_action = $create ? '<form action="add_company.php" method="post">' : '<form action="edit_company.php?id=$id" method="post">';

    //Company Detail Table / Edit / Create form
    $out = '
        <div class="wrapper">
        <div class="detail_table">
        ' . $form_action . '
        <table>
            <!-- pass along the orgId -->
            <input type="hidden" name="id" value="' . $id . '">
            <tr><td>Company Name</td><td><strong>' . displayValue($name, "name", $edit, false, $create) . '</strong></td></tr>
            <tr><td>Company URL </td><td>' . displayValue($url, "url", $edit, true, $create)  . '</td></tr>
            <tr><td>Company Address</td><td>
                <table>
                    <td><tr>' . displayValue($street, "street", $edit, false, $create) . '&nbsp;</td></tr>
                    <br>
                    <td><tr>' . displayValue($city, "city", $edit, false, $create) . ', ' . displayValue($state, "state", $edit, false, $create) . '</td></tr>
                </table></td></tr>
            <tr><td>Number of Employees</td><td>' . displayValue($num_employees, "num_employees", $edit, false, $create) . '</td></tr>
            <tr><td>Annual Revenue</td><td>' . displayValue(sprintf("%01.2f", $revenue), "revenue", $edit, false, $create) . '</td></tr>
            <tr><td>Description</td><td>' . displayValue($desc, "desc", $edit, false, $create) . '</td></tr>
        </table>
        <hr>
        ';
        //Buttons...
        $out .= '<div class="lower_nav">';
            if ($create) {
                $out .= '
                <div class="lower_nav">
                <div>
                    <input type="submit" class="form_button" value="Save">
                    <a class="button" href="list.php"><div>Cancel</div></a>
                </div>
                </div>
                ';
            } elseif ($edit) {
                $out .= '
                <div class="lower_nav">
                <div>
                    <input type="submit" class="form_button" value="Save">
                    <a class="button" href="detail.php?id='. $id .'"><div>Cancel</div></a>
                </div>
                </div>
                ';
            } else {
                $out .= '
                    <a class="button" href="list.php"><div>Company List</div></a>
                ';
                if (isAdmin()) {
                    $out .= '
                        <a class="button" href="detail.php?id=' . $id . '&edit=true"><div>Edit</div></a>
                        <a class="button" href="delete.php?id=' . $id . '"><div>' . $delete_text . '</div></a>
                    ';
                }
            }
            $out .= '
        </form><!--close form-->
        </div> <!--lower_nav-->
        </div> <!--detail_table-->
        </div> <!--wrapper-->
        ';
    echo $out;
}

//Internship List
function renderCompanyInternships($positions, $orgId) {
    $out = '
        <div class="wrapper">
        <div class="detail_table">
        <h3>Available Internships</h3>
        <hr>
        <table>
        <tr><td><strong>Title</strong></td><td><strong>Description</strong></td></tr>
    ';
    foreach ($positions as $pos) {
        $internshipId = $pos['InternshipId'];
        $title = $pos['PositionTitle'];
        $desc = $pos['Description'];
        $out .= '
            <tr>
                <td><a href="../internships/detail.php?id=' . $internshipId . '">' . $title . '</a></td>
                <td><a href="../internships/detail.php?id=' . $internshipId . '">' . $desc .  '</a></td>
            </tr>
        ';
    }
    //Buttons
    $out .= '
        </table>
        <hr>
        <a class="button" href="../internships/list.php"><div>Internship List</div></a>
    ';
    if (isAdmin()) {
        $out .= '
            <a class="button" href="../internships/create.php?orgId=' . $orgId . '"><div>Create Internship</div></a>
        ';
    }
    $out .= '
        </div> <!--lower_nav-->
        </div> <!--detail_table-->
        </div> <!--wrapper-->
    ';
    echo $out;
}

//Contact List
function renderCompanyContacts($company_contacts, $id) {
    //TODO: check for empty before iterating through null set (CodeCleanup)
    $out = '
        <div class="wrapper">
        <div class="detail_table">
        <h3>Company Contacts</h3>
        <hr>
    ';
    if (!empty($company_contacts)) {
        foreach ($company_contacts as $contact) {
            $contactId = $contact['ContactID'];
            $orgId = $contact['OrganizationId'];
            $name = $contact['Contact Name'];
            $title = $contact['Title'];
            $email = $contact['Email Address'];
            $office = $contact['Office Phone'];
            $ext = $contact['Extension'];
            $cell = $contact['Mobile Number'];
            $ref = $contact['Referral'];
            $hiring = $contact['Hiring'] ? "Yes" : "No";
            $advise = $contact['AD Advisory Committee Member'] ? "Yes" : "No";
            $linkedIn = $contact['LinkedIn'];

            $out .= '
                <table>
                <tr><td>Name</td><td>' . $name .'</td></tr>
                <tr><td>Title</td><td>' . $title . '</td></tr>
                <tr><td>Email Address</td><td>' . displayValue($email, "email", false, true) . '</td></tr>
                <tr><td>Office Phone</td><td>' . $office . '</td><td>ext. </td><td>' . $ext . '</td></tr>
                <tr><td>Cell Phone</td><td>' . $cell . '</td></tr>
                <tr><td>Referral</td><td>' . $ref . '</td></tr>
                <tr><td>Hiring Full Time Positions</td><td>' . $hiring . '</td></tr>
                <tr><td>On AD Advisory Committee</td><td>' . $advise . '</td></tr>
                <tr><td>LinkedIn</td><td>' . displayValue($linkedIn, "linkedIn", false, true) . '</td></tr>
                </table>

            ';

            //Buttons...
            if (isAdmin()) {
                $out .= '
                    <br>
                    <a class="button" href="../contacts/edit.php?id=' . $contactId . '"><div>Edit Contact</div></a>
                    <a class="button" href="../contacts/delete.php?id=' . $contactId . '"><div>Delete Contact</div></a><hr>
                ';
            }
        }
    } else {
        $out .= '
            <table><tr><td>No Contacts Defined</td></tr></table><hr>
        ';
    }
    //Show Add Contact button even if no contacts are defined
    if (isAdmin()) {
        $out .= '<a class="button" href="../contacts/create.php?orgId=' . $id . '"><div>Add New Contact</div></a>';
    }
    $out .= '</div></div>';
    echo $out;
}

//Build the text boxes on the form for a nicer looking edit / create mode experience
//Display a static value or a text box.  $post refers to the variable name passed in if we're working with a form.
function displayValue($value, $post, $edit, $isURL, $create = false) {
    $out = '';
    //Ensure users fill out required fields
    if ($create && ($post == "name" || $post == "desc")) {
        $textbox = '<input class="textbox" type="text" placeholder="' . $value . '(Required)" name="' . $post . '" required>';
    } else {
        $textbox = '<input class="textbox" type="text" placeholder="' . $value . '" name="' . $post . '" >';
    }
    if (!$isURL) {
        //Standard type (value => value)
        $out = $edit ? $textbox : $value;
    } else {
        //Not an email address
        if (strpos($value, "@") === false) {
            //If URL doesn't contain http, add it.  This ensures we don't try to link to a relative file.
            if (strpos($value, "http://") === false) {
                $out = $edit ? $textbox : '<a href="http://' . $value . '">' . $value . '</a>';
            } else {
                $out = $edit ? $textbox : '<a href="' . $value . '">' . $value . '</a>';
            }
        } else {
            $out = $edit ? $textbox : '<a href="mailto:' . $value . '">' . $value . '</a>';
        }
    }
    return $out;
}

?>
