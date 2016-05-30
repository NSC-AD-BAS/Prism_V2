<?php
require "../login/validate_session.php";
require "../db/query_db.php";
require "../db/update_db.php";
require "../render/page_builder.php";

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

render_header("Contact", true);
render_nav("Delete Existing Contact");
?>
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
    <form action="delete.php" method="post">
        <input type="hidden" name="id" value="<?php ECHO htmlspecialchars($contactId) ?>"/>
        <input type="hidden" name="orgname" value="<?php ECHO htmlspecialchars($OrganizationName) ?>"/>
        <input type="hidden" name="orgid" value="<?php ECHO htmlspecialchars($OrganizationId) ?>"/>
        <input type="hidden" name="lastname" value="<?php ECHO htmlspecialchars($ContactLastName) ?>"/>
        <input type="hidden" name="firstname" value="<?php ECHO htmlspecialchars($ContactFirstName) ?>"/>
        <table id="detail_container">
            <p>Are you sure you want to delete your Contact?
                <br/>
                Contact Name: "<?php ECHO htmlspecialchars($ContactFirstName . " " . $ContactLastName) ?>"</p>
        </table>
        <br/>
        <a class="button"
           href="<?php ECHO '../companies/detail.php?' . http_build_query(array('id' => $OrganizationId)) ?>">
            <div>Cancel</div>
        </a>
        <input type="submit" value="Delete">
    </form>
<?php endif; ?>
<?php
render_footer();
?>