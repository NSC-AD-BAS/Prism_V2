<?php

/* Company Detail Rendering Functions */

//Company List
function renderCompanyList($data, $archived) {
    $out = '
        <ul class="outer">
            <li class="tableHead">
            <ul class="inner">
                <li>Company Name</li>
                <li>Location</li>
                <li>Internships Available</li>
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
    //If we're not creating a new company, get the company data
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
    }
    $form_action = $create ? '<form action="add_company.php" method="post">' : '<form action="edit_company.php?id=$id" method="post">';

    //Company Detail Table
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
            <tr><td>Number of Employees</td><td>' . displayValue(number_format($num_employees), "num_employees", $edit, false, $create) . '</td></tr>
            <tr><td>Annual Revenue</td><td>' . displayValue(money_format("%n", $revenue), "revenue", $edit, false, $create) . '</td></tr>
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
function renderCompanyInternships($positions) {
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
            <a class="button" href="../internships/create.php"><div>Create Internship</div></a>
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
                <hr>
            ';

            //Buttons...
            if (isAdmin()) {
                $out .= '<a class="button" href="../contacts/edit.php?id=' . $contactId . '"><div>Edit Contact</div></a>';
            }
        }
    } else {
        $out .= '
            <table><tr><td>No Contacts Defined</td></tr></table><hr>
        ';
    }
    //Show Add Contact button even if no contacts are defined
    if (isAdmin()) {
        $out .= '<a class="button" href="../contacts/create.php?orgId=' . $id . '"><div>Add Contact</div></a>';
    }
    $out .= '</div></div>';
    echo $out;
}

//Build the text boxes for nicer looking edit mode
//Display a static value or a text box.  $post is the variable passed if we're working with a form.
function displayValue($value, $post, $edit, $isURL, $create) {
    $out = '';
    //Ensure users fill out required fields
    if ($create && ($post == "name" || $post == "desc")) {
        $textbox = '<input class="textbox" type="text" placeholder="' . $value . ' (Required) " name="' . $post . '" required>';
    } else {
        $textbox = '<input class="textbox" type="text" placeholder="' . $value . '" name="' . $post . '" >';
    }
    if (!$isURL) {
        //Standard type (value => value)
        $out = $edit ? $textbox : $value;
    } else {
        //Otherwise, build a URL
        if (strpos($value, "@") === false) {
            //Not an email address
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
