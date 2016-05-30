<?php
require "../login/validate_session.php";
require "../db/query_db.php";
require "../db/update_db.php";
require "../render/page_builder.php";

$renderThis = 'standard';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Mapped the passed back variables to something we can play with.
    $OrganizationId = $_POST['orgid'];
    $ContactFirstName = $_POST['firstname'];
    $ContactLastName = $_POST['lastname'];
    $Title = $_POST['title'];
    $OfficeNumber = $_POST['officenumber'];
    $OfficeExtension = $_POST['officeextension'];
    $CellNumber = $_POST['cell'];
    $EmailAddress = $_POST['email'];
    $Referral = $_POST['referral'];
    if (isset($_POST['hiring'])) {
        $Hiring = $_POST['hiring'];
    } else {
        $Hiring = false;
    }
    if (isset($_POST['onadcommittee'])) {
        $OnADAdvisoryCommittee = $_POST['onadcommittee'];
    } else {
        $OnADAdvisoryCommittee = false;
    }
    $LinkedInURL = $_POST['linkedinurl'];

    //Push Changes to database
    $saveResult = createContact($OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
        $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL);
    if ($saveResult) {
        //Any output, since header redirects only work if no data has been sent yet.  Just a heads-up!
        //Note: Cross Site Scripting Vulnerability:
        header("Location: ../companies/detail.php?id=$OrganizationId");
    } else {
        $renderThis = 'savingerror';
    }

} else {
    $OrganizationId = $_REQUEST['orgId'];
}

render_header("Contact", true);
render_nav("Create New Contact");
?>
<?php if ($renderThis == "savingerror") : ?>
    <h1>Sorry! Looking like something wen wrong when we tried to save that... You can see the detail below.</h1>
    <p><?php ECHO htmlspecialchars($saveResult) ?></p>
<?php endif; ?>
<?php if ($renderThis == "standard") : ?>
    <form action="create.php" method="post">
        <input type="hidden" name="orgid" value="<?php ECHO htmlspecialchars($OrganizationId) ?>"/>
        <table id="detail_container">
            <tr>
                <th><label for="firstname">First Name**</label></th>
                <td><input id="firstname" name="firstname" type="text" maxlength="50" required
                           value="" autofocus/>
                </td>
            </tr>
            <tr>
                <th><label for="lastname">Last Name**</label></th>
                <td><input id="lastname" name="lastname" type="text" maxlength="50" required
                           value=""/>
                </td>
            </tr>
            <tr>
                <th><label for="title">Title**</label></th>
                <td><input id="title" name="title" type="text" maxlength="100" required
                           value=""/>
                </td>
            </tr>
            <tr>
                <th><label for="officenumber">Office Number**</label></th>
                <td><input id="officenumber" name="officenumber" type="tel" required
                           maxlength="12"
                           value=""/>
                </td>
            </tr>
            <tr>
                <th><label for="officeextension">Office Extension</label></th>
                <td><input id="officeextension" name="officeextension" type="text" maxlength="10"
                           value=""/>
                </td>
            </tr>
            <tr>
                <th><label for="cell">Cell</label></th>
                <td><input id="cell" name="cell" type="tel" maxlength="12"
                           value=""/>
                </td>
            </tr>
            <tr>
                <th><label for="email">Email**</label></th>
                <td><input name="email" name="email" type="email" maxlength="100" required
                           value=""/>
                </td>
            </tr>
            <tr>
                <th><label for="referral">Referral</label></th>
                <td><input id="referral" name="referral" type="text" maxlength="100"
                           value=""/>
                </td>
            </tr>
            <tr>
                <th><label for="hiring">Hiring</label></th>
                <td><input id="hiring" name="hiring" type="checkbox"/>
                </td>
            </tr>
            <tr>
                <th><label for="onadcommittee">On AD Advisory Committee</label></th>
                <td><input id="onadcommittee" name="onadcommittee"
                           type="checkbox"/>
                </td>

            </tr>
            <tr>
                <th><label for="linkedinurl">LinkedIn URL</label></th>
                <td><input id="linkedinurl" name="linkedinurl" type="url" maxlength="250"
                           value=""/>
                </td>
            </tr>

        </table>
        <br/>
        <a class="button"
           href="<?php ECHO '../companies/detail.php?' . http_build_query(array('id' => $OrganizationId)) ?>">
            <div>Cancel</div>
        </a>
        <input type="submit" value="Add Contact">
    </form>

<?php endif; ?>
<?php
render_footer();
?>