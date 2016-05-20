<?php
# delete php file: handles deleting or undeleting an entry
# Author: Tim Davis
# Author: Kellan Nealy

include("common.php");
include("query_db.php");

# Prints main html for this internship delete
function print_delete_main($data, $intId) { ?>
    <!-- Main view -->
    <main>
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
print_top();

# Make sure GET id parameter is set
if (isset($_GET["id"])) {
    $intId = $_GET["id"];
    $data = get_internship_detail($intId);
    print_delete_main($data, $intId);
} else {
    print_error_main();
}

print_bottom();

?>
