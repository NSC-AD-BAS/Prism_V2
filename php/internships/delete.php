<?php
# delete php file: handles deleting or undeleting an entry
# Author: Tim Davis
# Author: Kellan Nealy

include("common.php");
include("../db/query_db.php");
include("../render/page_builder.php");
include_once("../login/login_utils.php");

# Session management
session_start();
if (!is_logged_in()) {
    to_login();
}

# Prints main html for this internship delete
function print_delete_main($data, $intId) { ?>
        <?php
        # Make sure we have data
        if (count($data) > 0) {
            $data = $data[0];
            $intPosition = $data["Position Title"];
            $intCompany = $data["Organization"];
            $isDeleted = $data["isDeleted"];

            # Set header and redirect values depending on if this entry is deleted or not
            $header = $redirect = "";
            if (!$isDeleted) {
                $header = "Are you sure you want to delete </br>";
                $redirect = "confirm_delete.php";
            } else {
                $header = "Do you want to undelete </br>";
                $redirect = "confirm_undelete.php";
            }
            $header = $header . "\"" . $intPosition . "\" at " . $intCompany . "?"; ?>

            <!-- HTML content -->
            <h1><?= $header ?></h1>

            <form action=<?= $redirect ?> method="POST">
                <input type="hidden" name="intId" value="<?php echo htmlspecialchars($intId) ?>" />
                <input type="submit" name="no" value="No" />
                <input type="submit" name="yes" value="Yes" />
            </form>
        <?php } ?>
    </main>
<?php }

# Build delete page
render_header("Delete Internship");

# Make sure GET id parameter is set
if (isset($_GET["id"])) {
    $intId = $_GET["id"];
    $data = get_internship_detail($intId);
    print_delete_main($data, $intId);
} else {
    print_error_main();
}

render_footer();

?>
