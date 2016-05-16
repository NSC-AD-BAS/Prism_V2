<?php
# update_db php file: db write-access layer
# Author: Tim Davis
# Author: Kellan Nealy

include("common.php");

# Prints the main html for this internship delete
function print_delete_main() {
    $intId = $_GET["id"]; ?>

    <main>
        <h1>Are you sure you want to delete this internship?</h1>

        <!-- Buttons -->
        <a class="button" href="detail.php?id=<?= $intId ?>"><div>No</div></a>
        <a class="button" href="list.php"><div>Yes</div></a>
    </main>
<?php }

print_top();
print_delete_main();
print_bottom();

?>
