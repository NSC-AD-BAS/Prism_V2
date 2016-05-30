<?php
require "../login/validate_session.php";
require "../db/query_db.php";
require "../db/update_db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PRISM - Create Contact</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style/site.css">

    <?php


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
            $renderThis = 'saved';
        } else {
            $renderThis = 'savingerror';
        }

    } else {
        $OrganizationId = $_REQUEST['orgId'];
    }
    ?>
</head>
<body>
<nav>
    <ul>
        <li class="left"><a href="../internships/list.php">Internships</a></li>
        <li class="left"><a href="../companies/list.php">Companies</a></li>
        <li class="left"><a href="../students/list.php">Students</a></li>
        <li class="left"><a href="../users/list.php">Users</a></li>
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
    <?php if ($renderThis == "saved") : ?>
        <h1>You've added a new contact! </h1>
        <!-- http://php.net/manual/en/function.http-build-query.php -->
        <h2><a href="<?php ECHO '../companies/detail.php?' . http_build_query(array('id' => $OrganizationId)) ?>">Click
                here to go back to the Organizations's page....</a></h2>
    <?php endif; ?>
    <?php if ($renderThis == "standard") : ?>
        <h1>Create New Contact</h1>
        <form action="create.php" method="post">
            <input type="hidden" name="orgid" value="<?php ECHO htmlspecialchars($OrganizationId) ?>"/>
            <table id="internship_detail">
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
                <tr>
                    <td><br/></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Add Contact"></td>
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
