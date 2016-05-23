<?php

/* Company Detail Rendering Functions */
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
        $desc = $d['Description'];
        $deleted = $d['isDeleted'];
    }
    $delete_text = $deleted ? "Restore" : "Delete";

    //Company Detail Table
    $out = '
        <div class="wrapper">
        <div class="detail_table">
        <form action="edit_company.php?id=" . $id . " method="post">
        <table>
            <!-- pass along the orgId -->
            <input type="hidden" name="id" value="' . $id . '">
            <tr><td>Company Name</td><td><strong>' . displayValue($name, "name", $edit, false) . '</strong></td></tr>
            <tr><td>Company URL </td><td>' . displayValue($url, "url", $edit, true)  . '</td></tr>
            <tr><td>Company Address</td><td>
                <table>
                    <td><tr>' . displayValue($street, "street", $edit, false) . '&nbsp;</td></tr>
                    <br>
                    <td><tr>' . displayValue($city, "city", $edit, false) . ', ' . displayValue($state, "state", $edit, false) . '</td></tr>
                </table></td></tr>
            <tr><td>Number of Employees</td><td>' . displayValue(number_format($num_employees), "num_employees", $edit, false) . '</td></tr>
            <tr><td>Annual Revenue</td><td>' . displayValue(money_format("%n", $revenue), "revenue", $edit, false) . '</td></tr>
            <tr><td>Description</td><td>' . displayValue($desc, "desc", $edit, false) . '</td></tr>
        </table>
        <hr>
        ';
        //Buttons...
        $out .= '<div class="lower_nav">';
            if ($edit) {
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
                //FIXME: contacts/create.php not yet implemented
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

//Display a static value or a text box.  $post is the variable passed if we're working with a form.
function displayValue($value, $post, $edit, $isURL) {
    $out = '';
    $textbox = '<input class="textbox" type="text" placeholder="' . $value . '" name="' . $post . '" >';
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
