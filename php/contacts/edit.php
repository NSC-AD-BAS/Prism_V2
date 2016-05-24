<?php
    require 'update_db.php';

    $renderThis = 'standard';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Mapped the passed back variables to something we can play with.
        $contactId = $_POST['id'];
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
        $OrganizationName = $_POST['orgname'];

        //Push Changes to database
        $saveResult = updateContact($contactId, $OrganizationId, $ContactFirstName, $ContactLastName, $Title, $OfficeNumber,
            $OfficeExtension, $CellNumber, $EmailAddress, $Referral, $Hiring, $OnADAdvisoryCommittee, $LinkedInURL);
        if ($saveResult) {
            //NOTE: I added this redirect to org detail to fix a bug Steve logged.  It also required that I move this logic block above
            //Any output, since header redirects only work if no data has been sent yet.  Just a heads-up!
            header("Location: ../companies/detail.php?id=$OrganizationId");
            $renderThis = 'saved';
        } else {
            $renderThis = 'savingerror';
        }

    } else {
        $contactId = $_REQUEST['id'];
        $data = get_contact_detail($contactId);
        if (($data != false) && sizeof($data) > 0) {
            //Map Data values
            $ContactId = $data[0][0];
            $OrganizationId = $data[0][1];
            $ContactFirstName = $data[0][2];
            $ContactLastName = $data[0][3];
            $Title = $data[0][4];
            $OfficeNumber = $data[0][5];
            $OfficeExtension = $data[0][6];
            $CellNumber = $data[0][7];
            $EmailAddress = $data[0][8];
            $Referral = $data[0][9];
            $Hiring = $data[0][10];
            $OnADAdvisoryCommittee = $data[0][11];
            $LinkedInURL = $data[0][12];
            $OrganizationName = $data[0][13];
        } else {
            //This tells the page the variable your looking for doesn't exist, so it can
            //render something different.
            $renderThis = "unknown";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PRISM - Edit Contact</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style/site.css">


</head>
<body>
<nav>
    <ul>
        <li class="left"><a href="../internships/list.php">Internships</a></li>
        <li class="left"><a href="../companies/list.php">Companies</a></li>
        <li class="left"><a href="../students/list.php">Students</a></li>
        <li class="left"><a href="../admin/list.php">Users</a></li>
        <li class="right"><a href="list.php">Logout</a></li>
        <li class="right"><a href="list.php">Profile</a></li>
        <li id="welcome" class="right">Welcome, You!</li>
    </ul>
</nav>

<main>



    <?php if ($renderThis == "savingerror") : ?>
        <h1>Sorry! Looking like something wen wrong when we tried to save that... You can see the detail below.</h1>
        <p><?php ECHO htmlspecialchars($saveResult) ?></p>
    <?php endif; ?>
    <?php if ($renderThis == "unknown") : ?>
        <h1>Sorry! We can't find the id you are looking for. :( </h1>
    <?php endif; ?>
    <?php if ($renderThis == "saved") : ?>
        <h1>You changes have been saved! </h1>
        <!-- http://php.net/manual/en/function.http-build-query.php -->
        <h2><a href="<?php ECHO '../companies/detail.php?' . http_build_query(array('id' => $OrganizationId)) ?>">Click
                here to go back
                to <?php ECHO htmlspecialchars($OrganizationName) ?> page....</a></h2>
    <?php endif; ?>
    <?php if ($renderThis == "standard" || $renderThis == "saved") : ?>
        <h1>Edit Existing Contact</h1>
        <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?php ECHO htmlspecialchars($contactId) ?>"/>
            <input type="hidden" name="orgname" value="<?php ECHO htmlspecialchars($OrganizationName) ?>"/>
            <input type="hidden" name="orgid" value="<?php ECHO htmlspecialchars($OrganizationId) ?>"/>
            <table id="internship_detail">
                <tr>
                    <th><label for="firstname">First Name**</label></th>
                    <td><input id="firstname" name="firstname" type="text" maxlength="50" required
                               value="<?php ECHO htmlspecialchars($ContactFirstName) ?>" autofocus>
                    </td>
                </tr>
                <tr>
                    <th><label for="lastname">Last Name**</label></th>
                    <td><input id="lastname" name="lastname" type="text" maxlength="50" required
                               value="<?php ECHO htmlspecialchars($ContactLastName) ?>">
                    </td>
                </tr>
                <tr>
                    <th><label for="title">Title**</label></th>
                    <td><input id="title" name="title" type="text" maxlength="100" required
                               value="<?php ECHO htmlspecialchars($Title) ?>">
                    </td>
                </tr>
                <tr>
                    <th><label for="officenumber">Office Number**</label></th>
                    <td><input id="officenumber" name="officenumber" type="tel" required
                               maxlength="12"
                               value="<?php ECHO htmlspecialchars($OfficeNumber) ?>">
                    </td>
                </tr>
                <tr>
                    <th><label for="officeextension">Office Extension</label></th>
                    <td><input id="officeextension" name="officeextension" type="text" maxlength="10"
                               value="<?php ECHO htmlspecialchars($OfficeExtension) ?>">
                    </td>
                </tr>
                <tr>
                    <th><label for="cell">Cell</label></th>
                    <td><input id="cell" name="cell" type="tel" maxlength="12"
                               value="<?php ECHO htmlspecialchars($CellNumber) ?>">
                    </td>
                </tr>
                <tr>
                    <th><label for="email">Email**</label></th>
                    <td><input name="email" name="email" type="email" maxlength="100" required
                               value="<?php ECHO htmlspecialchars($EmailAddress) ?>">
                    </td>
                </tr>
                <tr>
                    <th><label for="referral">Referral</label></th>
                    <td><input id="referral" name="referral" type="text" maxlength="100"
                               value="<?php ECHO htmlspecialchars($Referral) ?>">
                    </td>
                </tr>
                <tr>
                    <th><label for="hiring">Hiring</label></th>
                    <td><input id="hiring" name="hiring" type="checkbox" <?php if ($Hiring) {
                            echo " checked ";
                        } ?>">
                    </td>
                </tr>
                <tr>
                    <th><label for="onadcommittee">On AD Advisory Committee</label></th>
                    <td><input id="onadcommittee" name="onadcommittee"
                               type="checkbox" <?php if ($OnADAdvisoryCommittee) {
                            echo " checked ";
                        } ?>>
                    </td>

                </tr>
                <tr>
                    <th><label for="linkedinurl">LinkedIn URL</label></th>
                    <td><input id="linkedinurl" name="linkedinurl" type="url" maxlength="250"
                               value="<?php ECHO htmlspecialchars($LinkedInURL) ?>">
                    </td>
                </tr>
                <tr>
                    <th><label>Organization Name</label></th>
                    <td><?php ECHO htmlspecialchars($OrganizationName) ?></td>
                </tr>
                <tr>
                    <td><br/></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Save Changes"></td>
                </tr>
            </table>
        </form>
        <a class="button"
           href="<?php ECHO '../companies/detail.php?' . http_build_query(array('id' => $OrganizationId)) ?>">
            <div>Back to Company</div>
        </a>

    <?php endif; ?>
</main>

<footer>
    <p>
        <small>North Seattle College - PRISM &copy; 2016</small>
    </p>
</footer>

</body>
</html>
