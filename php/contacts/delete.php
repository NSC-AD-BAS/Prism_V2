<!DOCTYPE html>
<html lang="en">
<head>
    <title>PRISM - Delete Contact</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../style/site.css">

    <?php
    require 'update_db.php';


    $renderThis = 'standard';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Mapped the passed back variables to something we can play with.
        $contactId = $_POST['id'];
        $OrganizationId = $_POST['orgid'];
        $ContactFirstName = $_POST['firstname'];
        $ContactLastName = $_POST['lastname'];
        $OrganizationName = $_POST['orgname'];

        //Push Changes to database
        $saveResult = deleteContact($contactId);
        if ($saveResult) {
            $renderThis = 'deleted';
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
            $OrganizationName = $data[0][13];
        } else {
            //This tells the page the variable your looking for doesn't exist, so it can
            //render something different.
            $renderThis = "unknown";
        }
    }
    ?>
</head>
<body>
<nav>
    <ul>
        <li class="left"><a href="../internships/list.php">Internships</a></li>
        <li class="left"><a href="../companies/list.php">Companies</a></li>
        <li class="left"><a href="../students/list.php">Students</a></li>
        <li class="left"><a href="../admin/admin.php">Admin</a></li>
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
    <?php if ($renderThis == "deleted") : ?>
        <h1>You contact has been deleted! </h1>
        <!-- http://php.net/manual/en/function.http-build-query.php -->
        <h2><a href="<?php ECHO '../companies/detail.php?' . http_build_query(array('id' => $OrganizationId)) ?>">Click
                here to go back
                to <?php ECHO htmlspecialchars($OrganizationName) ?> page....</a></h2>
    <?php endif; ?>
    <?php if ($renderThis == "standard" || $renderThis == "saved") : ?>
        <h1>Delete Existing Contact</h1>
        <form action="edit.php" method="post">
            <input type="hidden" name="id" value="<?php ECHO htmlspecialchars($contactId) ?>"/>
            <input type="hidden" name="orgname" value="<?php ECHO htmlspecialchars($OrganizationName) ?>"/>
            <input type="hidden" name="orgid" value="<?php ECHO htmlspecialchars($OrganizationId) ?>"/>
            <input type="hidden" name="lastname" value="<?php ECHO htmlspecialchars($ContactLastName) ?>"/>
            <input type="hidden" name="firstname" value="<?php ECHO htmlspecialchars($ContactFirstName) ?>"/>
            <table id="internship_detail">
                <p>Are you sure you want to delete your Contact?
                    <br/>
                    Contact Name: "<?php ECHO htmlspecialchars($ContactFirstName . " " . $ContactLastName) ?></p>
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